<?php
namespace WarehouseCore\Api\Query\Location;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Request\GetLocationRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Result\GetLocationResult;
use WarehouseCore\Service\Query\GetService;

final class GetLocationApi {
    public function __construct(
        public string $api_name,
        private GetService $get,
    ) { }

    public function handle(
        GetLocationRequest $request
    ): ApiResult {
        try {
            $result = $this->get->getLocation($request->id);
        } catch (DomainException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }   

        return new GetLocationResult(
            entity: $result
        );
    }
}