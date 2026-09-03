<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ListUserIdentitiesResult implements ApiResult {
    public function __construct(
        public bool $success,
        public int $user_id,
        public ?array $list = null
    ) {}
}