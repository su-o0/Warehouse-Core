<?php
namespace WarehouseCore\Repository\Topology;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Value\AddressValue;
final class LocationRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|AddressValue{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : AddressValue::fromRaw($result);
    }
    
    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->table_name"
        );
        $stmt->execute();
        return array_map(fn($row) => AddressValue::fromRaw($row), $stmt->fetchAll());
    }

    public function findByAddress(
        string $address
    ): null|AddressValue {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE address = :address"
        );
        $stmt->execute([
            ":address" => $address
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : AddressValue::fromRaw($result);
    }

    public function findByCreatedByUserId(
        int $user_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE created_by_user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        return array_map(fn($row) => AddressValue::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $user_id,
        string $address
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (address, created_by_user_id) 
                VALUES (:address, :user_id)"
            );
            $stmt->execute([
                ':address' => $address,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateAddress(
        int $id, 
        string $address
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET address = :address
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':address' => $address
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name}
                WHERE id = :id"
            );
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}