<?php 
namespace WarehouseCore\Payload\DTO;

final readonly class EntityNamesDTO  {
    public function __construct(
        public int $record_id,
        public string $name,
        public bool $is_primary
    ) { }  
}