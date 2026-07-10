<?php
namespace WarehouseCore\Payload\Type;

enum ActionType: string {
    case Create             = 'Create';
    case Update             = 'Update';
    case Delete             = 'Delete';
    case Place              = 'Place';
    case Replace            = 'Replace';
    case Move               = 'Move';
    case Remove             = 'Remove';
    case ChangeType         = 'ChangeType';
    case ChangeCondition    = 'ChangeCondition';
    case ChangeStatus       = 'ChangeStatus';
}