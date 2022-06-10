<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\System;
use App\Libraries\Datatables;
use App\Models\M_peminjaman;
use Config\Database;

class Peminjaman extends BaseController
{
    private $m;

    public function __construct()
    {
        $this->m = new M_peminjaman();
        $this->db = Database::connect();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function index()
    {
        $data['menu'] = "Peminjaman Ruangan";
        $this->lib_sys->view('peminjaman/index', $data);
    }

    public function room_fetch()
    {
        $this->datatables->search(['ruangan_nama', 'ruangan_status']);
        $this->datatables->select('ruangan_nama, ruangan_status, ruangan_id');
        $this->datatables->from('ruangan as a');
        $this->datatables->where('a.status', '1');
        $m = $this->datatables->get();
        foreach ($m as $key => $value) {
            if ($m[$key]['ruangan_status'] == 1) {
                $m[$key]['ruangan_status'] = '<span class="badge bg-primary">Tersedia</span>';
                $m[$key]['ruangan_id'] = '<button class="btn btn-sm btn-warning btn-icon dt-pinjam" target-id="' . $m[$key]['ruangan_id'] . '" onclick="dt_pinjam(this)"><i class="fas fa-sign-in-alt mr-2"></i>Pinjam</button>';
            } else {
                $m[$key]['ruangan_status'] = '<span class="badge bg-danger">Dipinjam</span>';
                $m[$key]['ruangan_id'] = '<button class="btn btn-sm btn-warning btn-icon disabled"><i class="fas fa-sign-in-alt mr-2"></i>Pinjam</button>';
            }
        }
        $this->datatables->render_no_keys($m);
    }

    public function room_pinjam()
    {
        $room_id = $_POST['id'];
        // generate nomor peminjaman
        $no_peminjaman = $this->no_transaksi('PN', 'peminjaman', ['DATE_FORMAT(created_time, "%Y%m")' => date('Ym')]);
        $response = $this->m->room_pinjam($room_id, $no_peminjaman);
        if ($response) {
            print_r(json_encode(array('status' => 1, 'msg' => 'Berhasil Dipinjam!')));
        } else {
            print_r(json_encode(array('status' => 0, 'msg' => 'Gagal Dipinjam!')));
        }
    }

    public function no_transaksi($kode, $table, $params)
    {
        $count = $this->db->table($table)
            ->select('count(0) as total')
            ->where($params)
            ->where('status', '1')
            ->get()->getRow('total') ?: '0';
        $count++;
        $date = date('Ym');
        return sprintf("{$kode}{$date}%04d", $count);
    }
}
