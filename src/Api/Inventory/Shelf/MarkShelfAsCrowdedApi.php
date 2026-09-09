<?php 
namespace WarehouseCore\Api\Inventory\Shelf;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ShelfService;

final class MarkShelfAsCrowdedApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private ShelfService $shelf_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getShelf(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $shelf = $result->entity;

        return $this->shelf_service->markShelfAsCrowded(
            shelf: $shelf
        );
    }
}