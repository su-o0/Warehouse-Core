<?php
namespace WarehouseCore\Service\Query;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\DTO\StructureDTO;
use WarehouseCore\Payload\Result\ListStructureResult;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
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
                $this->authorization->user->id
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
        int $area_id
    ): ApiResult {
        if(!$this->authorization->canListZone()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $area = $this->area_repository->getById($area_id);

        if ($area === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NOT_FOUND
            );
        }

        $zones = $this->zone_repository->findByAreaId($area->id);

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
}