<?php
namespace SuO0\StorageApi\Repository\Audit;

class HistoryRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function add(string $Action, string $EntityType, int $EntityId, int $OwnerId, ?string $Note = null): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Action, EntityType, EntityId, Note, OwnerId)
                VALUE (:Action, :EntityType, :EntityId, :Note, :OwnerId)"
            );
            $result = $stmt->execute([
                ':Action' => $Action,
                ':EntityType' => $EntityType,
                ':EntityId' => $EntityId,
                ':Note' => $Note,
                ':OwnerId' => $OwnerId,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }   
}