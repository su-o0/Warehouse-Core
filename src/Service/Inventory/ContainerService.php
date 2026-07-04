<?php
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Repository\Inventory\ContainerRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Value\ContainerTypeValue;
use WarehouseCore\Payload\Result\SetupResult;

final class ContainerService {
    public function __construct(
        private ContainerRepository $container_repository
    ) { }

    public function add(
        string $container_id, 
        string $type
    ): SetupResult {

        $container_entity = $this->container_repository->findById(
            $container_id
        );
        if($container_entity !== null)
            return new SetupResult(
                success: false,
                message: DomainException::CONTAINER_ALREADY_EXISTS()->getMessage()
            );

        try {
            ContainerTypeValue::fromString(
                $type
            );
        }catch(DomainException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        try {
            $this->container_repository->add(
                $container_id, 
                $type
            );
        }
        catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true
        );
}
}
