<?php 
namespace WarehouseCore\Api\Shelf\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ShelfService;

final class MarkShelfAsCrowdedApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private FindService $find_service,
        private ShelfService $shelf_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getRack(
            $parameter->rack_id
        );

        if (!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        $result = $this->find_service->findShelfByRackIdAndShelfLevel(
            $rack,
            $parameter->record_id
        );

        if (!$result->success) {
            return $result;
        }

        $shelf = $result->entity;
        
        return $this->shelf_service->markShelfAsCrowded(
            rack: $rack,
            shelf: $shelf
        );
    }
}