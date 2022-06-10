<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class _sys_group extends Seeder
{
    public function run()
    {
        // membuat data
        $news_data = [
            [
                'group_nama' => 'Administrator'
            ],
            [
                'group_nama' => 'Member'
            ],
        ];

        foreach ($news_data as $data) {
            // insert semua data ke tabel
            $this->db->table('_sys_group')->insert($data);
        }
    }
}
