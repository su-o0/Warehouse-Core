<?php
namespace SuO0\StorageApi\Repository;

class StockPhotoRepository {
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
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByStockId(int $StockId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE StockId = :StockId"
        );
        $stmt->execute([
            "StockId" => $StockId
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByOwnerId(int $OwnerId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE OwnerId = :OwnerId"
        );
        $stmt->execute([
            ":OwnerId" => $OwnerId
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByFile(string $File): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE File = :File"
        );
        $stmt->execute([
            ":File" => $File
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $StockId, int $OwnerId, string $File): int {
        $Car = $this->findByFile($File);
        if(!$Car)
            throw new \RuntimeException("Файл уже записан");

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (StockId, OwnerId, File) 
                VALUES (:StockId, :OwnerId, :File)"
            );
            $stmt->execute([
               ':StockId' => $StockId,
               ':OwnerId' => $OwnerId,
               ':File' => $File
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            
            throw $e;
        }
    }
}