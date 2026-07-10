<?php
namespace WarehouseCore\Repository\Topology;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Value\StockPlacementValue;

final class StockPlacementRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|StockPlacementValue {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return ($result)? null : StockPlacementValue::fromRaw($result);
    }

    public function findByStockId(
        int $stock_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE stock_id = :stock_id"
        );
        $stmt->execute([
            ":stock_id" => $stock_id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByLocationId(
        int $location_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE location_id = :location_id"
        );
        $stmt->execute([
            ":location_id" => $location_id
        ]);
        return array_map(fn($row) => StockPlacementValue::fromRaw($row), $stmt->fetchAll());
    }

    public function findByContainerId(
        int $container_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE container_id = :container_id"
        );
        $stmt->execute([
            ":container_id" => $container_id
        ]);
        return array_map(fn($row) => StockPlacementValue::fromRaw($row), $stmt->fetchAll());
    }

    public function addByLocationId(
        int $location_id, 
        int $stock_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (location_id, stock_id) 
                VALUES (:location_id, :stock_id)"
            );
            $stmt->execute([
                ':location_id' => $location_id,
                ':stock_id' => $stock_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function addByContainerId(
        int $container_id, 
        int $stock_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (container_id, stock_id) 
                VALUES (:container_id, :stock_id)"
            );
            $stmt->execute([
                ':container_id' => $container_id,
                ':stock_id' => $stock_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateLocationId(
        int $id, 
        int $location_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET location_id = :location_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':location_id' => $location_id,
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateContainerId(
        int $id, 
        int $container_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET container_id = :container_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':container_id' => $container_id,
                ':id' => $id
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