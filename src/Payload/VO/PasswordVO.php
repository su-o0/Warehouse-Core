<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;

final class PasswordVO {
    use ConfigHelper;
    public function __construct(
        public int $user_identity_record_id,
        public string $hash,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            user_identity_record_id: self::requiredInt($raw, 'record_id'),
            hash: self::requiredInt($raw, 'hash'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}