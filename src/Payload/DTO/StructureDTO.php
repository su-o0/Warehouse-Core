<?php 
namespace WarehouseCore\Payload\DTO;

final readonly class StructureDTO  {
    public function __construct(
        public int $id,
        public ?string $name = null,
        public mixed $status
    ) { }  
}