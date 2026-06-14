<?php
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

final class UserRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function findById(
        int $id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByTelegramId(
        int $telegram_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE telegram_id = :telegram_id"
        );
        $stmt->execute([
            ":telegram_id" => $telegram_id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByName(
        string $name
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE name = :name"
        );
        $stmt->execute([
            ":name" => $name
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByRole(
        int $role_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE role_id = :role_id"
        );
        $stmt->execute([
            ":role_id" => $role_id
        ]);
        return $stmt->fetchAll();
    }

    public function add(
        int $telegram_id, 
        string $name, 
        int $role_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name}
                (telegram_id, name, role_id) 
                VALUES (:telegram_id, :name, :role_id)"
            );
            $stmt->execute([
                ':telegram_id' => $telegram_id,
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

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name}"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}