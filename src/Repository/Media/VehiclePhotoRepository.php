<?php
namespace WarehouseCore\Repository\Media;
use WarehouseCore\Exception\PdoExceptionMapper;

final class VehiclePhotoRepository {
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

    public function findByVehicleId(
        int $vehicle_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE vehicle_id = :vehicle_id"
        );
        $stmt->execute([
            ":vehicle_id" => $vehicle_id
        ]);
        return $stmt->fetchAll();
    }

    public function findByFile(
        string $file
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE file = :file"
        );
        $stmt->execute([
            ":file" => $file
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $vehicle_id, 
        string $file
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (vehicle_id, file) 
                VALUES (:vehicle_id, :file)"
            );
            $stmt->execute([
               ':vehicle_id' => $vehicle_id,
               ':file' => $file
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}