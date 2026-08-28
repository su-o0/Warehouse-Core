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


        public string $create_user,
        public string $create_user_identity,
        public string $create_physical_tag,
        public string $create_location,
        public string $assign_physical_tag,
        public string $create_container,
        public string $activate_location,
        public string $archive_location,
        public string $get_location,
        public string $list_locations,
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

            
            create_user: self::requiredString($raw, 'CreateUser'),
            create_user_identity: self::requiredString($raw, 'CreateUserIdentity'),
            create_physical_tag: self::requiredString($raw, 'CreatePhysicalTag'),
            create_location: self::requiredString($raw, 'CreateLocation'),
            assign_physical_tag: self::requiredString($raw, 'AssignPhysicalTag'),
            create_container: self::requiredString($raw, 'CreateContainer'),
            activate_location: self::requiredString($raw, 'ActiveteLocation'),
            archive_location: self::requiredString($raw, 'ArchiveLocation'),
            get_location: self::requiredString($raw, 'GetLocation'),
            list_locations: self::requiredString($raw, 'ListLocations'),
            place_item: self::requiredString($raw, 'PlaceItem')
        );
    }
}