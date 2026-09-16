<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class ZoneApiConfig {
    use ConfigHelper;

    public function __construct(
        public ApiConfigDTO $add_zone_name,
        public ApiConfigDTO $set_primary_zone_name,
        public ApiConfigDTO $remove_zone_name,
        public ApiConfigDTO $create_zone,
        public ApiConfigDTO $activate_zone,
        public ApiConfigDTO $mark_zone_as_crowded,
        public ApiConfigDTO $archive_zone,
        public ApiConfigDTO $place_zone_to_area,
        public ApiConfigDTO $move_zone_to_area,
        public ApiConfigDTO $remove_zone_to_area,
        public ApiConfigDTO $list_zone,
        public ApiConfigDTO $list_zone_by_area,
        public ApiConfigDTO $list_zone_names
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            add_zone_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'AddZoneName')
            ),
            set_primary_zone_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'SetPrimaryZoneName')
            ),
            remove_zone_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveZoneName')
            ),
            create_zone: ApiConfigDTO::fromRaw(
                self::required($raw, 'CreateZone')
            ),
            activate_zone: ApiConfigDTO::fromRaw(
                self::required($raw, 'ActivateZone')
            ),
            mark_zone_as_crowded: ApiConfigDTO::fromRaw(
                self::required($raw, 'MarkZoneAsCrowded')
            ),
            archive_zone: ApiConfigDTO::fromRaw(
                self::required($raw, 'ArchiveZone')
            ),
            place_zone_to_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'PlaceZoneToArea')
            ),
            move_zone_to_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'MoveZoneToArea')
            ),
            remove_zone_to_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveZoneToArea')
            ),
            list_zone: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListZone')
            ),
            list_zone_by_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListZoneByArea')
            ),
            list_zone_names: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListZoneNames')
            ),
        );
    }
}