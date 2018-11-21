<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 29/11/17
 * Time: 16:54
 */

namespace Sistema\Datatables;

use Sistema\Datatables\DB\DataSourceInterface;
use Zend\Diactoros\Response\JsonResponse;

class Datatables
{
    protected $add;
    private $params = [];
    protected $db;
    protected $data;
    protected $recordstotal;
    protected $recordsfiltered;
    protected $columns;
    protected $edit;
    protected $hide;
    protected $sql;
    protected $query;
    protected $hasOrderIn;

    function __construct(DataSourceInterface $db)
    {
        $this->input = isset($_POST["draw"]) ? $_POST : $_GET;
        $this->db = $db;
    }

    /**
     * Informa a query a ser executada no datasource
     *
     * @param $query
     * @return $this|Datatables
     */
    public function query($query): Datatables
    {
        $this->hasOrderIn = $this->isQueryWithOrderBy($query);
        $this->columns = $this->setcolumns($query);
        $columns = implode(", ", $this->columns);
        $query = rtrim($query, "; ");
        $this->sql = "Select $columns from ($query)t";

        return $this;
    }

    /**
     * Adiciona uma nova coluna
     *
     * @param string $newColumn
     * @param callable $closure
     * @return $this|Datatables
     */
    public function add(string $newColumn, callable $closure): Datatables
    {
        $this->add[ $newColumn ] =  $closure;
        return $this;
    }

    /**
     * Edita uma coluna
     *
     * @param string $column
     * @param callable $closure
     * @return $this|Datatables
     */
    public function edit(string $column, callable $closure): Datatables
    {
        $this->edit[ $column ] = $closure;
        return $this;
    }

    /**
     * Informa as colunas que deverão ser escondidas no envio da resposta
     *
     * @param array ...$columns
     * @return $this
     */
    public function hide(...$columns)
    {
        $columns = array_intersect($this->columns, $columns);
        $this->hide = array_merge((array) $this->hide, array_combine($columns, $columns));
        return $this;
    }

    /**
     * Define dados do datatables.
     *
     * O callable é executado a cada iteração, passando os dados da linha atual. O
     * retorno deve ser um array com os dados a serem adicionados à linha.
     *
     * @param callable $rowData
     * @return $this|Datatables
     */
    public function setRowData(callable $rowData): Datatables
    {
        $this->add('DT_RowData', $rowData);
        return $this;
    }

    /**
     * Seta o id do elemento tr da tabela.
     *
     * O callable é executado a cada iteração e deve retornar o id da linha.
     * @param callable $rowId
     * @return $this|Datatables
     */
    public function setRowId(callable $rowId): Datatables
    {
        $this->add('DT_RowId', $rowId);
        return $this;
    }

    /**
     * Seta a classe do elemento tr do datatables.
     *
     * O callable informado é executado a cada iteração, sendo passado
     * os dados de cada linha. Deve retornar a classe da linha especificada.
     *
     * @param callable $rowClass
     * @return $this|Datatables
     */
    public function setRowClass(callable $rowClass): Datatables
    {
        $this->add('DT_RowClass', $rowClass);
        return $this;
    }

    /**
     * Gera o datatables
     *
     * @return JsonResponse
     */
    public function generate()
    {
        $this->execute();
        $formatted_data = array();

        foreach ($this->data as $key => $row)
        {
            // novas colunas
            if (count($this->add) > 0)
            {
                foreach ($this->add as $add_column => $closure)
                {
                    $row[$add_column] = $closure($row);
                }
            }

            // editing columns..
            if (count($this->edit) > 0) {
                foreach ($this->edit as $edit_column => $closure)
                {
                    $row[ $edit_column ] = $closure($row);
                }
            }

            // hide unwanted columns from output
            $row = array_diff_key($row, (array) $this->hide);

            $formatted_data[] = $this->isIndexed($row);
        }

        $response['draw'] = $this->input('draw');
        $response['recordsTotal'] = $this->recordstotal;
        $response['recordsFiltered'] = $this->recordsfiltered;
        $response['data'] = $formatted_data;

        return new JsonResponse($response);
    }

    /**
     * Adiciona os paramêtros para serem substituídos na query
     * @param array $params
     */
    public function bindParams(array $params)
    {
        $this->params = $params;
    }

    protected function filterglobal()
    {
        $searchinput = $this->input('search')['value'];
        $allcolumns = $this->input('columns');

        if ($searchinput == '')
        {
            return null;
        }

        $search = array();
        $searchinput = preg_replace("/[^\wá-žÁ-Ž]+/", " ", $searchinput);
        foreach (explode(' ', $searchinput) as $word)
        {
            $lookfor = array();
            //echo "<pre>";
            //print_r($this->columns);
            foreach ($this->columns as $key => $column)
            {
                if ($allcolumns[ $key ]['searchable'] == 'true')
                {
                    $lookfor[] = $column . "::TEXT ILIKE " . $this->db->escape($word) . "";
                }
            }
            $search[] = "(" . implode(" OR ", $lookfor) . ")";
        }

        return implode(" AND ", $search);
    }

    protected function filterindividual()
    {
        $allcolumns = $this->input('columns');

        $search = " (";
        $lookfor = array();

        if ( ! $allcolumns)
        {
            return null;
        }

        foreach ($allcolumns as $key)
        {
            if ($key['search']['value'] <> "" and $key['searchable'] == 'true')
            {
                $lookfor[] = $this->column($key['data']) . "::TEXT ILIKE " . $this->db->escape('%' . $key['search']['value'] . '%') . "";
            }
        }

        if (count($lookfor) > 0)
        {
            $search .= implode(" AND ", $lookfor) . ")";

            return $search;
        }

        return null;
    }

    protected function execute()
    {
        $this->recordstotal = $this->db->count($this->sql, $this->params); // unfiltered data count is here.
        $where = $this->filter();
        $this->recordsfiltered = $this->db->count($this->sql . $where, $this->params);  // filtered data count is here.
        $this->query = $this->sql . $where . $this->orderby() . $this->limit();

        $this->data = $this->db->query($this->query, $this->params);

        return $this;
    }

    protected function filter()
    {
        $search = '';

        $filterglobal = $this->filterglobal();
        $filterindividual = $this->filterindividual();

        if ( ! $filterindividual && ! $filterglobal)
        {
            return null;
        }

        $search .= $filterglobal;

        if ($filterindividual <> null && $filterglobal <> null)
        {
            $search .= ' AND ';
        }

        $search .= $filterindividual;
        $search = " WHERE " . $search;

        return $search;
    }

    protected function setcolumns($query)
    {
        $query = preg_replace("/\((?:[^()]+|(?R))*+\)/is", "", $query);
        preg_match_all("/SELECT([\s\S]*?)((\s*)\bFROM\b(?![\s\S]*\)))([\s\S]*?)/is", $query, $columns);

        $columns = $this->explode(",", $columns[1][0]);

        // gets alias of the table -> 'table.column as col' or 'table.column col' to 'col'
        $regex[] = "/(.*)\s+as\s+(.*)/is";
        $regex[] = "/.+(\([^()]+\))?\s+(.+)/is";
        // wipe unwanted characters => '`" and space
        $regex[] = '/[\s"\'`]+/';
        // if there is no alias, return column name -> table.column to column
        $regex[] = "/([\w\-]*)\.([\w\-]*)/";

        return preg_replace($regex, "$2", $columns);
    }

    protected function isQueryWithOrderBy($query)
    {
        return (bool) count(preg_grep("/(order\s+by)\s+(.+)$/i", explode("\n", $query)));
    }

    protected function limit()
    {
        $take = 10;
        $skip = (integer) $this->input('start');

        if ($this->input('length'))
        {
            $take = (integer) $this->input('length');
        }

        if ($take == - 1 || ! $this->input('draw'))
        {
            return null;
        }

        return " LIMIT $take OFFSET $skip";
    }

    protected function orderby()
    {
        $dtorders = $this->input('order');
        $orders = " ORDER BY ";
        $dir = ['asc' => 'asc', 'desc' => 'desc'];

        if ( ! is_array($dtorders))
        {
            if ($this->hasOrderIn)
            {
                return null;
            }

            return $orders . $this->columns[0] . " asc";  // default
        }

        foreach ($dtorders as $order)
        {
            $takeorders[] = $this->columns[ $order['column'] ] . " " . $dir[ $order['dir'] ];
        }

        return $orders . implode(",", $takeorders);
    }

    protected function input($input)
    {
        if (isset($this->input[ $input ]))
        {
            return $this->input[ $input ];
        }

        return false;
    }

    protected function column($input)
    {
        if (is_numeric($input))
        {
            return $this->columns[ $input ];
        }

        return $input;
    }

    protected function isIndexed($row) // if data source uses associative keys or index number
    {
        $column = $this->input('columns');
        if (is_numeric($column[0]['data']))
        {
            return array_values($row);
        }

        return $row;
    }

    protected function balanceChars($str, $open, $close)
    {
        $openCount = substr_count($str, $open);
        $closeCount = substr_count($str, $close);
        $retval = $openCount - $closeCount;

        return $retval;
    }

    protected function explode($delimiter, $str, $open = '(', $close = ')')
    {
        $retval = array();
        $hold = array();
        $balance = 0;
        $parts = explode($delimiter, $str);
        foreach ($parts as $part)
        {
            $hold[] = $part;
            $balance += $this->balanceChars($part, $open, $close);
            if ($balance < 1)
            {
                $retval[] = implode($delimiter, $hold);
                $hold = array();
                $balance = 0;
            }
        }
        if (count($hold) > 0)
        {
            $retval[] = implode($delimiter, $hold);
        }

        return $retval;
    }
}