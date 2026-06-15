<?php
namespace WarehouseCore\Payload\Type;

enum ContainerType: string {
    case Box    = 'Box';
    case Pallet = 'Pallet';
}