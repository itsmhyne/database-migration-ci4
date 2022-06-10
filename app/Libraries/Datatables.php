<?php

namespace App\Libraries;

use Config\Database;

class Datatables
{

    private $table;
    private $column_order = []; //set column field database for datatable orderable
    private $column_search = []; //set column field database for datatable searchable 
    private $order = []; // default order 
    private $join = [];
    private $where = [];
    private $ci;
    private $group = [];
    private $like = [];
    private $where_in = [];
    private $select;
    private $db;
    private $builder;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function select($select)
    {
        $this->select = $select;
        return $this;
    }

    public function from($tables = '')
    {
        $this->table = $tables;
        return $this;
    }

    public function table($tables = '')
    {
        $this->table = $tables;
        return $this;
    }

    public function where_in($columns, $data)
    {
        $this->where_in[] = ['columns' => $columns, 'data' => $data];
        return $this;
    }

    public function column_order($co = [])
    {
        $this->column_order = $co;
        return $this;
    }

    public function search($cs)
    {
        $this->column_search = $cs;
        return $this;
    }

    public function column_search($cs)
    {
        $this->column_search = $cs;
        return $this;
    }

    public function order_by($columns, $order)
    {
        $this->order[] = ['columns' => $columns, 'order' => $order];
        return $this;
    }

    public function join($table, $where, $position = 'inner')
    {
        $this->join[] = ['table' => $table, 'where' => $where, 'position' => $position];
        return $this;
    }

    public function like($column, $string)
    {
        $this->like[] = ['column' => $column, 'string' => $string];
    }

    public function where($where, $val = '')
    {
        if (is_array($where)) {
            $this->where[] = $where;
        } else {
            $this->where[] = [$where => $val];
        }

        return $this;
    }

    public function group_by($group)
    {
        $this->group[] = $group;
        return $this;
    }

    private function _get_datatables_query()
    {
        $this->builder = $this->db->table($this->table);
        if ($this->select) $this->builder->select($this->select, false);
        if ($this->where_in) {
            $this->builder->groupStart();
            foreach ($this->where_in as $key => $val) {
                $this->builder->whereIn($val['columns'], $val['data'], false);
            }
            $this->builder->groupEnd();
        }

        if (!$this->column_search) {
            $this->column_search = explode(',', $this->select);
        }

        $this->column_order = $this->column_order ?: $this->column_search;

        foreach ($this->join as $key => $var) $this->builder->join($var['table'], $var['where'], $var['position'], false);
        foreach ($this->group as $key => $var) $this->builder->groupBy($var);
        foreach ($this->where as $key => $var) $this->builder->where($var);
        foreach ($this->like as $var) $this->builder->like($var['column'], $var['string']);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if (@$_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) { // first loop
                    $this->builder->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->builder->like($item, $_POST['search']['value']);
                } else {
                    $this->builder->orLike($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->builder->groupEnd(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $ordCol = $_POST['order']['0']['column'];
            $this->builder->orderBy($this->column_order[$ordCol], $_POST['order']['0']['dir'], false);
        } else if (isset($this->order)) {
            $order = $this->order;
            foreach ($order as $key => $var) {
                $this->builder->orderBy($var['columns'], $var['order'], false);
            }
        }
    }

    function build($ret){
        $draw = @$_POST['start'] ?: '0';
        $this->_get_datatables_query();
        if (@$_POST['length']) $this->builder->limit($_POST['length'], $_POST['start']);
        $data = $this->builder->get()->getResultArray();
        $render = $ret($data);
        $data = array_map('array_values', $render);
        $output = array(
            "draw" => (@$_POST['draw']) ?: '0',
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function getResult() {
        $draw = @$_POST['start'] ?: '0';
        $this->_get_datatables_query();
        if (@$_POST['length']) $this->builder->limit($_POST['length'], $_POST['start']);
        $render = $this->builder->get()->getResultArray();
        $data = array_map('array_values', $render);
        $output = array(
            "draw" => (@$_POST['draw']) ?: '0',
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function get()
    {
        $draw = $draw = $_POST['start'] ?: '0';
        $this->_get_datatables_query();
        if (@$_POST['length']) $this->builder->limit($_POST['length'], $_POST['start']);
        $data = $this->builder->get()->getResultArray();

        foreach ($data as $key => $value) {
            $data[$key]['number'] = intval($draw + ($key + 1));
        }
        return $data;
    }

    function render($data)
    {
        $output = array(
            "draw" => (@$_POST['draw']) ?: '0',
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function render_no_keys($array)
    {
        $data = array_map('array_values', $array);
        // foreach ($array as $key => $value) $data[] = array_values($value);
        $output = array(
            "draw" => (@$_POST['draw']) ?: '0',
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function generate($return = true)
    {
        $this->_get_datatables_query();
        if (@$_POST['length']) $this->builder->limit($_POST['length'], $_POST['start']);
        $data = $this->builder->get()->getResultArray();
        $output = array(
            "draw" => (@$_POST['draw']) ?: '0',
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        if ($return) {
            return $output;
        } else {
            echo json_encode($output);
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->builder;
        return $query->countAllResults();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        $query = $this->builder;
        return $query->countAllResults();
    }
}
