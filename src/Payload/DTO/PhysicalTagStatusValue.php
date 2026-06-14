<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Type\PhysicalTagType;

final class PhysicalTagStatusValue {

    public static function fromRaw(string $raw): PhysicalTagType {
        return match($raw){
            'Free' => PhysicalTagType::Free,
            'Assigned' => PhysicalTagType::Assigned,
            'Lost' => PhysicalTagType::Lost,
            'Broken' => PhysicalTagType::Broken,
            default => DomainException::PHYSICAL_TAG_INVALID_STATUS()
        };
    }
}