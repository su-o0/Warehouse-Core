<?php
namespace WarehouseCore\Api\Inventory;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\CreateContainerRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Inventory\ContainerService;
use WarehouseCore\Service\Query\GetService;

final class CreateContainerApi {
    public function __construct(
        public string $api_name,
        private ContainerService $container,
        private GetService $get
    ) { }

    public function handle(
        CreateContainerRequest $request
    ): ServiceResult {
        try {
            $this->get->getContainer($request->id);

            return new ServiceResult(
                success: false,
                message: ErrorMessage::CONTAINER_ALREADY_EXISTS
            );

        } catch (DomainException $e ) {
            if ($e->errorCode !== ErrorCode::CONTAINER_NOT_FOUND) {
                throw $e;
            }

            return $this->container->create(
                $request->id,
                $request->type
            );
        }   
    }
}