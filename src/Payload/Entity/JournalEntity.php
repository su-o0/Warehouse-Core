<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;

final readonly class JournalEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public string $previous_hash,
        public string $hash,
        public string $statement,
        public string $parameters,
        public string $metadata,
        public string $started_at,
        public string $finished_at,
        public int $affected_rows,
        public bool $success,
        public string $exception,
        public int $transaction_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            previous_hash: self::nullableString($raw, 'previous_hash'),
            hash: self::requiredString($raw, 'hash'),
            statement: self::nullableString($raw, 'statement'),
            parameters: self::nullableString($raw, 'parameters'),
            metadata: self::nullableString($raw, 'metadata'),
            started_at: self::requiredString($raw, 'started_at'),
            finished_at: self::requiredString($raw, 'finished_at'),
            affected_rows: self::requiredInt($raw, 'affected_rows'),
            success: self::required($raw, 'success'),
            exception: self::requiredString($raw, 'exception'),
            transaction_id: self::nullableInt($raw, 'transaction_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}