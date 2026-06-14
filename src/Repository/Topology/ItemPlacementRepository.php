<?php
namespace WarehouseCore\Repository\Topology;
use WarehouseCore\Exception\PdoExceptionMapper;

final class ItemPlacementRepository {
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

    public function findByLocationId(
        int $LocationId
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE LocationId = :LocationId"
        );
        $stmt->execute([
            ":LocationId" => $LocationId
        ]);
        return $stmt->fetchAll();
    }

    public function findByItemId(
        int $item_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE item_id = :item_id"
        );
        $stmt->execute([
            ":item_id" => $item_id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $location_id, 
        int $item_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name}
                (location_id, item_id) 
                VALUES (:location_id, :item_id)"
            );
            $stmt->execute([
                ':location_id' => $location_id,
                ':item_id' => $item_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateLocationId(
        int $id, 
        int $location_id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET location_id = :location_id
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':location_id' => $location_id
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