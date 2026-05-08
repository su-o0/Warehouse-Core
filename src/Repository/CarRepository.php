<?php
namespace SuO0\StorageApi\Repository;

class CarRepository {
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

    public function findByVin(string $vin): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Vin = :Vin"
        );
        $stmt->execute([":Vin" => $vin]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(string $vin): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Vin) 
                VALUES (:Vin)"
            );
            $stmt->execute([
               ':Vin' => $vin
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw new \RuntimeException($e->errorInfo[0]);

            throw $e;
        }
    }

    public function findOrCreate(string $vin): array {
        $id = $this->findByVin($vin);
        if ($id !== null)
            return $id;
        return $this->find($this->add($vin));
    }
}