<?php
namespace SuO0\StorageApi\Repository;

class PhysicalTagRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findByIdTag(int $IdTag): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdTag = :IdTag"
        );
        $stmt->execute([":IdTag" => $IdTag]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByStatus()
}