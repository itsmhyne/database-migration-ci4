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
        $this->lib_sys->view('Dashboard/dashboard', $data);
    }
}
