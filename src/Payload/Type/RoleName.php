<?php
namespace WarehouseCore\Payload\Type;

enum RoleName: string {
    case Root = 'Root';
    case Admin = 'Admin';
    case Worker = 'Worker';
    case Salesman = 'Salesman';
    case Viewer = 'Viewer';
}