<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class _sys_user extends Seeder
{
    public function run()
    {
        // membuat data
        $news_data = [
            [
                'user_name' => 'John Doe',
                'user_phone'  => '087624132412',
                'email' => 'jhondoe@gmail.com',
                'user_address' => 'address example',
                'username' => 'admin',
                'password' => \md5('password'),
                'user_group_id' => '1',
            ],
            [
                'user_name' => 'Dighoff Rosy',
                'user_phone'  => '087624132412',
                'email' => 'dighoffr@gmail.com',
                'user_address' => 'address example',
                'username' => 'dighoff',
                'password' => \md5('password'),
                'user_group_id' => '1',
            ],
        ];

        foreach ($news_data as $data) {
            // insert semua data ke tabel
            $this->db->table('_sys_user')->insert($data);
        }
    }
}
