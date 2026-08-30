<?php
namespace WarehouseCore\Config;

use WarehouseCore\Contract\Config;

final readonly class ApiConfig implements Config{
    use ConfigHelper;
    public function __construct(
        public string $add_area_name,
        public string $set_primary_area_name,
        public string $remove_area_name,
        public string $grant_area_access,
        public string $revoke_area_access,
        public string $create_area,
        public string $activate_area,
        public string $mark_area_as_crowded,
        public string $archive_area,
        public string $list_area,

        public string $add_zone_name,
        public string $set_primary_zone_name,
        public string $remove_zone_name,
        public string $create_zone,
        public string $activate_zone,
        public string $mark_zone_as_crowded,
        public string $archive_zone,


        public string $create_user,
        public string $create_user_identity,
        public string $create_physical_tag,
        public string $assign_physical_tag,
        public string $create_container,
        public string $place_item,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            add_area_name: self::requiredString($raw, 'AddAreaName'),
            set_primary_area_name: self::requiredString($raw, 'SetPrimaryAreaName'),
            remove_area_name: self::requiredString($raw, 'RemoveAreaName'),
            grant_area_access: self::requiredString($raw, 'GrantAreaAccess'),
            revoke_area_access: self::requiredString($raw, 'RevokeAreaAccess'),
            create_area: self::requiredString($raw, 'CreateArea'),
            activate_area: self::requiredString($raw, 'ActivateArea'),
            mark_area_as_crowded: self::requiredString($raw, 'MarkAreaAsCrowded'),
            archive_area: self::requiredString($raw, 'ArchiveArea'),
            list_area: self::requiredString($raw, 'ListArea'),

            add_zone_name: self::requiredString($raw, 'AddZoneName'),
            set_primary_zone_name: self::requiredString($raw, 'SetPrimaryZoneName'),
            remove_zone_name: self::requiredString($raw, 'RemoveZoneName'),
            create_zone: self::requiredString($raw, 'CreateZone'),
            activate_zone: self::requiredString($raw, 'ActivateZone'),
            mark_zone_as_crowded: self::requiredString($raw, 'MarkZoneaAsCrowded'),
            archive_zone: self::requiredString($raw, 'ArchiveZone'),


            
            create_user: self::requiredString($raw, 'CreateUser'),
            create_user_identity: self::requiredString($raw, 'CreateUserIdentity'),
            create_physical_tag: self::requiredString($raw, 'CreatePhysicalTag'),
            assign_physical_tag: self::requiredString($raw, 'AssignPhysicalTag'),
            create_container: self::requiredString($raw, 'CreateContainer'),
            place_item: self::requiredString($raw, 'PlaceItem')
        );
    }
}