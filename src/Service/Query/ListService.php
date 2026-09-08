<?php
namespace WarehouseCore\Service\Query;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\DTO\EntityNamesDTO;
use WarehouseCore\Payload\DTO\StructureDTO;
use WarehouseCore\Payload\DTO\UserDTO;
use WarehouseCore\Payload\DTO\UserIdentityDTO;
use WarehouseCore\Payload\Entity\AreaEntity;
use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Entity\ZoneEntity;
use WarehouseCore\Payload\Hydrate\UserStageHydrator;
use WarehouseCore\Payload\Result\ListEntityNamesResult;
use WarehouseCore\Payload\Result\ListStructureResult;
use WarehouseCore\Payload\Result\ListUserIdentitiesResult;
use WarehouseCore\Payload\Result\ListUserResult;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Catalog\UserNameRepository;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Security\Authorization;

final class ListService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private AreaRepository $area_repository,
        private AreaNameRepository $area_name_repository,
        private AreaAccessRepository $area_access_repository,
        private UserRepository $user_repository,
        private UserNameRepository $user_name_repository,
        private UserIdentityRepository $user_identity_repository,
        private UserProcessingStepRepository $user_processing_stage_repository,
        private ZoneRepository $zone_repository,
        private ZoneNameRepository $zone_name_repository,

    ) { }

    public function listArea(): ListStructureResult {
        if(!$this->authorization->canListArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $areas = $this->area_repository->list();

        $result = [];
        foreach($areas as $area) {
            $access = $this->area_access_repository->findByAreaIdAndUserId(
                $area->id,
                $this->authorization->getUserId()
            );
            
            if ($access === null) {
                continue;
            }

            $area_name = $this->area_name_repository->findPrimaryByAreaId(
                $area->id
            );

            array_push($result, 
                new StructureDTO(
                    id: $area->id,
                    name: ($area_name !== null)?
                        $area_name->value :
                        null,
                    status: $area->status
                ) 
            );
        }

        return new ListStructureResult(
            success: true,
            structure_name: 'Area',
            list: $result
        );
    }

    public function listZoneByArea(
        AreaEntity $area
    ): ApiResult {
        if(!$this->authorization->canListZoneByArea()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $zones = $this->zone_repository->findByAreaId(
            $area->id
        );

        $result = [];
        foreach($zones as $zone) {
            $zone_name = $this->zone_name_repository->findPrimaryByZoneId(
                $area->id
            );

            array_push($result, 
                new StructureDTO(
                    id: $area->id,
                    name: ($zone_name !== null)?
                        $zone_name->value :
                        null,
                    status: $zone->status
                ) 
            );
        }

        return new ListStructureResult(
            success: true,
            structure_name: 'Zone',
            list: $result
        );
    }

    public function listAreaNames(
        AreaEntity $area
    ): ApiResult {
        if(!$this->authorization->canListAreaNames()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $area_names = $this->area_name_repository->findByAreaId(
            $area->id
        );

        $result = [];
        foreach($area_names as $area_name) {
            array_push($result, 
                new EntityNamesDTO(
                    record_id: $area_name->record_id,
                    name: $area_name->value,
                    is_primary: $area_name->is_primary
                ) 
            );
        }

        return new ListEntityNamesResult(
            success: true,
            entity_name: 'Area',
            entity_id: $area->id,
            list: $result
        );
    }

    public function listZoneNames(
        ZoneEntity $zone
    ): ApiResult {
        if(!$this->authorization->canListZoneNames()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $zone_names = $this->zone_name_repository->findByZoneId(
            $zone->id
        );

        $result = [];
        foreach($zone_names as $zone_name) {

            array_push($result, 
                new EntityNamesDTO(
                    record_id: $zone_name->record_id,
                    name: $zone_name->value,
                    is_primary: $zone_name->is_primary
                ) 
            );
        }

        return new ListEntityNamesResult(
            success: true,
            entity_name: 'Zone',
            entity_id: $zone->id,
            list: $result
        );
    }

    public function listUser(): ListUserResult {
        if(!$this->authorization->canListUser()) {
            throw ServiceException::FORBIDDEN();
        }

        $users = $this->user_repository->list();

        $result = [];
        foreach($users as $user) {
            $user_name = $this->user_name_repository->findPrimaryByUserId(
                $user->id
            );

            $user_step = UserStageHydrator::hydrate(
                $this->user_processing_stage_repository->findByUserId(
                    $user->id
                )
            );

            array_push($result, 
                new UserDTO(
                    id: $user->id,
                    role: $user->role,
                    name: ($user_name !== null)?
                        $user_name->value :
                        null,
                    status: $user->status,
                    step: $user_step
                ) 
            );
        }

        return new ListUserResult(
            success: true,
            list: $result
        );
    }

    public function listUserIdentities(
        UserEntity $user
    ): ApiResult {
        if(!$this->authorization->canListUserIdentities()) {
            throw ServiceException::FORBIDDEN();
        }

        $identities = $this->user_identity_repository->findByUserId(
            $user->id
        );

        if (count($identities) == 0) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_IDENTITIES_NOT_FOUND
            );
        }

        $result = [];
        foreach($identities as $identity) {
            array_push($result, 
                new UserIdentityDTO(
                    record_id: $identity->record_id,
                    provider: $identity->provider,
                    external_id: $identity->external_id
                ) 
            );
        }

        return new ListUserIdentitiesResult(
            success: true,
            user_id: $user->id,
            list: $result
        );
    }


    public function listUserNames(
        UserEntity $user
    ): ApiResult {
        if(!$this->authorization->canListUserNames()) {
            throw ServiceException::FORBIDDEN();
        }

        $user_names = $this->user_name_repository->findByUserId(
            $user->id
        );

        $result = [];
        foreach($user_names as $user_name) {
            array_push($result, 
                new EntityNamesDTO(
                    record_id: $user_name->record_id,
                    name: $user_name->value,
                    is_primary: $user_name->is_primary
                ) 
            );
        }

        return new ListEntityNamesResult(
            success: true,
            entity_name: 'User',
            entity_id: $user->id,
            list: $result
        );
    }
}