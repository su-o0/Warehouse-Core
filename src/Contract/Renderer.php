<?php
namespace WarehouseCore\Contract;

interface Renderer 
{
    public function supports(object $result): bool;

    public function render(object $result): mixed;
}