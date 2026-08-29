<?php
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\DTO\StructureDTO;
use WarehouseCore\Payload\Result\ListResult;
use WarehouseCore\Payload\Result\ListStructureResult;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Security\Authorization;

final class ListService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private AreaRepository $area_repository,
        private AreaNameRepository $area_name_repository,
        private AreaAccessRepository $area_access_repository
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
}