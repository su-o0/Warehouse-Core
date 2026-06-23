<?php
namespace WarehouseCore\Payload\Result;

class ServiceResult {
    public function __construct(
        public bool $success,
        public mixed $data = null,
        public ?string $message = null,
    ) {}
}
