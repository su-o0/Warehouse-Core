<?php
namespace StorageApi\Repository\Topology;
use StorageApi\Exception\StorageException;

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
                throw StorageException::LOCATION_ALREADY_EXISTS();

            throw $e;
        }
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->tableName"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}