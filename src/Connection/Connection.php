<?php 
namespace WarehouseCore\Connection;

use WarehouseCore\Config\DatabaseConfig;
use WarehouseCore\Repository\Audit\JournalRepository;

final class Connection {
    private ?\PDO $db = null;

    public function __construct(
        private readonly DatabaseConfig $config,
        private readonly string $journal_table 
    ) { }

    private function createPDO(): \PDO {
        return new \PDO(
            "{$this->config->driver}:host={$this->config->host};dbname={$this->config->dbname};charset={$this->config->charset}",
            $this->config->user,
            $this->config->password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ],
        );
    }
    private function getJournal(): JournalRepository {
        return  new JournalRepository(
                $this->createPDO(),
                $this->journal_table
            );
    }
    
    public function get(): \PDO {   
        if ($this->db === null) {
            $this->db = $this->createPDO();

            $this->db->setAttribute(
                \PDO::ATTR_STATEMENT_CLASS,
                [
                    Statement::class,
                    [$this->getJournal()]
                ]
            );
        }
        return $this->db;
    }
}