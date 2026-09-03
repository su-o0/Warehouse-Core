<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ListEntityNamesResult implements ApiResult {
    public function __construct(
        public bool $success,
        public string $entity_name,
        public int $entity_id,
        public ?array $list = null,
    ) {}
}