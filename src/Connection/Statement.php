<?php
declare(strict_types=1);

namespace WarehouseCore\Connection;

use WarehouseCore\Repository\Audit\JournalRepository;

final class Statement extends \PDOStatement {
    protected function __construct(
        private JournalRepository $journal,
        private ?string $previous_hash = null
    ) {}

    public function execute(
        ?array $params = null
    ): bool {
        $started_at = new \DateTimeImmutable();
        try {
            $result = parent::execute($params);

            $finished_at = new \DateTimeImmutable();

            $hash = hash(
                'sha256',
                json_encode([
                    'previous_hash' => $this->previous_hash,
                    'statement' => $this->queryString,
                    'parameters' => $params ?? [],
                    'metadata' => [],
                    'started_at' => $started_at->format('Y-m-d H:i:s.u'),
                    'finished_at' => $finished_at->format('Y-m-d H:i:s.u'),
                    'affected_rows' => $this->rowCount(),
                    'success' => true,
                    'exception' => null,
                    'transaction_id' => null
                ], JSON_THROW_ON_ERROR)
            );

            $this->journal->add(
                previous_hash: $this->previous_hash,
                hash: $hash,
                statement: $this->queryString,
                parameters: $params ?? [],
                metadata: [],
                started_at: $started_at,
                finished_at: $finished_at,
                affected_rows: $this->rowCount(),
                success: true,
                exception: null,
                transaction_id: null
            );

            return $result;

        } catch (\Throwable $e) {
            $finished_at = new \DateTimeImmutable();

            $hash = hash(
                'sha256',
                json_encode([
                    'previous_hash' => $this->previous_hash,
                    'statement' => $this->queryString,
                    'parameters' => $params ?? [],
                    'metadata' => [],
                    'started_at' => $started_at->format('Y-m-d H:i:s.u'),
                    'finished_at' => $finished_at->format('Y-m-d H:i:s.u'),
                    'affected_rows' => 0,
                    'success' => false,
                    'exception' => $e->getMessage(),
                    'transaction_id' => null
                ], JSON_THROW_ON_ERROR)
            );

            $this->journal->add(
                previous_hash: $this->previous_hash,
                hash: $hash,
                statement: $this->queryString,
                parameters: $params ?? [],
                metadata: [],
                started_at: $started_at,
                finished_at: $finished_at,
                affected_rows: 0,
                success: false,
                exception: $e->getMessage(),
                transaction_id: null
            );

            throw $e;
        }
    }
}