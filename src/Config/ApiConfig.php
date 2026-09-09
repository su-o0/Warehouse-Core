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

        public string $add_zone_name,
        public string $set_primary_zone_name,
        public string $remove_zone_name,
        public string $create_zone,
        public string $activate_zone,
        public string $mark_zone_as_crowded,
        public string $archive_zone,

        public string $list_area,
        public string $list_area_names,
        public string $list_zone_by_area,
        public string $list_zone_names,
        public string $list_user,
        public string $list_user_names,
        public string $list_user_identities,
        public string $list_rack,
        public string $list_rack_names,
        public string $list_rack_by_area,
        public string $list_rack_by_zone,

        public string $create_user,
        public string $activate_user,
        public string $archive_user,
        public string $assign_user_role,
        public string $dismiss_user_role,
        public string $add_user_identity,
        public string $remove_user_identity,
        public string $add_user_name,
        public string $set_primary_user_name,
        public string $remove_user_name,

        public string $register_rack,
        public string $activate_rack,
        public string $archive_rack,
        public string $populate_rack,
        public string $place_rack_to_area,
        public string $place_rack_to_zone,
        public string $move_rack_to_area,
        public string $move_rack_to_zone,
        public string $set_primary_rack_name,
        public string $add_rack_name,
        public string $remove_rack_name,

        public string $create_physical_tag,
        public string $assign_physical_tag,
        public string $create_container,
        public string $place_item,

        public string $register_shelf,
        public string $mark_shelf_as_crowded,
        public string $remove_shelf,

        public string $register_storage_slot,
        public string $mark_storage_slot_as_crowded,
        public string $remove_storage_slot,
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

            add_zone_name: self::requiredString($raw, 'AddZoneName'),
            set_primary_zone_name: self::requiredString($raw, 'SetPrimaryZoneName'),
            remove_zone_name: self::requiredString($raw, 'RemoveZoneName'),
            create_zone: self::requiredString($raw, 'CreateZone'),
            activate_zone: self::requiredString($raw, 'ActivateZone'),
            mark_zone_as_crowded: self::requiredString($raw, 'MarkZoneaAsCrowded'),
            archive_zone: self::requiredString($raw, 'ArchiveZone'),

            list_area: self::requiredString($raw, 'ListArea'),
            list_area_names: self::requiredString($raw, 'ListAreaNames'),
            list_zone_by_area: self::requiredString($raw, 'ListZoneByArea'),
            list_zone_names: self::requiredString($raw, 'ListZoneNames'),
            list_user: self::requiredString($raw, 'ListUser'),
            list_user_names: self::requiredString($raw, 'ListUserNames'),
            list_user_identities: self::requiredString($raw, 'ListUserIdentities'),
            list_rack: self::requiredString($raw, 'ListRack'),
            list_rack_names: self::requiredString($raw, 'ListRackNames'),
            list_rack_by_area: self::requiredString($raw, 'ListRackByArea'),
            list_rack_by_zone: self::requiredString($raw, 'ListRackByZone'),

            create_user: self::requiredString($raw, 'CreateUser'),
            activate_user: self::requiredString($raw, 'ActivateUser'),
            archive_user: self::requiredString($raw, 'ArchiveUser'),
            assign_user_role: self::requiredString($raw, 'AssignUserRole'),
            dismiss_user_role: self::requiredString($raw, 'DismissUserRole'),
            add_user_identity: self::requiredString($raw, 'AddUserIdentity'),
            remove_user_identity: self::requiredString($raw, 'RemoveUserIdentity'),
            add_user_name: self::requiredString($raw, 'AddUserName'),
            set_primary_user_name: self::requiredString($raw, 'SetPrimaryUserName'),
            remove_user_name: self::requiredString($raw, 'RemoveUserName'),

            register_rack: self::requiredString($raw, 'RegisterRack'),
            activate_rack: self::requiredString($raw, 'ActivateRack'),
            archive_rack: self::requiredString($raw, 'ArchiveRack'),
            populate_rack: self::requiredString($raw, 'PopulateRack'),
            place_rack_to_area: self::requiredString($raw, 'PlaceRackToArea'),
            place_rack_to_zone: self::requiredString($raw, 'PlaceRackToZone'),
            move_rack_to_area: self::requiredString($raw, 'MoveRackToArea'),
            move_rack_to_zone: self::requiredString($raw, 'MoveRackToZone'),
            add_rack_name: self::requiredString($raw, 'AddRackName'),
            set_primary_rack_name: self::requiredString($raw, 'SetPrimaryRackName'),
            remove_rack_name: self::requiredString($raw, 'RemoveRackName'),

            create_physical_tag: self::requiredString($raw, 'CreatePhysicalTag'),
            assign_physical_tag: self::requiredString($raw, 'AssignPhysicalTag'),
            create_container: self::requiredString($raw, 'CreateContainer'),
            place_item: self::requiredString($raw, 'PlaceItem'),
            
            register_shelf: self::requiredString($raw, 'RegisterShelf'),
            mark_shelf_as_crowded: self::requiredString($raw, 'MarkShelfAsCrowded'),
            remove_shelf: self::requiredString($raw, 'RemoveShelf'),

            register_storage_slot: self::requiredString($raw, 'RegisterStorageSlot'),
            mark_storage_slot_as_crowded: self::requiredString($raw, 'MarkStorageSlotAsCrowded'),
            remove_storage_slot: self::requiredString($raw, 'RemoveStorageSlot'),
        );
    }
}