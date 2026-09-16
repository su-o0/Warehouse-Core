<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ApiTypeEnum;

final class ApiTypeMapper implements Mapper {
    public static function match(
        string $field
    ): ApiTypeEnum {
        return match($field){
            'command'   => ApiTypeEnum::Command,
            'query'     => ApiTypeEnum::Query,
            default     => throw DomainException::API_TYPE_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): ApiTypeEnum {
        return self::match($raw[$field]);
    }
}