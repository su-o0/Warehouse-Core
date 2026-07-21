<?php
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\PhysicalTagEntity;

final class PhysicalTagRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|PhysicalTagEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PhysicalTagEntity::fromRaw($result);
    }

    public function findByStatus(
        string $status
    ): array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE status = :status"
        );
        $stmt->execute([
            ":status" => $status
        ]);

        return array_map(fn($row) => PhysicalTagEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (id) 
                VALUES (:id)"
            );
            $stmt->execute([
                ':id' => $id
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