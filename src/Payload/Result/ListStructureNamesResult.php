<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ListStructureNamesResult implements ApiResult {
    public function __construct(
        public bool $success,
        public string $structure_name,
        public ?array $list = null,
    ) {}
}