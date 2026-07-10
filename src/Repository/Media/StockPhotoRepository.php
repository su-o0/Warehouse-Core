<?php
namespace WarehouseCore\Repository\Media;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\PhotoEntity;

final class StockPhotoRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
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
        return empty($result)? null : PhotoEntity::fromRaw($result);
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
        return array_map(fn($row) => PhotoEntity::fromRaw($row), $stmt->fetchAll());
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
        return empty($result)? null : PhotoEntity::fromRaw($result);
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
        return array_map(fn($row) => PhotoEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $user_id,
        int $stock_id, 
        string $file
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (stock_id, file, created_by_user_id) 
                VALUES (:stock_id, :file, :user_id)"
            );
            $stmt->execute([
               ':stock_id' => $stock_id,
               ':file' => $file,
               ':user_id' => $user_id
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