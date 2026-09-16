<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ApiDomainEnum;

final class ApiDomainMapper implements Mapper {
    public static function match(
        string $field
    ): ApiDomainEnum {
        return match($field){
            'area'   => ApiDomainEnum::Area,
            'container'     => ApiDomainEnum::Container,
            'user'     => ApiDomainEnum::Container,
            'item'     => ApiDomainEnum::Item,
            'movement'     => ApiDomainEnum::Movement,
            'owner'     => ApiDomainEnum::Owner,
            'part'     => ApiDomainEnum::Part,
            'photo'     => ApiDomainEnum::Photo,
            'physical_tag'     => ApiDomainEnum::PhysicalTag,
            'placement'     => ApiDomainEnum::Placement,
            'rack'     => ApiDomainEnum::Rack,
            'sales'     => ApiDomainEnum::Sales,
            'shelf'     => ApiDomainEnum::Shelf,
            'storage_slot'     => ApiDomainEnum::StorageSlot,
            'stock'     => ApiDomainEnum::Stock,
            'vehicle'     => ApiDomainEnum::Vehicle,
            'video'     => ApiDomainEnum::Video,
            'zone'     => ApiDomainEnum::Zone,
            'find'     => ApiDomainEnum::Find,
            default     => throw DomainException::API_TYPE_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): ApiDomainEnum {
        return self::match($raw[$field]);
    }
}