<?php
namespace WarehouseCore\Repository\Catalog;
use WarehouseCore\Exception\PdoExceptionMapper;

final class VehicleRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function findById(
        int $id
    ): null|array {
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

    public function findByVin(
        string $vin
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE vin = :vin"
        );
        $stmt->execute([
            ":vin" => $vin
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
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

    public function findOrCreate(
        string $vin
    ): array {
        $id = $this->findByVin($vin);
        if ($id !== null)
            return $id;
        return $this->findById($this->add($vin));
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->table_name"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}