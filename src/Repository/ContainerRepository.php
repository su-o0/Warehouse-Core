<?php
namespace SuO0\StorageApi\Repository;

class ContainerRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findByIdC(int $IdC):null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdC = :IdC"
        );
        $stmt->execute([
            ":IdC" => $IdC
            ]);
        $result = $stmt->fetch();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByIdA(int $IdA):null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdA = :IdA"
        );
        $stmt->execute([
            ":IdA" => $IdA
        ]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $IdC, int $IdA, string $Type): bool {
        try {
            switch($Type) {
                case "Bulk": break;
                case "Box": break;
                case "Area": break;
                default: 
                    throw new \RuntimeException("Тип $Type должен быть Bulk|Box|Area");
            }

            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdC, IdA, Type) 
                VALUES (:IdC, :IdA, :Type)"
            );
            $result = $stmt->execute([
                ':IdC' => $IdC,
                ':IdA' => $IdA,
                ':Type' => $Type
            ]);
            return $result;

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw new \RuntimeException("Контейнер $IdC уже существует");

            if ($code === 1452)
                throw new \RuntimeException("Адрес $IdA не найден");

            throw $e;
        }
    }

    public function updateIdA(int $IdC, int $IdA): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdA = :IdA 
                WHERE IdC = :IdC"
            );
            return $stmt->execute([
                ':IdA' => $IdA,
                ':IdC' => $IdC,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $IdC не найден");

            throw $e;
        }
    }
}