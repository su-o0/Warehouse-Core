<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Type\ContainerType;

final class ContainerTypeValue {

    public static function fromRaw(string $raw): ContainerType {
        return match($raw){
            'Box' => ContainerType::Box,
            'Pallet' => ContainerType::Pallet,
            default => DomainException::CONTAINER_INVALID_TYPE()
        };
    }
}