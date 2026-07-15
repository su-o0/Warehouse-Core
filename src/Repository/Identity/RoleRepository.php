<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Payload\DTO\RoleEntity;

final class RoleRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        string $id
    ): null|RoleEntity{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : RoleEntity::fromRaw($result);
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->table_name"
        );
        $stmt->execute();
        return array_map(fn($row) => RoleEntity::fromRaw($row), $stmt->fetchAll());
    }
    
    public function findByName(
        string $name
    ): null|RoleEntity{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->table_name 
            WHERE name = :name"
        );
        $stmt->execute([
            ":name" => $name
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : RoleEntity::fromRaw($result);
    }
}