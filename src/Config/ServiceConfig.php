<?php
namespace WarehouseCore\Config;

final class ServiceConfig {
    use ConfigHelper;
    public function __construct(
        public readonly string $sales,
        public readonly string $telemetry,
        public readonly string $part,
        public readonly string $vehicle,
        public readonly string $authentication,
        public readonly string $authorization,
        public readonly string $owner,
        public readonly string $physical_tag,
        public readonly string $user_identity,
        public readonly string $user,
        public readonly string $container,
        public readonly string $item,
        public readonly string $stock,
        public readonly string $photo,
        public readonly string $find,
        public readonly string $get,
        public readonly string $location,
        public readonly string $movement,
        public readonly string $placement,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            sales: self::requiredString($raw, 'Sales'),
            telemetry: self::requiredString($raw, 'Telemetry'),
            part: self::requiredString($raw, 'Part'),
            vehicle: self::requiredString($raw, 'Vehicle'),
            authentication: self::requiredString($raw, 'Authentication'),
            authorization: self::requiredString($raw, 'Authorization'),
            owner: self::requiredString($raw, 'Owner'),
            physical_tag: self::requiredString($raw, 'PhysicalTag'),
            user_identity: self::requiredString($raw, 'UserIdentity'),
            user: self::requiredString($raw, 'User'),
            container: self::requiredString($raw, 'Container'),
            item: self::requiredString($raw, 'Item'),
            stock: self::requiredString($raw, 'Stock'),
            photo: self::requiredString($raw, 'Photo'),
            find: self::requiredString($raw, 'Find'),
            get: self::requiredString($raw, 'Get'),
            location: self::requiredString($raw, 'Location'),
            movement: self::requiredString($raw, 'Movement'),
            placement: self::requiredString($raw, 'Placement'),
        );
    }
}