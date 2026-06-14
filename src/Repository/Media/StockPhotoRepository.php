<?php
namespace WarehouseCore\Repository\Media;
use WarehouseCore\Exception\PdoExceptionMapper;

final class StockPhotoRepository {
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

    public function findByStockId(
        int $stock_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE stock_id = :stock_id"
        );
        $stmt->execute([
            ":stock_id" => $stock_id
        ]);
        return $stmt->fetchAll();
    }

    public function findByFile(
        string $file
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE file = :file"
        );
        $stmt->execute([
            ":file" => $file
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $stock_id, 
        string $file
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (stock_id, file) 
                VALUES (:stock_id, :file)"
            );
            $stmt->execute([
               ':stock_id' => $stock_id,
               ':file' => $file
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}