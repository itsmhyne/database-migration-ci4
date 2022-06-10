<?php

namespace App\Libraries;

use Config\Database;

class Select2
{

	private $collumns;
	private $table;
	private $search;
	private $where;
	private $where_in;
	private $where_in_columns;
	private $db;

	function __construct()
	{
		$this->session = session();
		$this->db = Database::connect();
		// $this->_ci = &get_instance();
	}

	function where($where)
	{
		$this->where = $where;
		return $this;
	}

	function where_in($where_in_columns, $where_in)
	{
		$this->where_in_columns = $where_in_columns;
		$this->where_in = $where_in;
		return $this;
	}

	function table($table)
	{
		$this->table = $table;
		return $this;
	}

	function set($id = '', $text = '')
	{
		$this->collumns = array($id, $text);
		return $this;
	}

	function search($search)
	{
		$this->search = $search;
		return $this;
	}

	function create_option($setup = array(), $return = false)
	{
		/*
			$set->where = where pada databse harus array
			$set->val_id = id dari tabel
			$set->val_label = label dari tabel
			$set->id = id yang digunakan untuk selected
			$set->table = tabel tujuan
		*/
		$set = json_decode(json_encode($setup));
		$CI = &get_instance();
		$db2 = $CI->load->database('db2', true);
		if (@$set->where) {
			$where = json_decode(json_encode($set->where), TRUE);
			if (is_array(@$where) && !empty(@$where)) $db2->where($where);
		}
		if (@$set->select) {
			$db2->select($set->select);
		} else {
			$db2->select("$set->val_id, $set->val_label");
		}
		if (@$set->join && is_array($set->join)) {
			foreach ($set->join as $key => $value) {
				$db2->join($value[0], $value[1], @$value[2]);
			}
		}
		$db = $db2->get($set->table)->result();
		$str = '';
		foreach ($db as $key => $var) {
			$val_id = $set->val_id;
			$val_label = @$set->val_label ?: $set->val_text;
			$selected = ($var->$val_id == @$set->id) ? 'selected=""' : '';
			$str .= "<option " . $selected . " value=\"" . $var->$val_id . "\">" . $var->$val_label . "</option>" . PHP_EOL;
		}
		if ($return) {
			return $str;
		} else {
			echo $str;
		}
	}

	function create_opt($setup = array(), $return = false)
	{
		/*
			$set->where = where pada databse harus array
			$set->val_id = id dari tabel
			$set->val_label = label dari tabel
			$set->id = id yang digunakan untuk selected
			$set->table = tabel tujuan
		*/
		$set = json_decode(json_encode($setup));
		$CI = &get_instance();
		if (@$set->where) {
			$where = json_decode(json_encode($set->where), TRUE);
			if (is_array(@$where) && !empty(@$where)) $CI->db->where($where);
		}
		if (@$set->select) {
			$CI->db->select($set->select);
		} else {
			$CI->db->select("$set->val_id, $set->val_label");
		}
		if (@$set->join && is_array($set->join)) {
			foreach ($set->join as $key => $value) {
				$CI->db->join($value[0], $value[1], @$value[2]);
			}
		}
		$db = $CI->db->get($set->table)->result();
		$str = '';
		foreach ($db as $key => $var) {
			$val_id = $set->val_id;
			$val_label = @$set->val_label ?: $set->val_text;
			$selected = ($var->$val_id == @$set->id) ? 'selected=""' : '';
			$str .= "<option " . $selected . " value=\"" . $var->$val_id . "\">" . $var->$val_label . "</option>" . PHP_EOL;
		}
		if ($return) {
			return $str;
		} else {
			echo $str;
		}
	}

	function generate()
	{
		$collumns = $this->collumns;
		$search = @$_POST['searchTerm'];
		$tb = get_instance()->db->like($collumns[1], $search);
		if (!empty($this->where))    get_instance()->db->where($this->where);
		if (!empty($this->where_in)) get_instance()->db->where_in($this->where_in_columns, $this->where_in);
		$tb = get_instance()->db->get($this->table)->result_array();
		$array = array();
		foreach ($tb as $key => $val) {
			$array[] = array(
				'id' => $val[$collumns[0]],
				'text' => $val[$collumns[1]],
			);
		}
		return json_encode($array, JSON_PRETTY_PRINT);
	}

	function create($u = '')
	{
		$url = base_url($u);
		$str = "
				ajax: { 
		           url: '$url',
		           type: 'post',
		           dataType: 'json',
		           delay: 250,
		           data: function (params) {
		              return {
		                searchTerm: params.term // search term
		              };
		           },
		           processResults: function (response) {
		              return {
		                 results: response
		              };
		           },
		           cache: true
		        }
		";
		print_r($str);
	}
}
