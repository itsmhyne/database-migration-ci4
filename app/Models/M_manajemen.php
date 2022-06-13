<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class M_manajemen extends BaseModel
{

    function nonaktifkan_akun()
    {
        // cek pakah password benar
        $password = \md5($this->input->getPost('password'));
        $user_id = $this->session->get('user_id');
        $akun_id = $this->input->getPost('user_id');
        $db = $this->db->table('_sys_user')
            ->select('user_name, user_id, user_group_id, user_foto')
            ->where('user_id', $user_id)
            ->where("password", $password)
            ->get()->getRow();
        if ($db) {
            // update status ruangan
            $setDataDelete = $this->setCrudIdentity('delete');
            $data = $this->db->table('_sys_user')
                ->where('user_id', $akun_id)
                ->set($setDataDelete)
                ->update();
            // notifikasi 
            $this->resp_S($db->user_name . ' berhasil dinonaktifkan');
        } else {
            $this->resp_E('Password Anda Salah');
        }
    }

    function tambah_admin()
    {
        $user_name = $this->input->getPost('user_name');
        $user_phone = $this->input->getPost('user_phone');
        $email = $this->input->getPost('email');
        $user_address = $this->input->getPost('user_address');
        $username = $this->input->getPost('username');
        $password = $this->input->getPost('password');

        // chek apakah username sudah digunakan
        $checkUsername = $this->db->table('_sys_user')
            ->select('user_name, user_id, user_group_id, user_foto')
            ->where('username', $username)
            ->get()->getRow();

        if ($checkUsername) {
            $this->resp_E('Username sudah Digunakan');
        } else {
            // insert ke table pengajuan
            $tabelUser = $this->db->table('_sys_user');
            $dataUser = $this->setCrudIdentity('insert', [
                'user_name' => $user_name,
                'user_phone' => $user_phone,
                'email' => $email,
                'user_address' => $user_address,
                'username' => $username,
                'password' => md5($password),
                'user_group_id' => 1,
            ]);
            $tabelUser->set($dataUser)
                ->insert();
            $this->resp_S('Data Admin Berhasil Ditambahkan!');
        }
    }
}
