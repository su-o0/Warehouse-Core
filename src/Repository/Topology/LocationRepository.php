<?php
namespace SuO0\StorageApi\Repository\Topology;

class LocationRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findByAddress(string $Address): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE address = :Address"
        );
        $stmt->execute([
            ":Address" => $Address
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findById(int $Id): null|array{
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

    public function add(string $Address): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Address) 
                VALUES (:Address)"
            );
            $stmt->execute([
                ':Address' => $Address
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw new \RuntimeException("Адресс $Address уже существует");

            throw $e;
        }
    }
}