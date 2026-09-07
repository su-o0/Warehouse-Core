<?php
namespace WarehouseCore\Payload\Result;

use WarehouseCore\Contract\ApiResult;

final class ServiceResult implements ApiResult{
    public function __construct(
        public bool $success,
        public mixed $entity = null,
        public ?string $message = null,
    ) {}

    public static function success(
    ): self {
        return new self(
            success: true
        );
    }

    public static function entity(
        mixed $entity
    ): self {
        return new self(
            success: true,
            entity: $entity
        );
    }

    public static function failure(
        string $message
    ): self {
        return new self(
            success: false,
            message: $message
        );
    }
}