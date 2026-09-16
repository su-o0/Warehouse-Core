<?php 
namespace WarehouseCore\Api\Shelf\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ShelfService;

final class RegisterShelfApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private ShelfService $shelf_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getRack(
            $parameter->id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->shelf_service->registerShelf(
            rack: $result->entity
        );
    }
}