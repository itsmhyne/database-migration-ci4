<?php

namespace App\Controllers;

use App\Models\M_profile;
use Config\Database;

class Profile extends BaseController
{

    private $m;

    public function __construct()
    {
        $this->m = new M_profile();
        $this->db = Database::connect();
        ini_set("memory_limit", "100000M");
        ini_set("max_input_vars ", "3000");
    }

    public function admin()
    {
        $data['menu'] = 'Profile Saya';
        $data['user'] = $this->m->getProfile();
        $this->lib_sys->view('profile/admin', $data);
    }

    public function updateAdmin()
    {
        $this->m->updateAdmin();
    }
}
