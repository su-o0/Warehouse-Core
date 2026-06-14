<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\PdoExceptionMapper;

final class ContainerRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name) {
    }

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

    public function findByType(
        int $type
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE type = :type"
        );
        $stmt->execute([
            ":type" => $type
        ]);
        return $stmt->fetchAll();
    }

    public function add(
        int $id, 
        string $type
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (id, type) 
                VALUES (:id, :type)"
            );
            $stmt->execute([
                ':id' => $id,
                ':type' => $type
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
    
    public function updateType(
        int $id, 
        string $type
    ): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET type = :type 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':type' => $type,
                ':id' => $id,
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