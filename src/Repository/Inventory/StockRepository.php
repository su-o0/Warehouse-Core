<?php
namespace SuO0\StorageApi\Repository;

class StockRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }
    public function findById(int $Id): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Id = :Id"
        );
        $stmt->execute([
            ":Id" => $Id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }


    public function findByPartId(int $PartId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName
            WHERE PartId = :PartId"
        );
        $stmt->execute([
            ":PartId" => $PartId
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(int $Qty, ?int $PartId = null): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (PartId, Qty) 
                VALUES (:PartId, :Qty)"
            );
            $stmt->execute([
                ':PartId' => $PartId,
                ':Qty'   => $Qty
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function updateContainerId(int $Id, int $ContainerId): bool {
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Асортимент $Id не найден");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET ContainerId = :ContainerId 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':ContainerId' => $ContainerId
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $ContainerId не найдена");
            throw $e;
        }
    }

    public function updatePartId(int $Id, string $PartId): bool {
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Асортимент $Id не найден");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET PartId = :PartId 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':PartId' => $PartId
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Часть $PartId не найдена");
            throw $e;
        }
    }

    public function updateQty(int $Id, int $Qty): bool {
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Асортимент $Id не найден");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Qty = :Qty 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':Qty' => $Qty
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function incrementQty(int $Id, int $Qty = 1): bool {
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Асортимент $Id не найден");

        try {
           $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Qty = Qty + :Qty 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':Qty' => $Qty
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function decrementQty(int $Id, int $Qty = 1): bool {
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Асортимент $Id не найден");
        
        try {
           $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Qty = Qty - :Qty 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':Qty' => $Qty
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
    
    public function delete(int $Id): bool{
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Асортимент $Id не найден");
        
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM $this->tableName 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}