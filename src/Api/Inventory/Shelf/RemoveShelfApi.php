<?php 
namespace WarehouseCore\Api\Inventory\Shelf;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ShelfService;

final class RemoveShelfApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private FindService $find_service,
        private ShelfService $shelf_service
    ) { }

    public function handle(
        EntityRecordRequest $request
    ): ApiResult {
        $result = $this->get_service->getRack(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        $result = $this->find_service->findShelfByRackIdAndShelfLevel(
            $rack,
            $request->record_id
        );

        if (!$result->success) {
            return $result;
        }

        $shelf = $result->entity;

        
        return $this->shelf_service->removeShelf(
            rack: $rack,
            shelf: $shelf
        );
    }
}