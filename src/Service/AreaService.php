<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\AreaStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Security\Authorization;
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

    private function existsArea(
        int $id
    ): ServiceResult {
        try { 
            $result = $this->area_repository->getById($id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    private function existsAreaName(
        int $record_id
    ): ServiceResult {
        try { 
            $result = $this->area_name_repository->findByRecordId($record_id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

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
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }

    public function addAreaName(
        int $area_id,
        string $name
    ): ServiceResult {
        if(!$this->authorization->canAddAreaName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;

        if (!in_array(
            $area->status,
            [
                AreaStatusEnum::Active,
                AreaStatusEnum::Crowded
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->add_area_name_transaction->handle(
            $area->id,
            $name,
            $this->authorization->user->id
        );
    }

    public function setPrimaryAreaName(
        int $area_id,
        int $record_id,
    ): ServiceResult {
        if(!$this->authorization->canSetPrimaryAreaName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;
        $result = $this->existsAreaName($record_id);

        if(!$result->success) {
            return $result;
        }

        $area_name = $result->entity;

        if ($area->id != $area_name->area_id) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }

        if ($area_name->is_primary){
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NAME_ALREADY_PRIMARY
            );
        }

        return $this->set_primary_area_name_transaction->handle(
            $record_id,
            $area_name->area_id
        );
    }

    public function removeAreaName(
        int $area_id
    ): ServiceResult {
        if(!$this->authorization->canRemoveAreaName()) {
            throw ServiceException::FORBIDDEN();
        }

        $area_name = $this->area_name_repository->findPrimaryByAreaId($area_id);

        if ($area_name === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }   

        try {
            $this->area_name_repository->updatePrimary(
                record_id: $area_name->record_id,
                is_primary: false
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }

    public function grantAreaAccess(
        int $area_id,
        int $user_id
    ): ServiceResult {
        if(!$this->authorization->canGrantAreaAccess()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;

        $area_access_value = $this->area_access_repository->findByAreaIdAndUserId(
            area_id: $area->id,
            user_id: $user_id
        );

        if ($area_access_value !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_ACCESS_ALREADY_EXISTS
            );
        }

        try {
            $this->area_access_repository->add(
                area_id: $area->id,
                user_id: $user_id,
                created_by_user_id: $this->authorization->user->id
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
        return new ServiceResult(
            success: true
        );
    }

    public function revokeAreaAccess(
        int $area_id,
        int $user_id
    ): ServiceResult {
        if(!$this->authorization->canRevokeAreaAccess()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;

        $area_access_value = $this->area_access_repository->findByAreaIdAndUserId(
            area_id: $area->id,
            user_id: $user_id
        );

        if ($area_access_value === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_ACCESS_NOT_FOUND
            );
        }

        try {
            $this->area_access_repository->delete(
                area_id: $area_access_value->area_id,
                user_id: $user_id
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
        return new ServiceResult(
            success: true
        );
    }

    public function createArea(): ServiceResult {
        if(!$this->authorization->canCreateArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $this->create_area_transaction->handle(
            $this->authorization->user->id
        );

        return new ServiceResult(
            success: true
        );
    }

    public function activateArea(
        int $area_id
    ): ServiceResult {
        if(!$this->authorization->canActivateArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }
        
        $area = $result->entity;

        if (!in_array(
            $area->status,
            [
                AreaStatusEnum::Created,
                AreaStatusEnum::Archived,
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $area->id,
            AreaStatusEnum::Active
        );
    }

    public function markAreaAsCrowded(
        int $area_id
    ): ServiceResult {
        if(!$this->authorization->canMarkAreaAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;

        if (!in_array(
            $area->status,
            [
                AreaStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $area->id,
            AreaStatusEnum::Crowded
        );
    }

    public function archiveArea(
        int $area_id
    ): ServiceResult {
         if(!$this->authorization->canArchiveArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsArea($area_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;

        if (!in_array(
            $area->status,
            [
                AreaStatusEnum::Active,
                AreaStatusEnum::Crowded

            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $area->id,
            AreaStatusEnum::Archived
        );
    }
}