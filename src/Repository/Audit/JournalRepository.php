<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\JournalEntity;

final class JournalRepository extends Repository {
    public function hydrate(
        array $raw
    ): JournalEntity {
        return JournalEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?JournalEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByHash(
        string $hash
    ): ?JournalEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE hash = :hash",
            [
                ':hash' => $hash
            ]
        );
    }

    public function findByPreviousHash(
        string $previous_hash
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE previous_hash = :previous_hash",
            [
                ':previous_hash' => $previous_hash
            ]
        );
    }

    public function findByTransactionId(
        string $transaction_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE transaction_id = :transaction_id",
            [
                ':transaction_id' => $transaction_id
            ]
        );
    }

    public function findBySuccess(
        bool $success
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE success = :success",
            [
                ':success' => $success
            ]
        );
    }

    public function findByCreatedAt(
        string $created_at
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE created_at = :created_at",
            [
                ':created_at' => $created_at
            ]
        );
    }

    public function add(
        ?string $previous_hash,
        string $hash,
        string $statement,
        ?string $parameters,
        ?string $metadata,
        string $started_at,
        string $finished_at,
        int $affected_rows,
        bool $success,
        ?string $exception,
        ?string $transaction_id
    ): int {
        try {
            return $this->insert(
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
                )",
                [
                    ':previous_hash' => $previous_hash,
                    ':hash' => $hash,
                    ':statement' => $statement,
                    ':parameters' => $parameters,
                    ':metadata' => $metadata,
                    ':started_at' => $started_at,
                    ':finished_at' => $finished_at,
                    ':affected_rows' => $affected_rows,
                    ':success' => $success,
                    ':exception' => $exception,
                    ':transaction_id' => $transaction_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePreviousHash(
        int $id,
        ?string $previous_hash
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET previous_hash = :previous_hash
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':previous_hash' => $previous_hash
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateHash(
        int $id,
        string $hash
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET hash = :hash
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':hash' => $hash
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStatement(
        int $id,
        string $statement
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET statement = :statement
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':statement' => $statement
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateParameters(
        int $id,
        ?string $parameters
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET parameters = :parameters
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':parameters' => $parameters
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateMetadata(
        int $id,
        ?string $metadata
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET metadata = :metadata
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':metadata' => $metadata
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStartedAt(
        int $id,
        string $started_at
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET started_at = :started_at
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':started_at' => $started_at
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateFinishedAt(
        int $id,
        string $finished_at
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET finished_at = :finished_at
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':finished_at' => $finished_at
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateAffectedRows(
        int $id,
        int $affected_rows
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET affected_rows = :affected_rows
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':affected_rows' => $affected_rows
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateSuccess(
        int $id,
        bool $success
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET success = :success
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':success' => $success
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateException(
        int $id,
        ?string $exception
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET exception = :exception
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':exception' => $exception
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateTransactionId(
        int $id,
        ?string $transaction_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET transaction_id = :transaction_id
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':transaction_id' => $transaction_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE id = :id",
                [
                    ':id' => $id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}