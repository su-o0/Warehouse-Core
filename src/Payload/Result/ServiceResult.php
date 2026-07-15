<?php
namespace WarehouseCore\Payload\Result;

final class ServiceResult {
    public function __construct(
        public bool $success,
        public mixed $entity = null,
        public ?string $message = null,
    ) {}
}
