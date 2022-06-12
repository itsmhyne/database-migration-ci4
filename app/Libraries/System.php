<?php

namespace App\Libraries;

use App\Models\M_peminjaman;
use Config\Database;

class System
{

	private $_ci;
	private $_javascript_bottom_custom = array();
	private $_javascript_top_custom = array();
	private $_css_custom = array();
	private $_menu_kode;
	private $session;
	private $db;

	function __construct()
	{
		$this->session = session();
		$this->db = Database::connect();
		// $this->_ci = &get_instance();
		$this->m = new M_peminjaman();
	}

	function view($html, $data = array())
	{

		$data['session_name'] = $this->session->name;
		$data['session_foto'] = $this->session->user_foto;
		$data['session_user_id'] = $this->session->user_id;
		$data['session_group_id'] = $this->session->group_id;
		$data['jumlahPengajuan'] = $this->db->table('pengajuan')->select('count(0) as pengajuan')->where('status', 1)->get()->getRow('pengajuan');
		// $data['sidebar_parent'] = $this->db->table('_sys_sidebar')->where(['sidebar_parent' => '0', 'status' => '1'])->get()->getResult();
		if (is_array($html)) {
			$data = array_merge($data, $html);
		} else {
			$data['content'] = view($html, $data);
		}
		echo view('partial/template', $data);
	}

	function view_modal($html, $data = array())
	{
		echo $this->render_custom_css();
		echo $this->render_javascript_top_custom();
		echo view($html, $data);
		echo $this->render_javascript_bottom_custom();
	}

	// function view_page_label()
	// {
	// 	$db = $this->db->table('_v_sys_page_access')->where('href', uri_string())->get()->getRow();
	// 	if (count($db) > 0) {
	// 		$data = $db;
	// 		$render = '<i class="' . $data->icon . '"></i>';
	// 		$render .= '<span class="ml-2">' . $data->label . '</span>';
	// 		return $render;
	// 	}
	// }

	// function view_page_title()
	// {
	// 	$db = $this->db->table('_v_sys_page_access')->where('href', uri_string())->get()->getRow();
	// 	if (count($db) > 0) {
	// 		return $db->label;
	// 	} else {
	// 		return '';
	// 	}
	// }

	// function add_javascript_top_custom($javascript)
	// {
	// 	array_push($this->_javascript_top_custom, $javascript);
	// }

	function render_javascript_top_custom()
	{
		$javascript = '';
		foreach ($this->_javascript_top_custom as $val) {
			$javascript .= PHP_EOL . '<script type="text/javascript" src="' . base_url($val) . '"></script>';
		}
		$javascript .= PHP_EOL;
		return $javascript;
	}

	// function add_javascript_bottom_custom($javascript)
	// {
	// 	array_push($this->_javascript_bottom_custom, $javascript);
	// }

	function render_javascript_bottom_custom()
	{
		$javascript = '';
		foreach ($this->_javascript_bottom_custom as $val) {
			$javascript .= PHP_EOL . '<script type="text/javascript" src="' . base_url($val) . '"></script>';
		}
		$javascript .= PHP_EOL;
		return $javascript;
	}

	// function add_css_custom($css)
	// {
	// 	array_push($this->_css_custom, $css);
	// }

	function render_custom_css()
	{
		$css = '';
		foreach ($this->_css_custom as $val) {
			$css .= PHP_EOL . '<link rel="stylesheet" type="text/css" href="' . base_url($val) . '">';
		}
		$css .= PHP_EOL;
		return $css;
	}

	// function set_menu($kode)
	// {
	// 	$this->_menu_kode = $kode;
	// 	return $this;
	// }

	// function get_menu_info($row = '')
	// {
	// 	return $this->_ci->db->where('sidebar_kode', $this->_menu_kode)
	// 		->get('_sys_sidebar')
	// 		->row($row);
	// }

	// function userdata()
	// {
	// 	$user_id = $this->session->user_id;
	// 	return $this->db->table('_v_sys_user')->where('user_id', $user_id)->get()->getRow();
	// }

	// function get_access($param)
	// {
	// 	$group_id = $this->session->group_id;
	// 	if ($group_id > 1) {
	// 		$get_access = $this->db->table('_v_sys_page_access')->where($param)->where('group_id', $group_id)->get()->getRow();
	// 		return $get_access;
	// 	} else {
	// 		return true;
	// 	}
	// }

	// function get_access_page($row)
	// {
	// 	$group_id = $this->session->group_id;
	// 	if ($group_id > 1) {
	// 		$get_access = $this->db->table('_v_sys_page_access')->where('href', $this->current_url())->where('group_id', $group_id)->get()->getRow($row);
	// 		return $get_access;
	// 	} else {
	// 		return true;
	// 	}
	// }

	// // service backup
	// function get_access_page_by_kode($row)
	// {
	// 	$group_id = $this->session->group_id;
	// 	if ($group_id > 1) {
	// 		$get_access = $this->db->table('_v_sys_page_access')->where('sidebar_kode', $this->_menu_kode)->where('group_id', $group_id)->get()->getRow($row);
	// 		return $get_access;
	// 	} else {
	// 		return true;
	// 	}
	// }

	// function get_access_button($row, $html)
	// {
	// 	$access = $this->get_access_page_by_kode($row);
	// 	return $access ? $html : '';
	// }

	// function get_access_button_add()
	// {
	// 	$access = $this->get_access_page_by_kode('create');
	// 	return (intval($access) > 0) ? true : false;
	// }

	// function anchor_dt_add($url, $label)
	// {
	// 	$dt_btn = '';

	// 	if ($this->get_access_page_by_kode('create')) {
	// 		$dt_btn = '<a href="' . base_url($url) . '" class="btn btn-success btn-elevate btn-icon-sm">
	// 			<i class="fa fa-plus"></i> ' . $label . '
	// 		</a>';
	// 	}

	// 	return $dt_btn;
	// }


	// function anchor_dt_edit()
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('update')) {
	// 		$dt_btn = '<a class="btn btn-warning btn-icon dt-edit"><i class="fa fa-edit"></i></a>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btnSimpan($label)
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('create')) {
	// 		$dt_btn = '<button type="submit" class="btn btn-success btn-lg">' . $label . '</button>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btn_dt_add($js_function, $label)
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('create')) {
	// 		$dt_btn = '<button onclick="' . $js_function . '" class="btn btn-success btn-elevate btn-icon-sm">
	// 				<i class="fa fa-plus"></i> ' . $label . '
	// 			</button>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btn_dt_b($js_function, $label)
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('create')) {
	// 		$dt_btn = '<button onclick="' . $js_function . '" class="btn btn-success btn-elevate btn-icon-sm">
	// 				<i class="fa fa-tag"></i> ' . $label . '
	// 			</button>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btn_dt_edit()
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('update')) {
	// 		$dt_btn = '<button class="btn btn-warning btn-icon dt-edit"><i class="fa fa-edit"></i></button>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btn_dt_delete()
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('delete')) {
	// 		$dt_btn = '<button class="btn btn-danger btn-icon dt-delete"><i class="fa fa-trash"></i></button>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btn_dt_delete_arus_kas($idTarget)
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('delete')) {
	// 		$dt_btn = '<button class="btn btn-danger btn-icon btn-sm float-right" target-id="' . $idTarget . '" onclick="dt_delete(this)" dt-delete"><i class="fa fa-trash"></i></button>';
	// 	}
	// 	return $dt_btn;
	// }

	// function btn_dt_print_arus_kas($idTarget)
	// {
	// 	$dt_btn = '';
	// 	if ($this->get_access_page_by_kode('delete')) {
	// 		$dt_btn = '<button class="btn btn-info btn-icon btn-sm float-right mr-2" target-id="' . $idTarget . '" onclick="dt_print(this)" dt-print"><i class="fas fa-print"></i></button>';
	// 	}
	// 	return $dt_btn;
	// }

	function check_is_login()
	{
		$is_logged_in = $this->session->is_logged_in;

		if (!$is_logged_in) {
			return redirect()->to(base_url() . '/Auth/logout');
		}
	}

	// function current_url()
	// {
	// 	$url = uri_string();
	// 	$url = str_replace('_add', '', $url);
	// 	$url = str_replace('_edit', '', $url);
	// 	$url = str_replace('_fetch', '', $url);
	// 	$url = str_replace('_save', '', $url);
	// 	$url = str_replace('_delete', '', $url);
	// 	return $url;
	// }

	// function is_readable_page($row = "")
	// {
	// 	$row = $row ?: 'read';
	// 	$read = $this->get_access_page_by_kode($row);
	// 	if (intval($read) < 1) {
	// 		redirect()->to(base_url() . 'Dashboard');
	// 	}
	// 	return $this;
	// }

	// function is_readable_page_()
	// {
	// 	$exclude = array('modal', 'search');
	// 	$read = $this->get_access_page_by_kode('read');
	// 	if ($this->strpos_arr($this->current_url(), $exclude)) {
	// 		$read = true;
	// 	}
	// 	if (!$read) {
	// 		redirect()->to(base_url() . 'Auth/logout');
	// 	}
	// }

	// function strpos_arr($haystack, $needle)
	// {
	// 	if (!is_array($needle)) $needle = array($needle);
	// 	foreach ($needle as $what) {
	// 		if (($pos = strpos($haystack, $what)) !== false) return $pos;
	// 	}
	// 	return false;
	// }

	// function sidebar_childs_get($param)
	// {
	// 	$this->_ci->db->where($param);
	// 	return $this->_ci->db->get('_sys_sidebar')->result();
	// }

	// function sidebar_is_have_child($sidebar_id)
	// {
	// 	$this->_ci->db->where(['sidebar_parent' => $sidebar_id]);
	// 	return $this->_ci->db->get('_sys_sidebar')->num_rows();
	// }

	function update_peminjaman()
	{
		$user_id = $this->session->get('user_id');
		$group = $this->session->get('group_id');
		if ($this->session->get('group_id') == 1) {
			$peminjaman = $this->db->table('peminjaman')
				->where('peminjaman_status', 1)
				->get()
				->getResultArray();
			foreach ($peminjaman as $key => $value) {
				$created_time = \date_create($value['created_time']);
				\date_add($created_time, \date_interval_create_from_date_string('5 minutes'));
				$date_input =  \date_format($created_time, 'Y-m-d H:i:s');
				if (\strtotime($date_input) < \strtotime(date('Y-m-d H:i:s'))) {
					// // update data ke table peminjaman
					$tabelPeminjaman = $this->db->table('peminjaman');
					$dataPeminjam =  [
						'peminjaman_status' => 2, //
						'updated_time' => date('Y-m-d H:i:s'),
						'updated_by' => $user_id
					];
					$tabelPeminjaman->set($dataPeminjam)
						->where('peminjaman_id', $value['peminjaman_id'])
						->update();

					// update status ruangan
					$tabelRuangan = $this->db->table('ruangan');
					$dataRuangan =  [
						'ruangan_status' => 1 // status di ubah menjadi tersedia
					];
					$tabelRuangan->set($dataRuangan)
						->where('ruangan_id', $value['ruangan_id'])
						->update();
				}
			}
		}
	}
}
