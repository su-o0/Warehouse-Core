<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ServiceResult implements ApiResult{
    public function __construct(
        public bool $success,
        public mixed $entity = null,
        public ?string $message = null,
    ) {}
}
