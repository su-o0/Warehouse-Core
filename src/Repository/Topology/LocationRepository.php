<?php
namespace WarehouseCore\Repository\Topology;
use WarehouseCore\Exception\StorageException;

final class LocationRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function findById(
        int $id
    ): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByAddress(
        string $address
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE address = :address"
        );
        $stmt->execute([
            ":address" => $address
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        string $address
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (address) 
                VALUES (:address)"
            );
            $stmt->execute([
                ':address' => $address
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw StorageException::LOCATION_ALREADY_EXISTS();

            throw $e;
        }
    }

    public function delete(
        int $id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name} 
                WHERE (:id)"
            );
            $stmt->execute([
                ':id' => $id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            throw $e;
        }
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->table_name"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}