<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ActionType;

final class ActionTypeMapper {
    public static function fromRaw(
        array $raw,
        string $field
    ): ActionType {
        return match ($raw[$field]) {
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
            default             => throw DomainException::ACTION_INVALID_TYPE()
        };
    }
}