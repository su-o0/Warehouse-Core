<?php
namespace SuO0\StorageApi\Repository\Topology;
use SuO0\StorageApi\Exception\StorageException;

class ItemPlacementRepository {
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

    public function findByItemId(string $ItemId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE ItemId = :ItemId"
        );
        $stmt->execute([
            ":ItemId" => $ItemId
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $LocationId, string $ItemId): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (LocationId, ItemId) 
                VALUES (:LocationId, :ItemId)"
            );
            $stmt->execute([
                ':LocationId' => $LocationId,
                ':ItemId' => $ItemId
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function delete(int $Id): int{
        $placement = $this->findById($Id);
        if($placement === null)
            throw StorageException::ITEM_PLACEMENT_NOT_FOUND();
        
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