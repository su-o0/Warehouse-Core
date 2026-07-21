<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\DomainException;

final class AddressValue {
    use ConfigHelper;
    public function __construct(
        public readonly string $zone, // зона
        public readonly ?string $rack, // стелаж
        public readonly ?string $shelf, //полка
    ) { }

    public static function fromRaw(array $raw): self {
        $address = explode('>', self::requiredString($raw, 'address'));

        return self::fromRawRequest([
            'zone' => $address[0],
            'rack' => $address[1],
            'shelf' => $address[2]
        ]);
    }

    public static function fromRawRequest(array $raw): self {
        $zone = self::requiredString($raw, 'zone');
        $rack = self::nullableString($raw, 'rack');
        $shelf = self::nullableString($raw, 'shelf');

        if ($zone[0] != 'Z') {
            throw DomainException::LOCATION_ADDRESS_INVALID();
        }

        if($rack !== null) {
            if ($rack[0] != 'A') {
                throw DomainException::LOCATION_ADDRESS_INVALID();
            }
        }

        if($shelf !== null) {
            if ($shelf[0] != 'B') {
                throw DomainException::LOCATION_ADDRESS_INVALID();
            }
        }

        return new self(
            $zone,
            $rack,
            $shelf
        );
    }

    public function getValue(): string {
        return $this->zone.'>'.$this->rack.'>'.$this->shelf;
    }
}