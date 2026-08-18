<?php
namespace WarehouseCore\Payload\Enum;

enum RoleNameEnum : string {
    case Root = 'Root';
    case Admin = 'Admin';
    case Worker = 'Worker';
    case Salesman = 'Salesman';
    case Viewer = 'Viewer';
}