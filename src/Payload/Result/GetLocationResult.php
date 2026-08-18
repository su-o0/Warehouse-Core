<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Entity\LocationEntity;

final class GetLocationResult implements ApiResult {
    public function __construct(
        public LocationEntity $entity
    ) { }
}