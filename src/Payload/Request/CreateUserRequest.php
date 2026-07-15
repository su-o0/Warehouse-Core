<?php
namespace WarehouseCore\Payload\Request;

final class CreateUserRequest {
    public function __construct(
        public string $name,
        public string $role
    ) {}
}