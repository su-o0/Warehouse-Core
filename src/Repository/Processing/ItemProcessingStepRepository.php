<?php
namespace WarehouseCore\Repository\Processing;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Value\ItemProcessingStageValue;

final class ItemProcessingStepRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|ItemProcessingStageValue {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : ItemProcessingStageValue::fromRaw($result);
    }

    public function findByItemId(
        int $item_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE item_id = :item_id"
        );
        $stmt->execute([
            ":item_id" => $item_id
        ]);
        return array_map(fn($row) => ItemProcessingStageValue::fromRaw($row), $stmt->fetchAll());
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
        return array_map(fn($row) => ItemProcessingStageValue::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $item_id,   
        string $stage,
        string $meta_data,
        int $user_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (item_id, stage, meta_data, created_by_user_id) 
                VALUES (:item_id, :stage, :meta_data, :user_id)"
            );
            $stmt->execute([
               ':item_id' => $item_id,
               ':stage' => $stage,
               ':meta_data' => $meta_data,
               ':user_id' => $user_id,
            ]);
            return (int) $this->db->lastInsertId();
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