<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class AreaApiConfig {
    use ConfigHelper;

    public function __construct(
        public ApiConfigDTO $add_area_name,
        public ApiConfigDTO $set_primary_area_name,
        public ApiConfigDTO $remove_area_name,
        public ApiConfigDTO $grant_area_access,
        public ApiConfigDTO $revoke_area_access,
        public ApiConfigDTO $create_area,
        public ApiConfigDTO $activate_area,
        public ApiConfigDTO $mark_area_as_crowded,
        public ApiConfigDTO $archive_area,
        public ApiConfigDTO $list_area,
        public ApiConfigDTO $list_area_names
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            add_area_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'AddAreaName')
            ),
            set_primary_area_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'SetPrimaryAreaName')
            ),
            remove_area_name: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveAreaName')
            ),
            grant_area_access: ApiConfigDTO::fromRaw(
                self::required($raw, 'GrantAreaAccess')
            ),
            revoke_area_access: ApiConfigDTO::fromRaw(
                self::required($raw, 'RevokeAreaAccess')
            ),
            create_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'CreateArea')
            ),
            activate_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'ActivateArea')
            ),
            mark_area_as_crowded: ApiConfigDTO::fromRaw(
                self::required($raw, 'MarkAreaAsCrowded')
            ),
            archive_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'ArchiveArea')
            ),
            list_area: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListArea')
            ),
            list_area_names: ApiConfigDTO::fromRaw(
                self::required($raw, 'ListAreaNames')
            )
        );
    }
}