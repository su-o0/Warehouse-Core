<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ListLocationsResult implements ApiResult {
    public function __construct(
        public array $list
    ) { }
}