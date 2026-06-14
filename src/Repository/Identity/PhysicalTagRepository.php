<?php
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

final class PhysicalTagRepository {
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
            ":Id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByStatus(
        string $status
    ): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE status = :status"
        );
        $stmt->execute([
            ":status" => $status
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $id, 
        string $status
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (id, status) 
                VALUES (:id, :status)"
            );
            $stmt->execute([
                ':id' => $id,
                ':status' => $status,
            ]);
            return (int) $this->db->lastInsertId();
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
                SET status = :status 
                WHERE id = :id"
            );
            return $stmt->execute([
                'id' => $id,
                ':status' => $status,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}