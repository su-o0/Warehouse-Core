<?php 
namespace WarehouseCore\Contract;

interface Mapper 
{
    public static function match(string $field): object;
}