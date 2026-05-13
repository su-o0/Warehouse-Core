<?php
namespace SuO0\StorageApi\Repository\Audit;

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

    public function findByIdUser(int $IdUser): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdUser = :IdUser"
        );
        $stmt->execute([":IdUser" => $IdUser]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByPermission(string $Permission): null|array {
        if(!$this->isStatePermission($Permission))
                throw new \RuntimeException("Права должни быть Admin|Worker");

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

    public function add(int $IdUser, string $Permission, string $Name): int {
        $owner = $this->findByIdUser($IdUser);
        if($owner !== null) 
            throw new \RuntimeException("Пользователь существует");
    
        if(!$this->isStatePermission($Permission))
                throw new \RuntimeException("Права должни быть Admin|Worker");
      
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdUser, Permission, Name) 
                VALUES (:IdUser, :Permission, :Name)"
            );
            $stmt->execute([
                ':userId' => $IdUser,
                ':Permission' => $Permission,
                ':Name' => $Name
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            
            throw $e;
        }
    }

    public function updatePermission(int $Id, string $Permission):bool {
        $owner = $this->findById($Id);
        if($owner === null) 
            throw new \RuntimeException("Пользователь $Id не найден");
        
        if(!$this->isStatePermission($Permission))
                throw new \RuntimeException("Права должни быть Admin|Worker");

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
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
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