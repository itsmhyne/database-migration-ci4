<?php

namespace App\Controllers;

use Config\Database;
use App\Models\M_dashboard;
use App\Models\M_manajemen;
use App\Models\M_pengajuan;

class Manajemen extends BaseController
{

    private $m;

    public function __construct()
    {
        $this->m = new M_manajemen();
        $this->db = Database::connect();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function index()
    {
        $data['menu'] = 'Manajemen Admin';
        $this->lib_sys->view('manajemen_admin/index', $data);
    }

    public function admin_fetch()
    {
        $this->datatables->search(['user_name', 'user_foto', 'user_phone', 'email', 'user_address', 'user_id']);
        $this->datatables->select('user_name, user_foto, user_phone, email, user_address, user_id');
        $this->datatables->from('_sys_user as su');
        $this->datatables->where('su.status', '1');
        $m = $this->datatables->get();
        foreach ($m as $key => $value) {
            $m[$key]['user_foto'] = '<img src="' . \base_url('public/assets/dist/img/user/') . '/' . $value['user_foto'] . '" width="100"/>';
            $m[$key]['user_id'] = '<button class="btn btn-sm btn-danger btn-icon dt-status" target-id="' . $m[$key]['user_id'] . '" onclick="dt_status(this)"><i class="fas fa-sign-in-alt mr-2"></i>Nonaktifkan</button>';
        }
        $this->datatables->render_no_keys($m);
    }

    public function manajemen_modal($html)
    {
        $data['var'] = $this->db->table('_sys_user')->where('user_id', @$_GET['id'])->get()->getRow();
        $this->lib_sys->view_modal('manajemen_admin/' . $html, $data);
    }

    public function nonaktifkan_akun()
    {
        $this->m->nonaktifkan_akun();
    }

    public function tambah_admin()
    {
        $this->m->tambah_admin();
    }
}
