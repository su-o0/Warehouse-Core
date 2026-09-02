<?php 
namespace WarehouseCore\Contract;

interface Hydrator 
{
    public static function hydrate(array $raw): object;
}