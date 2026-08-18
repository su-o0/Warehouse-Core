<?php 
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\PhysicalTagStatusEnum;

final class PhysicalTagStatusMapper implements Mapper {
    public static function match(
        string $field
    ): PhysicalTagStatusEnum {
        return match($field){
            'Free'      => PhysicalTagStatusEnum::Free,
            'Assigned'  => PhysicalTagStatusEnum::Assigned,
            'Lost'      => PhysicalTagStatusEnum::Lost,
            'Broken'    => PhysicalTagStatusEnum::Broken,
            default     => throw DomainException::PHYSICAL_TAG_STATUS_INVALID_TYPE()
        };
    }
}