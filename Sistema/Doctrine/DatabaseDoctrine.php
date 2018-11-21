<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 07/05/18
 * Time: 17:42
 */

namespace Sistema\Doctrine;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Statement;
use Illuminate\Support\Collection;
use Sistema\Datatables\DB\DatabaseInterface;
use Sistema\Exception\DatabaseException;

class DatabaseDoctrine implements DatabaseInterface
{
    /**
     * @var Statement
     */
    protected $stmt;

    /**
     * @var Connection
     */
    private $connection;

    function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function executeQuery($query, $data = [])
    {
        try {
            $this->stmt = $this->connection->executeQuery($query, $data);
        } catch (\Exception $e) {
            throw new DatabaseException($e->getMessage(), 0, $e, [
                'query' => $query,
                'markers' => $data
            ]);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get($fetch_class = null)
    {
        if (null === $fetch_class) {
            $this->stmt->setFetchMode(\PDO::FETCH_ASSOC);
        } else {
            $this->stmt->setFetchMode(\PDO::FETCH_CLASS, $fetch_class);
        }

        $rows = $this->stmt->fetchAll();

        return new Collection($rows);
    }

    public function getOne($fetch_class = null)
    {
        if (null === $fetch_class) {
            $this->stmt->setFetchMode(\PDO::FETCH_ASSOC);
        } else {
            $this->stmt->setFetchMode(\PDO::FETCH_CLASS, $fetch_class);
        }

        return $this->stmt->fetch();
    }

    /**
     * @inheritDoc
     */
    public function beginTransaction()
    {
        try {
            $this->connection->beginTransaction();
        } catch (\Exception $e) {
            throw new DatabaseException("Falha ao iniciar a transação", 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        try {
            $this->connection->commit();
        } catch (\Exception $e) {
            throw new DatabaseException("Falha ao finalizar a transação", 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function rollback()
    {
        try {
            $this->connection->rollBack();
        } catch (\Exception $e) {
            throw new DatabaseException("Falha ao desfazer a transação", 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function inTransaction()
    {
        return $this->connection->getWrappedConnection()->inTransaction();
    }

    /**
     * @inheritDoc
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
