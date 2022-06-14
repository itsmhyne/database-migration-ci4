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
        $this->session = \Config\Services::session();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function index()
    {
        $data['menu'] = "Ruangan";
        $this->lib_sys->view('peminjaman/index', $data);
    }

    public function room_fetch()
    {
        $user_id = $this->session->get('user_id');
        $this->datatables->search(['ruangan_nama', 'ruangan_status', 'ruangan_id']);
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
    }

    public function ajukan_peminjaman()
    {
        $this->m->ajukan_peminjaman();
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

    public function ruang_dipinjam()
    {
        $data['menu'] = "Riwayat Peminjaman";
        $this->lib_sys->view('ruang_dipinjam/index', $data);
    }

    public function ruangan_dipinjam_fetch()
    {
        $user_id = $this->session->get('user_id');
        $this->datatables->search(['peminjaman_nomor', 'ruangan_nama', 'peminjaman_status', 'peminjaman_id']);
        $this->datatables->select('peminjaman_nomor, ruangan_nama, peminjaman_status, peminjaman_id, p.ruangan_id');
        $this->datatables->from('peminjaman as p');
        $this->datatables->join('komunitas as k', 'k.komunitas_id = p.komunitas_id');
        $this->datatables->join('ruangan as r', 'r.ruangan_id = p.ruangan_id');
        $this->datatables->where('p.komunitas_id', $user_id);
        $this->datatables->where('p.status', '1');
        $m = $this->datatables->get();
        foreach ($m as $key => $value) {
            if ($m[$key]['peminjaman_status'] == 1) {
                $m[$key]['peminjaman_status'] = '<span class="badge bg-warning">Sedang Dipinjam</span>';
                $m[$key]['peminjaman_nomor'] = $m[$key]['peminjaman_nomor'] . '<button class="btn btn-icon btn-sm btn-info ml-2 dt-print" target-id="' . $m[$key]['peminjaman_id'] . '" onclick="print_peminjaman(this)"><i class="fas fa-print"></i></button>';
                $m[$key]['peminjaman_id'] = '<button class="btn btn-sm btn-warning btn-icon dt-kembalikan" ruangan-id="' . $m[$key]['ruangan_id'] . '" target-id="' . $m[$key]['peminjaman_id'] . '" onclick="dt_kembalikan(this)"><i class="fas fa-sign-in-alt mr-2"></i>Kembalikan</button>';
            } else {
                $m[$key]['peminjaman_status'] = '<span class="badge bg-success">Dikembalikan</span>';
                $m[$key]['peminjaman_id'] = '<button class="btn btn-sm btn-success btn-icon disabled"><i class="fas fa-check-circle mr-2"></i>Dikembalikan</button>';
            }
        }
        $this->datatables->render_no_keys($m);
    }

    public function ruangan_dipinjam_dikembalikan()
    {
        $peminjaman_id = $_POST['id'];
        $ruangan_id = $_POST['ruangan'];
        $this->m->ruangan_dipinjam_dikembalikan($peminjaman_id, $ruangan_id);
    }

    public function ruangan_dipinjam_print_bukti($peminjaman_id)
    {
        $data = $this->m->getBuktiPeminjaman($peminjaman_id);
        return view('ruang_dipinjam/printBukti', $data);
    }

    public function print_rekap()
    {
        $data = $this->m->getPrintRekap();
        return view('ruang_dipinjam/printRekap', $data);
    }

    // ADMIN - DAFTAR PEMINJAMAN

    public function daftar_peminjaman()
    {
        $data['menu'] = "Riwayat Peminjaman Ruangan";
        $this->lib_sys->view('peminjaman/daftar_peminjaman', $data);
    }

    public function daftar_peminjaman_fetch()
    {
        $this->datatables->search(['peminjaman_nomor', 'ruangan_nama', 'peminjaman_status', 'peminjaman_id']);
        $this->datatables->select('peminjaman_nomor, ruangan_nama, peminjaman_status, p.created_time, p.updated_time, peminjaman_id, p.ruangan_id');
        $this->datatables->from('peminjaman as p');
        $this->datatables->join('komunitas as k', 'k.komunitas_id = p.komunitas_id');
        $this->datatables->join('ruangan as r', 'r.ruangan_id = p.ruangan_id');
        $this->datatables->where('p.status', '1');
        $m = $this->datatables->get();
        foreach ($m as $key => $value) {
            if ($m[$key]['peminjaman_status'] == 1) {
                $m[$key]['peminjaman_status'] = '<span class="badge bg-primary">Dipinjam</span>';
                $m[$key]['peminjaman_id'] = '<button class="btn btn-sm btn-warning btn-icon dt-pinjam" target-id="' . $m[$key]['ruangan_id'] . '" onclick="dt_kembalikan(this)"><i class="fas fa-sign-in-alt mr-2"></i>Kembalikan</button>';
            } else {
                $m[$key]['peminjaman_status'] = '<span class="badge bg-danger">Dikembalikan</span>';
                $m[$key]['peminjaman_id'] = '<button class="btn btn-sm btn-warning btn-icon disabled"><i class="fas fa-sign-in-alt mr-2"></i>Dikembalikan</button>';
            }
        }
        $this->datatables->render_no_keys($m);
    }

    public function peminjaman_modal($html)
    {
        $data['var'] = $this->input->getPost('id');;
        $this->lib_sys->view_modal('peminjaman/' . $html, $data);
    }
}
