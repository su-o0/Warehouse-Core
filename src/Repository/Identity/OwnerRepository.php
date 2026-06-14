<?php
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

final class OwnerRepository {
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

    public function findByUserId(
        int $user_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
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