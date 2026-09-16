<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class StorageSlotApiConfig {
    use ConfigHelper;

    public function __construct(
        public ApiConfigDTO $register_storage_slot,
        public ApiConfigDTO $mark_storage_slot_as_crowded,
        public ApiConfigDTO $remove_storage_slot
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            register_storage_slot: ApiConfigDTO::fromRaw(
                self::required($raw, 'RegisterStorageSlot')
            ),
            mark_storage_slot_as_crowded: ApiConfigDTO::fromRaw(
                self::required($raw, 'MarkStorageSlotAsCrowded')
            ),
            remove_storage_slot: ApiConfigDTO::fromRaw(
                self::required($raw, 'RemoveStorageSlot')
            )
        );
    }
}