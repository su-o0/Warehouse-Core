<?php
namespace WarehouseCore\Service;

use WarehouseCore\Repository\Inventory\ContainerRepository;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Enum\ContainerTypeEnum;
use WarehouseCore\Security\Authorization;

final class ContainerService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ContainerRepository $container_repository
    ) { }

    public function create(
        int $id, 
        ContainerTypeEnum $type
    ): ServiceResult {
        if(!$this->authorization->canCreateContainer()) {
            return new ServiceResult( 
                success: false,
                message: ErrorMessage::AUTHENTICATION_FAILED 
            );
        }

        try {
            $container_id = $this->container_repository->add(
                $this->authorization->user->id,
                $id,
                $type->value
            );

            return new ServiceResult(
                success: true,
                entity: $container_id
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
    }
}
