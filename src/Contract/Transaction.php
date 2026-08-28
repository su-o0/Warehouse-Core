<?php
namespace WarehouseCore\Contract;
use WarehouseCore\Connection\Statement;

abstract class Transaction {
    public function __construct(
        protected \PDO $db,
        protected string $transaction_name
    ) {
        $stmtClass = $db->getAttribute(\PDO::ATTR_STATEMENT_CLASS)[0] ?? null;
        if ($stmtClass !== Statement::class) {
            throw new \LogicException(
                'Repository must receive a PDO configured with Connection::get(), got raw PDO without Statement class.'
            );
        }
    }

    final protected function run(
        \Closure $callback
    ): mixed {
        $this->db->beginTransaction();

        try {
            $result = $callback();
            $this->db->commit();
            return $result;
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
    }

    final protected function begin_transaction(): void {
        $this->db->beginTransaction();
    }

    final protected function commit(): void {
        $this->db->commit();
    }

    final protected function roll_back(): void {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
    }
}