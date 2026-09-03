<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ListUserResult implements ApiResult {
    public function __construct(
        public bool $success,
        public ?array $list = null,
    ) {}
}