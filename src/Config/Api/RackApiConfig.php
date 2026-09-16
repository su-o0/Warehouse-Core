<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class RackApiConfig {
    use ConfigHelper;

    public function __construct(
        public ApiConfigDTO $register_rack,
        public ApiConfigDTO $activate_rack,
        public ApiConfigDTO $archive_rack,
        public ApiConfigDTO $populate_rack,
        public ApiConfigDTO $add_rack_name,
        public ApiConfigDTO $set_primary_rack_name,
        public ApiConfigDTO $remove_rack_name,
        public ApiConfigDTO $list_rack,
        public ApiConfigDTO $list_rack_names,
        public ApiConfigDTO $list_rack_by_area,
        public ApiConfigDTO $list_rack_by_zone
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            register_rack: ApiConfigDTO::fromRaw(
                self::required($raw, 'RegisterRack')
            ),
            activate_rack: ApiConfigDTO::fromRaw(
                self::required($raw, 'ActivateRack')
            ),
            archive_rack: ApiConfigDTO::fromRaw(
                self::required($raw, 'ArchiveRack')
            ),
            populate_rack: ApiConfigDTO::fromRaw(
                self::required($raw, 'PopulateRack')
            ),
            add_rack_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'AddRackName')
            ),
            set_primary_rack_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'SetPrimaryRackName')
            ),
            remove_rack_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveRackName')
            ),
            list_rack: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListRack')
            ),
            list_rack_names: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListRackNames')
            ),
            list_rack_by_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListRackByArea')
            ),
            list_rack_by_zone: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListRackByZone')
            )
        );
    }
}