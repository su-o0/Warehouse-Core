<?php
namespace WarehouseCore\Payload\Result;

class SetupResult {
    public function __construct(
        public bool $success,
        public ?object $entity = null,
        public ?string $message = null,
    ){ }
}