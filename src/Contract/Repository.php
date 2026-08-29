<?php
declare(strict_types=1);
namespace WarehouseCore\Contract;

use WarehouseCore\Connection\Statement;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

abstract class Repository {
    public function __construct(
        protected \PDO $db,
        protected string $table,
    ) {
        $stmtClass = $db->getAttribute(\PDO::ATTR_STATEMENT_CLASS)[0] ?? null;
        if ($stmtClass !== Statement::class) {
            throw new \LogicException(
                'Repository must receive a PDO configured with Connection::get(), got raw PDO without Statement class.'
            );
        }
    }

    final protected function prepare(
        string $sql
    ): \PDOStatement {
        return $this->db->prepare($sql);
    }

    final protected function query(
        string $sql,
        array $params = []
    ): \PDOStatement {
        try {
            $stmt = $this->prepare($sql);
            $stmt->execute($params);

            return $stmt;
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    final protected function fetchOne(
        string $sql,
        array $params = []
    ): ?array {
        $row = $this
            ->query($sql, $params)
            ->fetch(\PDO::FETCH_ASSOC);

        return $row === false
            ? null
            : $row;
    }

    final protected function fetchAll(
        string $sql,
        array $params = []
    ): array {
        return $this
            ->query($sql, $params)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    final protected function scalar(
        string $sql,
        array $params = []
    ): mixed {
        return $this
            ->query($sql, $params)
            ->fetchColumn();
    }

    final protected function execute(
        string $sql,
        array $params = []
    ): void {
        $this->query($sql, $params);
    }

    final protected function insert(
        string $sql,
        array $params = []
    ): int {
        $this->query($sql, $params);

        return (int) $this->db->lastInsertId();
    }

    final protected function affectedRows(
        string $sql,
        array $params = []
    ): int {
        return $this
            ->query($sql, $params)
            ->rowCount();
    }

    final protected function exists(
        string $sql,
        array $params = []
    ): bool {
        return $this->fetchOne($sql, $params) !== null;
    }

    // final protected function lock(
    //     string $sql,
    //     array $params = []
    // ): ?array {
    //     return $this->fetchOne(
    //         $sql . ' FOR UPDATE',
    //         $params
    //     );
    // }

    abstract protected function hydrate(
        array $raw
    ): object;

    final protected function entity(
        string $sql,
        array $params = []
    ): ?object {
        $row = $this->fetchOne($sql, $params);

        if ($row === null) {
            return null;
        }

        return $this->hydrate($row);
    }

    final protected function entities(
        string $sql,
        array $params = []
    ): array {
        return array_map(
            $this->hydrate(...),
            $this->fetchAll($sql, $params)
        );
    }

    final protected function statement(
        string $sql,
        array $params = []
    ): \PDOStatement
    {
        $stmt = $this->query($sql, $params);

        return $stmt;
    }
}