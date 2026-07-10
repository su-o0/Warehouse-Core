<?php
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\OwnerEntity;

final class OwnerRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|OwnerEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : OwnerEntity::fromRaw($result);
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name}"
        );
        $stmt->execute();
        return array_map(fn($row) => OwnerEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function getByUserId(
        int $user_id
    ): null|OwnerEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : OwnerEntity::fromRaw($result);
    }

    public function add(
        string $name, 
        int $user_id, 
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name}
                (name, user_id) 
                VALUES (:name, :user_id)"
            );
            $stmt->execute([
                ':name' => $name,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
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