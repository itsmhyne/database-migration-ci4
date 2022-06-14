<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\System;
use App\Libraries\Datatables;
use App\Models\M_datamaster;
use Config\Database;

class Datamaster extends BaseController
{
    private $m;

    public function __construct()
    {
        $this->m = new M_datamaster();
        $this->db = Database::connect();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function room()
    {
        $data['menu'] = "Ruangan";
        $this->lib_sys->view('datamaster/room', $data);
    }

    public function room_modal($html)
    {
        $data['var'] = $this->db->table('ruangan')->where('ruangan_id', @$_GET['ruangan_id'])->get()->getRow();
        $this->lib_sys->view_modal('datamaster/' . $html, $data);
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
            } else {
                $m[$key]['ruangan_status'] = '<span class="badge bg-danger">Dipinjam</span>';
            }
        }
        $this->datatables->render_no_keys($m);
    }

    public function room_save()
    {
        $this->m->room_save();
    }

    public function room_delete()
    {
        $room_id = $_POST['id'];
        $this->m->room_delete($room_id);
    }

    public function komunitas()
    {
        $data['menu'] = "Komunitas";
        $this->lib_sys->view('datamaster/komunitas', $data);
    }

    public function komunitas_fetch()
    {
        $this->datatables->search(['komunitas_logo', 'komunitas_nama', 'bidang', 'jml_anggota', 'ketua', 'kontak', 'komunitas_id']);
        $this->datatables->select('komunitas_logo, komunitas_nama, bidang, jml_anggota, ketua, kontak, komunitas_id');
        $this->datatables->from('komunitas as k');
        $this->datatables->where('status', '1');
        $m = $this->datatables->get();
        foreach ($m as $key => $value) {
            if ($m[$key]['komunitas_logo']) {
                $m[$key]['komunitas_logo'] = '<img src="' . \base_url('public/assets/dist/img/user') . '/' . $m[$key]['komunitas_logo'] . '" class="profile-user-img img-fluid img-circle"/>';
            }
            if ($m[$key]['komunitas_id']) {
                $m[$key]['komunitas_id'] = '<button class="btn btn-sm btn-danger btn-icon dt-status" target-id="' . $m[$key]['komunitas_id'] . '" onclick="dt_status(this)"><i class="fas fa-power-off mr-2"></i>Nonaktifkan</button>';
            }
        }
        $this->datatables->render_no_keys($m);
    }

    public function komunitas_modal($html)
    {
        $data['var'] = $this->db->table('komunitas')->where('komunitas_id', @$_GET['id'])->get()->getRow();
        $this->lib_sys->view_modal('Datamaster/' . $html, $data);
    }

    public function nonaktifkan_komunitas()
    {
        $this->m->nonaktifkan_komunitas();
    }
}
