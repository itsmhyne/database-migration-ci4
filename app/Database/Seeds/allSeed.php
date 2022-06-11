<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class allSeed extends Seeder
{
    public function run()
    {
        // seeder ruangan

        $ruanganData = [
            [
                'ruangan_nama' => 'Ruamgan #1',
                'ruangan_status' => 1
            ],
            [
                'ruangan_nama' => 'Ruamgan #2',
                'ruangan_status' => 1
            ],
            [
                'ruangan_nama' => 'Ruamgan #3',
                'ruangan_status' => 1
            ],
            [
                'ruangan_nama' => 'Ruamgan #4',
                'ruangan_status' => 1
            ],
        ];

        foreach ($ruanganData as $data) {
            // insert semua data ke tabel
            $this->db->table('ruangan')->insert($data);
        }

        // seeder status

        $statusData = [
            [
                'status_nama' => 'Aktif'
            ],
            [
                'status_nama' => 'Hapus'
            ]
        ];

        foreach ($statusData as $data) {
            // insert semua data ke tabel
            $this->db->table('_sys_status')->insert($data);
        }

        // seeder komunitas

        $dataKomunitas = [
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

        foreach ($dataKomunitas as $data) {
            // insert semua data ke tabel
            $this->db->table('komunitas')->insert($data);
        }

        // seeder user

        $dataUser = [
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

        foreach ($dataUser as $data) {
            // insert semua data ke tabel
            $this->db->table('_sys_user')->insert($data);
        }

        // seeder group

        $groupData = [
            [
                'group_nama' => 'Administrator'
            ],
            [
                'group_nama' => 'Member'
            ],
        ];

        foreach ($groupData as $data) {
            // insert semua data ke tabel
            $this->db->table('_sys_group')->insert($data);
        }
    }
}
