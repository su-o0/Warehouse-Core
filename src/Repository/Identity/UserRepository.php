<?php
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\UserEntity;

final class UserRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|UserEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        return empty($result)? null : UserEntity::fromRaw($stmt->fetch());
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name}"
        );
        $stmt->execute();
        return array_map(fn($row) => UserEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function getByName(
        string $name
    ): null|UserEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE name = :name"
        );
        $stmt->execute([
            ":name" => $name
        ]);
        return empty($result)? null : UserEntity::fromRaw($stmt->fetch());
    }

    public function findByRoleId(
        int $role_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE role_id = :role_id"
        );
        $stmt->execute([
            ":role_id" => $role_id
        ]);
        return array_map(fn($row) => UserEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        string $name,
        int $role_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name}
                (name, role_id) 
                VALUES (:name, :role_id)"
            );
            $stmt->execute([
                ':name' => $name,
                ':role_id' => $role_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateName(
        int $id, 
        string $name
    ):bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET name = :name 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':name' => $name
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStatus(
        int $id, 
        string $status
    ):bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET name = :name 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':name' => $status
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateRoleId(
        int $id, 
        int $role_id
    ):bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET role_id = :role_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':role_id' => $role_id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name} 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}