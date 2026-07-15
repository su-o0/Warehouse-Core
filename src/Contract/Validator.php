<?php
namespace WarehouseCore\Contract;

interface Validator
{
    public static function validate(array $arguments): mixed;
}