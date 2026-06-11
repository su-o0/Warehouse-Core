<?php
namespace WarehouseCore\Payload\Result;

final class AddUserResult {
    public function __construct(
        public bool $success,
        public ?int $userId = null,
        public ?string $message = null,
    ) {}
}