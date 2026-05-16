<?php
namespace StorageApi\Repository\Catalog;
use StorageApi\Exception\StorageException;

class CarRepository {
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

    public function findByVin(string $Vin): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Vin = :Vin"
        );
        $stmt->execute([
            ":Vin" => $Vin
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(string $Vin): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Vin) 
                VALUES (:Vin)"
            );
            $stmt->execute([
               ':Vin' => $Vin
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw StorageException::CAR_ALREADY_EXISTS();

            throw $e;
        }
    }

    public function findOrCreate(string $vin): array {
        $id = $this->findByVin($vin);
        if ($id !== null)
            return $id;
        return $this->findById($this->add($vin));
    }
}