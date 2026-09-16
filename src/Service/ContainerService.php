<?php
namespace WarehouseCore\Service;

use WarehouseCore\Repository\Inventory\ContainerRepository;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Entity\ContainerEntity;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Enum\ContainerTypeEnum;
use WarehouseCore\Security\Authorization;

final class ContainerService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ContainerRepository $container_repository
    ) { }

    public function registerContainer(
        ContainerTypeEnum $container_type
    ): ServiceResult {

        return ServiceResult::success();
    }

    public function activateContainer(
        ContainerEntity $container
    ): ServiceResult {

        return ServiceResult::success();
    }

    public function markContainerAsCrowded(
        ContainerEntity $container
    ): ServiceResult {

        return ServiceResult::success();
    }

    public function markContainerAsLost(
        ContainerEntity $container
    ): ServiceResult {

        return ServiceResult::success();
    }
    
    public function archiveContainer(
        ContainerEntity $container
    ): ServiceResult {
        
        return ServiceResult::success();
    }
}
