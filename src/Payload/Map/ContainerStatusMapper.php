<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ContainerStatusEnum;

final class ContainerStatusMapper implements Mapper{
    public static function match(
        string $field
    ): ContainerStatusEnum {
        return match ($field) {
            'Registered'   => ContainerStatusEnum::Registered,
            'Active'    => ContainerStatusEnum::Active,
            'Crowded'   => ContainerStatusEnum::Crowded,
            'Archived'  => ContainerStatusEnum::Archived,
            'Lost'      => ContainerStatusEnum::Lost,
            default     => throw DomainException::CONTAINER_STATUS_INVALID_TYPE()
        };
    }
}
