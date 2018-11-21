<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 29/11/17
 * Time: 16:56
 */

namespace Sistema\Datatables\DB;

use Illuminate\Support\Collection;

class PostgreSQL implements DataSourceInterface
{
    /**
     * @var DatabaseInterface
     */
    private $database;

    private $escape = [];

    function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @inheritDoc
     */
    public function query($query, $params = []): Collection
    {
        $this->database->executeQuery($query, array_merge($params, $this->escape));
        return $this->database->get();
    }

    /**
     * @inheritDoc
     */
    public function count($query, $params = []): int
    {
        $query = rtrim($query, "; \t\r\n\0\x0B");
        $query = "Select count(*) as count from ({$query}) count_table";
        $this->database->executeQuery($query, array_merge($params, $this->escape));
        return $this->database->get()->first()['count'];
    }

    /**
     * @inheritDoc
     */
    public function escape(string $string): string
    {
        $this->escape[':escape' . (count($this->escape) + 1) ] = '%' . $string . '%';
        return ":escape" . (count($this->escape));
    }
}