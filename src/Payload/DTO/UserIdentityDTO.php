<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Payload\Enum\ProviderNameEnum;

final class UserIdentityDTO {
    public function __construct(
        public int $record_id,
        public ProviderNameEnum $provider,
        public string $external_id
    ) {}
}