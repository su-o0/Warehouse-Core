<?php
namespace StorageApi\Repository\Media;
use StorageApi\Exception\StorageException;

class CarPhotoRepository {
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

    public function findByCarId(int $CarId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE CarId = :CarId"
        );
        $stmt->execute([
            ":CarId" => $CarId
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

    public function add(int $CarId, int $OwnerId, string $File): int {
        $Car = $this->findByFile($File);
        if(!$Car)
            throw StorageException::CAR_PHOTO_ALREADY_EXISTS();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (CarId, OwnerId, File) 
                VALUES (:CarId, :OwnerId, :File)"
            );
            $stmt->execute([
               ':CarId' => $CarId,
               ':OwnerId' => $OwnerId,
               ':File' => $File
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