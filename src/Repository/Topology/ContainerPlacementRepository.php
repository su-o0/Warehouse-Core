<?php
namespace WarehouseCore\Repository\Topology;
use WarehouseCore\Exception\StorageException;

final class ContainerPlacementRepository {
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
            "id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByLocationId(
        int $location_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name}
            WHERE location_id = :location_id"
        );
        $stmt->execute([
            ":location_id" => $location_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByContainerId(
        int $container_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE container_id = :container_id"
        );
        $stmt->execute([
            ":container_id" => $container_id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $location_id, 
        int $container_id
    ): int{
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} (location_id, container_id) 
                VALUES (:location_id, :container_id)"
            );
            $stmt->execute([
                ':location_id' => $location_id,
                ':container_id' => $container_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateLocationId(
        int $id, 
        int $location_id
    ): bool{
        if($this->findById($id) === null)
            throw StorageException::CONTAINER_PLACEMENT_NOT_FOUND();

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
            $code = $e->errorInfo[1];
            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function delete(
        int $id
    ): bool{
        if($this->findById($id) === null)
            throw StorageException::CONTAINER_PLACEMENT_NOT_FOUND();

        try {
            $stmt = $this->db->prepare(
                "DELETE FROM $this->table_name 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}