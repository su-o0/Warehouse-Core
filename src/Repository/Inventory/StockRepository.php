<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\StockEntity;

final class StockRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|StockEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : StockEntity::fromRaw($result);
    }

    public function findByPartId(
        int $part_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name}
            WHERE part_id = :part_id"
        );
        $stmt->execute([
            ":part_id" => $part_id
        ]);
        return array_map(fn($row) => StockEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByStatus(
        string $status
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name}
            WHERE status = :status"
        );
        $stmt->execute([
            ":status" => $status
        ]);
        return array_map(fn($row) => StockEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByCreatedByUserId(
        int $user_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE created_by_user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        return array_map(fn($row) => StockEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $user_id,
        int $qty, 
        ?int $part_id = null
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name}
                (part_id, qty, created_by_user_id) 
                VALUES (:part_id, :qty, :user_id)"
            );
            $stmt->execute([
                ':part_id' => $part_id,
                ':qty'   => $qty,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePartId(
        int $id, 
        int $part_id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET part_id = :part_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':part_id' => $part_id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateQty(
        int $id, 
        int $qty
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET qty = :qty 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':qty' => $qty
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStatus(
        int $id, 
        string $status
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET status = :status 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':status' => $status
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function incrementQty(
        int $id, 
        int $qty = 1
    ): bool {
        try {
           $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET qty = qty + :qty 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':qty' => $qty
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function decrementQty(
        int $id, 
        int $qty = 1
    ): bool {
        try {
           $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET qty = qty - :qty 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':qty' => $qty
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
    
    public function delete(
        int $id
    ): bool{
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