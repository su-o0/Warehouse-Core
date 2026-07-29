<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ActionType;

final class ActionTypeMapper implements Mapper {
    public static function match(
        string $field
    ): ActionType {
        return match ($field) {
            'Create'            => ActionType::Create,
            'Update'            => ActionType::Update,
            'Delete'            => ActionType::Delete,
            'Place'             => ActionType::Place,
            'Replace'           => ActionType::Replace,
            'Move'              => ActionType::Move,
            'Remove'            => ActionType::Remove,
            'ChangeType'        => ActionType::ChangeType,
            'ChangeCondition'   => ActionType::ChangeCondition,
            'ChangeStatus'      => ActionType::ChangeStatus,
            default             => throw DomainException::TELEMETRY_ACTION_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw,
        string $field
    ): ActionType {
        return self::match($raw[$field]);
    }
}