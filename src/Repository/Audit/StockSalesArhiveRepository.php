<?php
namespace WarehouseCore\Repository\Audit;
use WarehouseCore\Exception\StorageException;

final class StockSalesArhiveRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function findById(
        int $id
    ): null|array  {
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

    public function findByStockId(
        int $item_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE item_id = :item_id"
        );
        $stmt->execute([
            ":item_id" => $item_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByUserId(
        int $user_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(
        int $stock_id, 
        int $qty, 
        int $user_id, 
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (stock_id, qty, user_id)
                VALUE (:stock_id, :qty, :user_id)"
            );
            $stmt->execute([
                ':stock_id' => $stock_id,
                ':qty' => $qty,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }   
}