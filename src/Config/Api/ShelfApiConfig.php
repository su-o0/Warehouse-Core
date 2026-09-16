<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class ShelfApiConfig {
    use ConfigHelper;

    public function __construct(
        public ApiConfigDTO $register_shelf,
        public ApiConfigDTO $mark_shelf_as_crowded,
        public ApiConfigDTO $remove_shelf,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            register_shelf: ApiConfigDTO::fromRaw(
                self::required($raw, 'RegisterShelf')
            ),
            mark_shelf_as_crowded: ApiConfigDTO::fromRaw(
                self::required($raw, 'MarkShelfAsCrowded')
            ),
            remove_shelf: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveShelf')
            )
        ); 
    }
}