<?php
namespace WarehouseCore\Repository\Audit;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Value\ItemSalesArhiveValue;

final class ItemSalesArhiveRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|ItemSalesArhiveValue  {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : ItemSalesArhiveValue::fromRaw($result);
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
        return array_map(fn($row) => ItemSalesArhiveValue::fromRaw($row), $stmt->fetchAll());
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
        return array_map(fn($row) => ItemSalesArhiveValue::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $item_id, 
        int $user_id, 
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (item_id, user_id)
                VALUE (:item_id, :user_id)"
            );
            $stmt->execute([
                ':item_id' => $item_id,
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