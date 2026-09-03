<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\ZoneStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Transaction\Zone\AddZoneNameTransaction;
use WarehouseCore\Transaction\Zone\SetPrimaryZoneNameTransaction;
use WarehouseCore\Transaction\Zone\CreateZoneTransaction;

final class ZoneService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ZoneRepository $zone_repository,
        private ZoneNameRepository $zone_name_repository,
        private CreateZoneTransaction $create_zone_transaction,
        private AddZoneNameTransaction $add_zone_name_transaction,
        private SetPrimaryZoneNameTransaction $set_primary_zone_name_transaction
    ) { }

    private function existsZone(
        int $id
    ): ServiceResult {
        try { 
            $result = $this->zone_repository->getById($id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    private function existsZoneName(
        int $record_id
    ): ServiceResult {
        try { 
            $result = $this->zone_name_repository->findByRecordId($record_id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_NAME_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

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
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }

    public function addZoneName(
        int $zone_id,
        string $name
    ): ServiceResult {
        if(!$this->authorization->canAddZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsZone($zone_id);

        if(!$result->success) {
            return $result;
        }

        $zone = $result->entity;

        if (!in_array(
            $zone->status,
            [
                ZoneStatusEnum::Active,
                ZoneStatusEnum::Crowded
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_INVALID_STATUS_TRANSITION
            );
        }
        
        $result = $this->zone_name_repository->findByZoneIdAndValue(
            zone_id: $zone_id,
            value: $name
        );

        if($result !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NAME_ALREADY_EXISTS
            );
        } 
        return $this->add_zone_name_transaction->handle(
            $zone->id,
            $name,
            $this->authorization->user->id
        );
    }

    public function setPrimaryZoneName(
        int $zone_id,
        int $record_id,
    ): ServiceResult {
        if(!$this->authorization->canSetPrimaryZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsZone($zone_id);

        if(!$result->success) {
            return $result;
        }

        $zone = $result->entity;
        $result = $this->existsZoneName($record_id);

        if(!$result->success) {
            return $result;
        }

        $zone_name = $result->entity;
        
        if ($zone->id != $zone_name->zone_id) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_NAME_NOT_FOUND
            );
        }

        if ($zone_name->is_primary){
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_NAME_ALREADY_PRIMARY
            );
        }

        return $this->set_primary_zone_name_transaction->handle(
            $record_id,
            $zone_name->zone_id
        );
    }

    public function removeZoneName(
        int $zone_id
    ): ServiceResult {
        if(!$this->authorization->canRemoveZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsZone($zone_id);

        if(!$result->success) {
            return $result;
        }

        $zone_name = $this->zone_name_repository->findPrimaryByZoneId($zone_id);

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
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }

    public function createZone(
        int $area_id
    ): ServiceResult {
        if(!$this->authorization->canCreateZone()) {
            throw ServiceException::FORBIDDEN();
        }

        return $this->create_zone_transaction->handle(
            $area_id,
            $this->authorization->user->id
        );
    }


    public function activateZone(
        int $zone_id
    ): ServiceResult {
        if(!$this->authorization->canActivateZone()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsZone($zone_id);

        if(!$result->success) {
            return $result;
        }
        
        $zone = $result->entity;

        if (!in_array(
            $zone->status,
            [
                ZoneStatusEnum::Created,
                ZoneStatusEnum::Archived,
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $zone->id,
            ZoneStatusEnum::Active
        );
    }

    public function markZoneAsCrowded(
        int $zone_id
    ): ServiceResult {
        if(!$this->authorization->canMarkZoneAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsZone($zone_id);

        if(!$result->success) {
            return $result;
        }

        $zone = $result->entity;

        if (!in_array(
            $zone->status,
            [
                ZoneStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $zone->id,
            ZoneStatusEnum::Crowded
        );
    }

    public function archiveZone(
        int $zone_id
    ): ServiceResult {
         if(!$this->authorization->canArchiveZone()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsZone($zone_id);

        if(!$result->success) {
            return $result;
        }

        $zone = $result->entity;

        if (!in_array(
            $zone->status,
            [
                ZoneStatusEnum::Active,
                ZoneStatusEnum::Crowded

            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_INVALID_STATUS_TRANSITION
            );
        }

        return $this->changeStatus(
            $zone->id,
            ZoneStatusEnum::Archived
        );
    }
}