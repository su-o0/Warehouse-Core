<?php
namespace SuO0\StorageApi\Repository\Audit;
use SuO0\StorageApi\Exception\StorageException;

class OwnerRepository {
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

    public function findByUserId(int $UserId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE UserId = :UserId"
        );
        $stmt->execute([":UserId" => $UserId]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByPermission(string $Permission): null|array {
        if(!$this->isStatePermission($Permission))
            throw StorageException::OWNER_INVALID_PERMISSION();

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Permission = :Permission"
        );
        $stmt->execute([":Permission" => $Permission]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByName(string $Name): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Name = :Name"
        );
        $stmt->execute([":Name" => $Name]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(string $Name, int $UserId, string $Permission): int {
        if($this->findByName($Name) !== null)
            throw StorageException::OWNER_NAME_ALREADY_EXISTS();

        if($this->findByUserId($UserId) !== null)
            throw StorageException::OWNER_USERID_ALREADY_EXISTS();

        if(!$this->isStatePermission($Permission))
            throw StorageException::OWNER_INVALID_PERMISSION();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Name, UserId, Permission) 
                VALUES (:Name, :UserId, :Permission)"
            );
            $stmt->execute([
                ':Name' => $Name,
                ':userId' => $UserId,
                ':Permission' => $Permission
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            
            throw $e;
        }
    }



    public function updatePermission(int $Id, string $Permission):bool {
        $owner = $this->findById($Id);
        if($owner === null) 
            throw StorageException::OWNER_NOT_FOUND();
        
        if(!$this->isStatePermission($Permission))
            throw StorageException::OWNER_INVALID_PERMISSION();

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Permission = :Permission 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':Permission' => $Permission
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function isStatePermission(string $Permission): bool {
        switch($Permission) {
            case "Admin":
                return true;
            case "Worker":
                return true;
            case "Salesman":
                return true;
            default:
                return false;
        }
    }
}