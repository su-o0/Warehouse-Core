<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;

final class AddressValue {
    use ConfigHelper;
    public function __construct(
        public readonly string $zone, // зона
        public readonly string $rack, // стелаж
        public readonly string $shelf, //полка
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredString($raw, 'zone'),
            self::requiredString($raw, 'rack'),
            self::requiredString($raw, 'shelf')
        );
    }

    public function getValue(): string {
        return $this->zone.$this->rack.$this->shelf;
    }
}