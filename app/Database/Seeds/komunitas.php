<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class komunitas extends Seeder
{
    public function run()
    {
        // membuat data
        $news_data = [
            [
                'komunitas_logo' => 'default.jpg',
                'komunitas_nama'  => 'Genpi Blitar',
                'bidang' => 'Pariwisata',
                'jml_anggota' => '20',
                'ketua' => 'Nino',
                'kontak' => '086251427182',
                'username' => 'genpi',
                'password' => \md5('password'),
                'user_group_id' => '2', //default member
            ],
            [
                'komunitas_logo' => 'default.jpg',
                'komunitas_nama'  => 'PENA',
                'bidang' => 'Hobi',
                'jml_anggota' => '12',
                'ketua' => 'Nana',
                'kontak' => '087635241728',
                'username' => 'pena',
                'password' => \md5('password'),
                'user_group_id' => '2', //default member
            ]
        ];

        foreach ($news_data as $data) {
            // insert semua data ke tabel
            $this->db->table('komunitas')->insert($data);
        }
    }
}
