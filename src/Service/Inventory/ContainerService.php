<?php
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Repository\Inventory\ContainerRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Value\ContainerTypeValue;
use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Security\Authorization;

final class ContainerService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ContainerRepository $container_repository
    ) { }

    public function add(
        string $container_id, 
        string $type
    ): ServiceResult {

        return new ServiceResult(
            success: true
        );
}
}
