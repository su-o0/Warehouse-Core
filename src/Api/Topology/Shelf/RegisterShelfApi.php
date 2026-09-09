<?php 
namespace WarehouseCore\Api\Topology\Shelf;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ShelfService;

final class RegisterShelfApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private ShelfService $shelf_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getRack(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        return $this->shelf_service->registerShelf(
            rack: $rack
        );
    }
}