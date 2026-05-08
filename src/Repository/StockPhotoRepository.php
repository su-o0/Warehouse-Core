<?php
namespace SuO0\StorageApi\Repository;

class StockPhotoRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function find(int $id): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Id = :id"
        );
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByStockId(int $stockId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdStock = :stockId"
        );
        $stmt->execute([":stockId" => $stockId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByOwnerId(int $ownerId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdOwner = :ownerId"
        );
        $stmt->execute([":ownerId" => $ownerId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByFile(string $file): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE File = :file"
        );
        $stmt->execute([":file" => $file]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $stockId, int $ownerId, string $file): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdStock, IdOwner, File) 
                VALUES (:stockId, :ownerId, :file)"
            );
            $stmt->execute([
               ':stockId' => $stockId,
               ':ownerId' => $ownerId,
               ':file' => $file
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