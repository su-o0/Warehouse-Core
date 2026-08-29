<?php
declare(strict_types=1);
namespace WarehouseCore\Repository\Audit;

final class JournalRepository {
    public function __construct(
        private \PDO $db,
        private string $table
    ) {}

    public function add(
        ?string $previous_hash,
        string $hash,
        string $statement,
        array $parameters,
        array $metadata,
        \DateTimeImmutable $started_at,
        \DateTimeImmutable $finished_at,
        int $affected_rows,
        bool $success,
        ?string $exception,
        ?string $transaction_id
    ): int {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table}
            (
                previous_hash,
                hash,
                statement,
                parameters,
                metadata,
                started_at,
                finished_at,
                affected_rows,
                success,
                exception,
                transaction_id
            )
            VALUES
            (
                :previous_hash,
                :hash,
                :statement,
                :parameters,
                :metadata,
                :started_at,
                :finished_at,
                :affected_rows,
                :success,
                :exception,
                :transaction_id
            )"
        );

        $stmt->execute([
            ':previous_hash' => $previous_hash,
            ':hash' => $hash,
            ':statement' => $statement,
            ':parameters' => json_encode(
                $parameters,
                JSON_THROW_ON_ERROR
            ),
            ':metadata' => json_encode(
                $metadata,
                JSON_THROW_ON_ERROR
            ),
            ':started_at' => $started_at->format('Y-m-d H:i:s.u'),
            ':finished_at' => $finished_at->format('Y-m-d H:i:s.u'),
            ':affected_rows' => $affected_rows,
            ':success' => $success ? 1 : 0,
            ':exception' => $exception,
            ':transaction_id' => $transaction_id
        ]);

        return (int) $this->db->lastInsertId();
    }
}