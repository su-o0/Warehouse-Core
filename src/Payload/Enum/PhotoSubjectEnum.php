<?php
namespace WarehouseCore\Payload\Enum;

enum PhotoSubjectEnum: string {
    case Part = 'part';
    case Item = 'item';
    case Stock = 'stock';
    case Vehicle = 'vehicle';
}
