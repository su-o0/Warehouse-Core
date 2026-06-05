<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\StorageException;

final class StockRepository {
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

    public function findByPartId(
        int $part_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name}
            WHERE part_id = :part_id"
        );
        $stmt->execute([
            ":part_id" => $part_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByContainerId(
        int $container_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name}
            WHERE container_id = :container_id"
        );
        $stmt->execute([
            ":container_id" => $container_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(
        int $qty, 
        ?int $part_id = null
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO 1this->table_name
                (part_id, qty) 
                VALUES (:part_id, :qty)"
            );
            $stmt->execute([
                ':part_id' => $part_id,
                ':qty'   => $qty
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updatePartId(
        int $id, 
        string $part_id
    ): bool {
        if($this->findById($id) === null)
            throw StorageException::STOCK_NOT_FOUND();

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
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateContainerId(
        int $id, 
        ?int $container_id = null
    ): bool {
        if($this->findById($id) === null)
            throw StorageException::STOCK_NOT_FOUND();

        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET container_id = :container_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':container_id' => $container_id
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateQty(
        int $id, 
        int $qty
    ): bool {
        if($this->findById($id) === null)
            throw StorageException::STOCK_NOT_FOUND();

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
            throw $e;
        }
    }

    public function incrementQty(
        int $id, 
        int $qty = 1
    ): bool {
        if($this->findById($id) === null)
            throw StorageException::STOCK_NOT_FOUND();

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
            throw $e;
        }
    }

    public function decrementQty(
        int $id, 
        int $qty = 1
    ): bool {
        if($this->findById($id) === null)
            throw StorageException::STOCK_NOT_FOUND();
        
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
            throw $e;
        }
    }
    
    public function delete(
        int $id
    ): bool{
        if($this->findById($id) === null)
            throw StorageException::STOCK_NOT_FOUND();
        
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name} 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}