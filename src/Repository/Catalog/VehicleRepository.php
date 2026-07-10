<?php
namespace WarehouseCore\Repository\Catalog;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\VehicleEntity;

final class VehicleRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|VehicleEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : VehicleEntity::fromRaw($result);
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->table_name"
        );
        $stmt->execute();
        return array_map(fn($row) => VehicleEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByVin(
        string $vin
    ): null|VehicleEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE vin = :vin"
        );
        $stmt->execute([
            ":vin" => $vin
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : VehicleEntity::fromRaw($result);
    }

    public function add(
        string $vin
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (vin) 
                VALUES (:vin)"
            );
            $stmt->execute([
               ':vin' => $vin
            ]);
            return (int) $this->db->lastInsertId();
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
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}