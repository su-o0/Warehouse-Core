<?php
namespace SuO0\StorageApi\Repository;

class LocationRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }
    public function find(string $address): null|int {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE address = :address"
        );
        $stmt->execute([":address" => $address]);
        $result = $stmt->fetch();
        if(empty($result))
            return null;
        else 
            return (int)$result['IdA'];
    }

    public function findById(int $id): null|string{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdA = :IdA"
        );
        $stmt->execute([":IdA" => $id]);
        $result = $stmt->fetch();

        if(empty($result))
            return null;
        else 
            return (string)$result['Address'];
    }

    public function add(string $address): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Address) VALUES (:address)"
            );
            $result = $stmt->execute([':address' => $address]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                return $this->find($address);
            
            throw $e;
        }
    }
}