<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Dummy extends Seeder
{
    public function run()
    {
        // seeder ruangan

        $ruanganData = [
            [
                'ruangan_nama' => 'Ruangan #1',
                'ruangan_status' => 1
            ],
            [
                'ruangan_nama' => 'Ruangan #2',
                'ruangan_status' => 1
            ],
            [
                'ruangan_nama' => 'Ruangan #3',
                'ruangan_status' => 1
            ],
            [
                'ruangan_nama' => 'Ruangan #4',
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
                'komunitas_logo' => 'default_user.jpg',
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
                'komunitas_logo' => 'default_user.jpg',
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
                'user_foto' => 'default_admin.png',
                'user_phone'  => '087624132412',
                'email' => 'jhondoe@gmail.com',
                'user_address' => 'address example',
                'username' => 'admin',
                'password' => \md5('password'),
                'user_group_id' => '1',
            ],
            [
                'user_name' => 'Dighoff Rosy',
                'user_foto' => 'default_admin.png',
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

        // seeder bulan

        $bulanData = [
            [
                'bulan_kode' => '01',
                'bulan_nama' => 'Januari'
            ],
            [
                'bulan_kode' => '02',
                'bulan_nama' => 'Februari'
            ],
            [
                'bulan_kode' => '03',
                'bulan_nama' => 'Maret'
            ],
            [
                'bulan_kode' => '04',
                'bulan_nama' => 'April'
            ],
            [
                'bulan_kode' => '05',
                'bulan_nama' => 'Mei'
            ],
            [
                'bulan_kode' => '06',
                'bulan_nama' => 'Juni'
            ],
            [
                'bulan_kode' => '07',
                'bulan_nama' => 'Juli'
            ],
            [
                'bulan_kode' => '08',
                'bulan_nama' => 'Agustus'
            ],
            [
                'bulan_kode' => '09',
                'bulan_nama' => 'September'
            ],
            [
                'bulan_kode' => '10',
                'bulan_nama' => 'Oktober'
            ],
            [
                'bulan_kode' => '11',
                'bulan_nama' => 'November'
            ],
            [
                'bulan_kode' => '12',
                'bulan_nama' => 'Desember'
            ],
        ];

        foreach ($bulanData as $data) {
            // insert semua data ke tabel
            $this->db->table('bulan')->insert($data);
        }
    }
}
