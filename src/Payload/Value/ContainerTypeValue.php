<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ContainerType;

final class ContainerTypeValue {
    
    public static function fromRaw(
        array $raw, 
        string $field
    ): ContainerType {
        return match($raw[$field]){
            'Box' => ContainerType::Box,
            'Pallet' => ContainerType::Pallet,
            default => DomainException::CONTAINER_INVALID_TYPE()
        };
    }
}