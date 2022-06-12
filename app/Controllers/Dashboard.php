<?php

namespace App\Controllers;

use Config\Database;
use App\Models\M_dashboard;

class Dashboard extends BaseController
{

    private $m;

    public function __construct()
    {
        $this->m = new M_dashboard();
        $this->db = Database::connect();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function index()
    {
        $data['menu'] = 'Dashboard';
        $data['bulan'] = $this->db->table('bulan')->get()->getResultArray();
        $data['tahun'] = $this->db->table('peminjaman')->select('YEAR(created_time)')->groupBy('YEAR(created_time)')->get()->getResultArray('YEAR(created_time)');
        $this->lib_sys->view('Dashboard/dashboard', $data);
    }


    public function dashboardData()
    {
        if ($this->input->getPost('tahun')) {
            $param['year'] = $this->input->getPost('tahun');
        } else {
            $param['year'] = date('Y');
        }

        if ($this->input->getPost('bulan')) {
            $param['month'] = $this->input->getPost('bulan');
        } else {
            $param['month'] = '00';
        }

        // grafik peminjaman
        $data = $this->m->getGrafikPeminjaman($param);
        $grafikPeminjaman = $data['dataPeminjaman'];
        $finalGrafikPeminjaman = [];
        $finalTotalGrafikPeminjaman = [];
        foreach ($grafikPeminjaman as $key => $value) {
            if (count($value) > 1) {
                $jumlah = [];
                foreach ($value as $k => $val) {
                    if ($val) {
                        $jumlah[] = $val['jumlah'];
                    }
                }
                $finalTotalGrafikPeminjaman[$key] = \array_sum($jumlah);
            } else {
                $finalTotalGrafikPeminjaman[$key] = 0;
            }
        }
        $this->data['jumlah'] = $finalTotalGrafikPeminjaman;
        $this->data['labels'] = $data['labels'];
        $this->lib_sys->view_modal('dashboard/grafik', $this->data);
    }
}
