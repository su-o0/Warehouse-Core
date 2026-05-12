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


    public function findByIdPart(int $IdPart): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName W
            HERE IdPart = :partId"
        );
        $stmt->execute([
            ":partId" => $IdPart
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(int $Qty, ?int $IdPart = null): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdPart, Qty) 
                VALUES (:IdPart, :Qty)"
            );
            return $stmt->execute([
            ':IdPart' => $IdPart,
            ':Qty'   => $Qty
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
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
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
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
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function decrementQty(int $Id, int $Qty = 1): int {
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
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }
    public function delete(int $Id): int{
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
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }
}