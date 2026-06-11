<?php
namespace WarehouseCore\Output\Contracts;

interface OutputRenderer
{
    public function supports(object $result): bool;

    public function render(object $result): mixed;
}