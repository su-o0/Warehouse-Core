<?php
namespace SuO0\StorageApi\Repository\Topology;

class ContainerPlacementRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(int $Id): null|array {
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

    public function findByLocationId(int $LocationId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE LocationId = :LocationId"
        );
        $stmt->execute([
            ":LocationId" => $LocationId
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByContainerId(string $ContainerId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE ContainerId = :ContainerId"
        );
        $stmt->execute([
            ":ContainerId" => $ContainerId
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $LocationId, string $ContainerId): int{
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (LocationId, ContainerId) 
                VALUES (:LocationId, :ContainerId)"
            );
            $stmt->execute([
                ':LocationId' => $LocationId,
                ':ContainerId' => $ContainerId
            ]);
            return (int) $this->db->lastInsertId();

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function delete(int $Id): int{
        $placement = $this->findById($Id);
        if($placement === null)
            throw new \RuntimeException("Расположение не найдено");
        
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM $this->tableName 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id
            ]);
        } catch (\PDOException $e) {

            throw $e;
        }
    }
}