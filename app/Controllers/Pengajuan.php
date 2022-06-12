<?php

namespace App\Controllers;

use Config\Database;
use App\Models\M_dashboard;
use App\Models\M_pengajuan;

class Pengajuan extends BaseController
{

    private $m;

    public function __construct()
    {
        $this->m = new M_pengajuan();
        $this->db = Database::connect();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function index()
    {
        $data['menu'] = 'Pengajuan Peminjaman';
        $this->lib_sys->view('Pengajuan/index', $data);
    }

    public function daftar_pengajuan_fetch()
    {
        $this->datatables->search(['ruangan_nama', 'komunitas_nama', 'p.created_time', 'pengajuan_id', 'p.komunitas_id']);
        $this->datatables->select('ruangan_nama, komunitas_nama, p.created_time, pengajuan_id, p.komunitas_id, p.ruangan_id');
        $this->datatables->from('pengajuan as p');
        $this->datatables->join('komunitas as k', 'k.komunitas_id = p.komunitas_id');
        $this->datatables->join('ruangan as r', 'r.ruangan_id = p.ruangan_id');
        $this->datatables->where('p.status', '1');
        $m = $this->datatables->get();
        foreach ($m as $key => $value) {
            $m[$key]['pengajuan_id'] = '<button class="btn btn-sm btn-warning btn-icon dt-konfirmasi" target-id="' . $m[$key]['ruangan_id'] . '" user-id="' . $m[$key]['komunitas_id'] . '" onclick="dt_konfirmasi(this)"><i class="fas fa-sign-in-alt mr-2"></i>Konfirmasi</button>';
        }
        $this->datatables->render_no_keys($m);
    }

    public function konfirmasi_pengajuan()
    {
        $no_peminjaman = $this->no_transaksi('PN', 'peminjaman', ['DATE_FORMAT(created_time, "%Y%m")' => date('Ym')]);
        $this->m->konfirmasi_pengajuan($no_peminjaman);
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
