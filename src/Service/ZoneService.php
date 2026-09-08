<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\AreaEntity;
use WarehouseCore\Payload\Entity\ZoneEntity;
use WarehouseCore\Payload\Enum\ZoneStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\VO\ZoneNameVO;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Security\Lifecycle;
use WarehouseCore\Transaction\Zone\AddZoneNameTransaction;
use WarehouseCore\Transaction\Zone\SetPrimaryZoneNameTransaction;

final class ZoneService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ZoneRepository $zone_repository,
        private ZoneNameRepository $zone_name_repository,
        private AddZoneNameTransaction $add_zone_name_transaction,
        private SetPrimaryZoneNameTransaction $set_primary_zone_name_transaction
    ) { }

    private function changeStatus(
        int $id,
        ZoneStatusEnum $status
    ): ServiceResult {
        try {
            $this->zone_repository->updateStatus(
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

    public function addZoneName(
        ZoneEntity $zone,
        string $name
    ): ServiceResult {
        if(!$this->authorization->canAddZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canAddZoneName($zone)) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }
        
        $result = $this->zone_name_repository->findByZoneIdAndValue(
            zone_id: $zone->id,
            value: $name
        );

        if($result !== null) {
            return ServiceResult::failure(
                ErrorMessage::USER_NAME_ALREADY_EXISTS
            );
        } 

        return $this->add_zone_name_transaction->handle(
            zone_id: $zone->id,
            value: $name,
            user_id: $this->authorization->getUserId()
        );
    }

    public function setPrimaryZoneName(
        ZoneEntity $zone,
        ZoneNameVO $zone_name
    ): ServiceResult {
        if(!$this->authorization->canSetPrimaryZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canSetPrimaryZoneName($zone)) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        if ($zone->id != $zone_name->zone_id) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_NAME_NOT_FOUND
            );
        }

        if ($zone_name->is_primary){
            return ServiceResult::failure(
                ErrorMessage::ZONE_NAME_ALREADY_PRIMARY
            );
        }

        return $this->set_primary_zone_name_transaction->handle(
            record_id: $zone_name->record_id,
            zone_id: $zone->id
        );
    }

    public function removeZoneName(
        ZoneEntity $zone
    ): ServiceResult {
        if(!$this->authorization->canRemoveZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRemoveZoneName($zone)) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        $zone_name = $this->zone_name_repository->findPrimaryByZoneId(
            $zone->id
        );

        if ($zone_name === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_NAME_NOT_FOUND
            );
        }   

        try {
            $this->zone_name_repository->updatePrimary(
                record_id: $zone_name->record_id,
                is_primary: false
            );
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function createZone(
        AreaEntity $area
    ): ServiceResult {
        if(!$this->authorization->canCreateZone()) {
            throw ServiceException::FORBIDDEN();
        }

        try {
            $this->zone_repository->add(
                area_id: $area->id,
                user_id: $this->authorization->getUserId()
            );
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }
       
        return ServiceResult::success();
    }

    public function activateZone(
        ZoneEntity $zone
    ): ServiceResult {
        if(!$this->authorization->canActivateZone()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canActivateZone($zone)) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        return $this->changeStatus(
            $zone->id,
            ZoneStatusEnum::Active
        );
    }

    public function markZoneAsCrowded(
        ZoneEntity $zone
    ): ServiceResult {
        if(!$this->authorization->canMarkZoneAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canMarkZoneAsCrowded($zone)) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        return $this->changeStatus(
            $zone->id,
            ZoneStatusEnum::Crowded
        );
    }

    public function archiveZone(
        ZoneEntity $zone
    ): ServiceResult {
         if(!$this->authorization->canArchiveZone()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canArchiveZone($zone)) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }

        return $this->changeStatus(
            $zone->id,
            ZoneStatusEnum::Archived
        );
    }
}