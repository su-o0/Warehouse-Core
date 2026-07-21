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
        );
    }
}