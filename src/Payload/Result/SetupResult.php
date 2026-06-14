<?php
namespace WarehouseCore\Payload\Result;

class SetupResult {
    public function __construct(
        public bool $success,
        public ?string $message = null,
    ){ }
}