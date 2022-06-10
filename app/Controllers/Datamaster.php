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
                $m[$key]['ruangan_status'] = 'Tersedia';
            } else {
                $m[$key]['ruangan_status'] = 'Dipinjam';
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
        $response = $this->m->room_delete($room_id);
        if ($response) {
            print_r(json_encode(array('status' => 1, 'msg' => 'berhasil dihapus!')));
        } else {
            print_r(json_encode(array('status' => 0, 'msg' => 'gagal dihapus!')));
        }
    }
}
