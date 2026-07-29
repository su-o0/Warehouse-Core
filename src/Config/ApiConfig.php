<?php
namespace WarehouseCore\Config;

final readonly class ApiConfig {
    use ConfigHelper;
    public function __construct(
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
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
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
        );
    }
}