<?php
namespace WarehouseCore\Config;

final readonly class TransactionConfig {
    use ConfigHelper;
    public function __construct(
        public string $create_area,
        public string $add_area_name,
        public string $set_primary_area_name,

        public string $add_zone_name,
        public string $set_primary_zone_name,
        
        public string $assign_user_role,
        public string $dismiss_user_role,
        public string $add_user_name,
        public string $set_primary_user_name,
        public string $remove_user_name,
        public string $add_user_identity,
        public string $remove_user_identity,

        public string $populate_rack,
        public string $activate_rack,
        public string $archive_rack,
        public string $add_rack_name,
        public string $set_primary_rack_name,
        public string $remove_rack_name,

        public string $register_shelf,
        public string $remove_shelf,

        public string $register_storage_slot,

    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            create_area: self::requiredString($raw, 'CreateArea'),
            add_area_name: self::requiredString($raw, 'AddAreaName'),
            set_primary_area_name: self::requiredString($raw, 'SetPrimaryAreaName'),
            
            add_zone_name: self::requiredString($raw, 'AddZoneName'),
            set_primary_zone_name: self::requiredString($raw, 'SetPrimaryZoneName'),

            assign_user_role: self::requiredString($raw, 'AssignUserRole'),
            dismiss_user_role: self::requiredString($raw, 'DismissUserRole'),
            add_user_name: self::requiredString($raw, 'AddUserName'),
            set_primary_user_name: self::requiredString($raw, 'SetPrimaryUserName'),
            remove_user_name: self::requiredString($raw, 'RemoveUserName'),
            add_user_identity: self::requiredString($raw, 'AddUserIdentity'),
            remove_user_identity: self::requiredString($raw, 'RemoveUserIdentity'),
        
            populate_rack: self::requiredString($raw, 'PopulateRack'),
            activate_rack: self::requiredString($raw, 'ActivateRack'),
            archive_rack: self::requiredString($raw, 'ArchiveRack'),
            add_rack_name: self::requiredString($raw, 'AddRackName'),
            set_primary_rack_name: self::requiredString($raw, 'SetPrimaryRackName'),
            remove_rack_name: self::requiredString($raw, 'RemoveRackName'),

            register_shelf: self::requiredString($raw, 'RegisterShelf'),
            remove_shelf: self::requiredString($raw, 'RemoveShelf'),

            register_storage_slot: self::requiredString($raw, 'RegisterStorageSlot'),
        );
    }
} 