<?php
namespace WarehouseCore\Service\Query;

use WarehouseCore\Payload\Result\ListResult;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Security\Authorization;

final class ListService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private AreaRepository $area_repository
    ) { }

    public function listArea(): ListResult {
        $list = $this->area_repository->list();
        
        return new ListResult(
            success: true,
            entity: $list
        );
    }
}