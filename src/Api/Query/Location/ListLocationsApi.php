<?php
namespace WarehouseCore\Api\Query\Location;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Result\ListLocationsResult;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Query\GetService;

final class ListLocationsApi {
    public function __construct(
        public string $api_name,
        private GetService $get,
    ) { }
    public function handle(
    ): ApiResult {
        try {
            $result = $this->get->getAllLocation();
        } catch (DomainException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }   
        
        return new ListLocationsResult(
            list: $result
        );
    }
}