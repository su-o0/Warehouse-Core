<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\AreaEntity;
use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\AreaStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\VO\AreaNameVO;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Security\Lifecycle;
use WarehouseCore\Transaction\Area\AddAreaNameTransaction;
use WarehouseCore\Transaction\Area\CreateAreaTransaction;
use WarehouseCore\Transaction\Area\SetPrimaryAreaNameTransaction;

final class AreaService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private AreaRepository $area_repository,
        private AreaNameRepository $area_name_repository,
        private AreaAccessRepository $area_access_repository,
        private CreateAreaTransaction $create_area_transaction,
        private AddAreaNameTransaction $add_area_name_transaction,
        private SetPrimaryAreaNameTransaction $set_primary_area_name_transaction
    ) { }

    private function changeStatus(
        int $id,
        AreaStatusEnum $status
    ): ServiceResult {
        try {
            $this->area_repository->updateStatus(
                $id,
                $status->value
            );
        }catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function addAreaName(
        AreaEntity $area,
        string $name
    ): ServiceResult {
        if (!$this->authorization->canAddAreaName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canAddAreaName($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->add_area_name_transaction->handle(
            $area->id,
            $name,
            $this->authorization->getUserId()
        );
    }

    public function setPrimaryAreaName(
        AreaEntity $area,
        AreaNameVO $area_name
    ): ServiceResult {
        if (!$this->authorization->canSetPrimaryAreaName()) {
            throw ServiceException::FORBIDDEN();
        }
        
        if (!Lifecycle::canSetPrimaryAreaName($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        if ($area->id != $area_name->area_id) {
            return ServiceResult::failure(
                ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }

        if ($area_name->is_primary){
            return ServiceResult::failure(
                ErrorMessage::AREA_NAME_ALREADY_PRIMARY
            );
        }

        return $this->set_primary_area_name_transaction->handle(
            $area_name->record_id,
            $area_name->area_id
        );
    }

    public function removeAreaName(
        AreaEntity $area
    ): ServiceResult {
        if (!$this->authorization->canRemoveAreaName()) {
            throw ServiceException::FORBIDDEN();
        }
        
        if (!Lifecycle::canRemoveAreaName($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        $area_name = $this->area_name_repository->findPrimaryByAreaId(
            $area->id
        );

        if ($area_name === null) {
            return ServiceResult::failure(
                ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }   

        try {
            $this->area_name_repository->updatePrimary(
                record_id: $area_name->record_id,
                is_primary: false
            );
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function grantAreaAccess(
        AreaEntity $area,
        UserEntity $user
    ): ServiceResult {
        if (!$this->authorization->canGrantAreaAccess()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canGrantAreaAccess($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        $area_access = $this->area_access_repository->findByAreaIdAndUserId(
            area_id: $area->id,
            user_id: $user->id
        );

        if ($area_access !== null) {
            return ServiceResult::failure(
                ErrorMessage::AREA_ACCESS_ALREADY_EXISTS
            );
        }

        try {
            $this->area_access_repository->add(
                area_id: $area->id,
                user_id: $user->id,
                created_by_user_id: $this->authorization->getUserId()
            );
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function revokeAreaAccess(
        AreaEntity $area,
        UserEntity $user
    ): ServiceResult {
        if (!$this->authorization->canRevokeAreaAccess()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRevokeAreaAccess($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        $area_access = $this->area_access_repository->findByAreaIdAndUserId(
            area_id: $area->id,
            user_id: $user->id
        );

        if ($area_access === null) {
            return ServiceResult::failure(
                ErrorMessage::AREA_ACCESS_NOT_FOUND
            );
        }

        try {
            $this->area_access_repository->delete(
                area_id: $area->id,
                user_id: $user->id
            );
        } catch(RepositoryException $e) {
            return ServiceResult::failure($e->getMessage());
        }
        return ServiceResult::success();
    }

    public function createArea(): ServiceResult {
        if(!$this->authorization->canCreateArea()) {
            throw ServiceException::FORBIDDEN();
        }

        return $this->create_area_transaction->handle(
            $this->authorization->getUserId()
        );
    }

    public function activateArea(
        AreaEntity $area
    ): ServiceResult {
        if (!$this->authorization->canActivateArea()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canActivateArea($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $area->id,
            AreaStatusEnum::Active
        );
    }

    public function markAreaAsCrowded(
        AreaEntity $area
    ): ServiceResult {
        if(!$this->authorization->canMarkAreaAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canMarkAreaAsCrowded($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $area->id,
            AreaStatusEnum::Crowded
        );
    }

    public function archiveArea(
        AreaEntity $area
    ): ServiceResult {
         if(!$this->authorization->canArchiveArea()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canArchiveArea($area)) {
            return ServiceResult::failure(
                ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $area->id,
            AreaStatusEnum::Archived
        );
    }
}