<?php
namespace SuO0\StorageApi\Repository;

class StockRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findByContainerId(int $containerId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdC = :IdC"
        );
        $stmt->execute([":IdC" => $containerId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByPartId(int $partId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdPart = :partId"
        );
        $stmt->execute([":partId" => $partId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $containerId, int $partId, int $qty): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdC, IdPart, Qty) 
                VALUES (:IdC, :IdPart, :Qty)"
            );
            $stmt->execute([
            ':IdC'   => $containerId,
            ':IdPart' => $partId,
            ':Qty'   => $qty
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function updateQty(int $containerId, int $partId, int $qty): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Qty = :Qty 
                WHERE IdC = :IdC AND IdPart = :partId"
            );
            $result = $stmt->execute([
            ':IdC' => $containerId,
            ':partId' => $partId,
            ':Qty' => $qty
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function incrementQty(int $containerId, int $partId, int $qty = 1): bool {
        try {
           $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Qty = Qty + :qty 
                WHERE IdC = :IdC AND IdPart = :partId"
            );
            $result = $stmt->execute([
                ':IdC' => $containerId,
                ':partId' => $partId,
                ':qty' => $qty
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function decrementQty(int $containerId, int $partId, int $qty = 1): int {
        try {
           $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Qty = Qty - :qty 
                WHERE IdC = :IdC AND IdPart = :partId"
            );
            $result = $stmt->execute([
                ':IdC' => $containerId,
                ':partId' => $partId,
                ':qty' => $qty
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function delete(int $containerId, int $partId): int{
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM $this->tableName 
                WHERE IdC = :IdC AND IdPart = :partId"
            );
            $result = $stmt->execute([
                ':IdC' => $containerId,
                ':partId' => $partId
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }
}