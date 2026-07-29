<?php 
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\PhysicalTagStatus;

final class PhysicalTagStatusMapper implements Mapper {
    public static function match(
        string $field
    ): PhysicalTagStatus {
        return match($field){
            'Free'      => PhysicalTagStatus::Free,
            'Assigned'  => PhysicalTagStatus::Assigned,
            'Lost'      => PhysicalTagStatus::Lost,
            'Broken'    => PhysicalTagStatus::Broken,
            default     => throw DomainException::PHYSICAL_TAG_STATUS_INVALID_TYPE()
        };
    }
}