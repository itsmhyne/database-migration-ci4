<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class M_profile extends BaseModel
{

    function getProfile()
    {
        $user_id = $this->session->get('user_id');
        $user = $this->db->table('_sys_user')
            ->where('user_id', $user_id)
            ->get()
            ->getRow();
        return $user;
    }

    function getKomunitas()
    {
        $user_id = $this->session->get('user_id');
        $user = $this->db->table('komunitas')
            ->where('komunitas_id', $user_id)
            ->get()
            ->getRow();
        return $user;
    }

    function updateAdmin()
    {
        $user_name = $this->input->getPost('user_name');
        $user_foto = $this->input->getFile('user_foto');
        $user_phone = $this->input->getPost('user_phone');
        $email = $this->input->getPost('email');
        $user_address = $this->input->getPost('user_address');
        $password = $this->input->getPost('password');
        $password_konfirmasi = $this->input->getPost('password_konfirmasi');

        $user_id = $this->session->get('user_id');

        $tbUser = $this->db->table('_sys_user');
        // check jika ubah password
        if ($password) {
            // check pakah password konfirmasi == password
            if ($password != $password_konfirmasi) {
                $this->resp_E('Password tidak sesuai, mohon periksa kembali');
            } else {
                // ambil nama gambar sesuai id
                $gambar_name = $this->db->table('_sys_user')
                    ->select('user_foto')
                    ->where('user_id', $user_id)
                    ->get()->getRow('user_foto');
                $gambar = $gambar_name;
                // check apakah upload gambar
                if ($_FILES['user_foto']['name'] == '') {
                    $setData = $this->setCrudIdentity('update', [
                        'user_name' => $user_name,
                        'user_phone' => $user_phone,
                        'email' => $email,
                        'user_address' => $user_address,
                        'password' => md5($password),
                    ]);
                } else {
                    if ($gambar != 'default_admin.png') {
                        @unlink("public/assets/dist/img/user/") . $gambar;
                    }
                    $namaFoto = $user_foto->getRandomName();
                    $user_foto->move(WRITEPATH . '../public/assets/dist/img/user/', $namaFoto);
                    $setData = $this->setCrudIdentity('update', [
                        'user_name' => $user_name,
                        'user_phone' => $user_phone,
                        'email' => $email,
                        'user_address' => $user_address,
                        'password' => md5($password),
                        'user_foto' => $namaFoto
                    ]);
                }
                $tbUser->set($setData)
                    ->where('user_id', $user_id)
                    ->update();
                $this->resp_S('Profile Berhasil Diperbarui');
            }
        } else {
            // ambil nama gambar sesuai id
            $gambar_name = $this->db->table('_sys_user')
                ->select('user_foto')
                ->where('user_id', $user_id)
                ->get()->getRow('user_foto');
            $gambar = $gambar_name;
            // check apakah upload gambar
            if ($_FILES['user_foto']['name'] == '') {
                $setData = $this->setCrudIdentity('update', [
                    'user_name' => $user_name,
                    'user_phone' => $user_phone,
                    'email' => $email,
                    'user_address' => $user_address
                ]);
            } else {
                if ($gambar != 'default_admin.png') {
                    @unlink("public/assets/dist/img/user/") . $gambar;
                }
                $namaFoto = $user_foto->getRandomName();
                $user_foto->move(WRITEPATH . '../public/assets/dist/img/user/', $namaFoto);
                $setData = $this->setCrudIdentity('update', [
                    'user_name' => $user_name,
                    'user_phone' => $user_phone,
                    'email' => $email,
                    'user_address' => $user_address,
                    'user_foto' => $namaFoto
                ]);
            }
            $tbUser->set($setData)
                ->where('user_id', $user_id)
                ->update();
            $this->resp_S('Profile Berhasil Diperbarui');
        }
    }

    function updateKomunitas()
    {
        $komunitas_nama = $this->input->getPost('komunitas_nama');
        $komunitas_logo = $this->input->getFile('komunitas_logo');
        $kontak = $this->input->getPost('kontak');
        $bidang = $this->input->getPost('bidang');
        $jml_anggota = $this->input->getPost('jml_anggota');
        $ketua = $this->input->getPost('ketua');
        $username = $this->input->getPost('username');
        $password = $this->input->getPost('password');
        $password_konfirmasi = $this->input->getPost('password_konfirmasi');

        $komunitas_id = $this->session->get('user_id');

        $tbKomunitas = $this->db->table('komunitas');
        // check jika ubah password
        if ($password) {
            // check pakah password konfirmasi == password
            if ($password != $password_konfirmasi) {
                $this->resp_E('Password tidak sesuai, mohon periksa kembali');
            } else {
                // ambil nama gambar sesuai id
                $gambar_name = $this->db->table('komunitas')
                    ->select('komunitas_logo')
                    ->where('komunitas_id', $komunitas_id)
                    ->get()->getRow('komunitas_logo');
                $gambar = $gambar_name;
                // check apakah upload gambar
                if ($_FILES['komunitas_logo']['name'] == '') {
                    $setData = $this->setCrudIdentity('update', [
                        'komunitas_nama' => $komunitas_nama,
                        'bidang' => $bidang,
                        'jml_anggota' => $jml_anggota,
                        'ketua' => $ketua,
                        'kontak' => $kontak,
                        'password' => md5($password)
                    ]);
                } else {
                    if ($gambar != 'default_user.jpg') {
                        @unlink("public/assets/dist/img/user/") . $gambar;
                    }
                    $namaFoto = $komunitas_logo->getRandomName();
                    $komunitas_logo->move(WRITEPATH . '../public/assets/dist/img/user/', $namaFoto);
                    $setData = $this->setCrudIdentity('update', [
                        'komunitas_nama' => $komunitas_nama,
                        'bidang' => $bidang,
                        'jml_anggota' => $jml_anggota,
                        'ketua' => $ketua,
                        'kontak' => $kontak,
                        'komunitas_logo' => $namaFoto,
                        'password' => md5($password)
                    ]);
                }
                $tbKomunitas->set($setData)
                    ->where('komunitas_id', $komunitas_id)
                    ->update();
                $this->resp_S('Profile Berhasil Diperbarui');
            }
        } else {
            // ambil nama gambar sesuai id
            $gambar_name = $this->db->table('komunitas')
                ->select('komunitas_logo')
                ->where('komunitas_id', $komunitas_id)
                ->get()->getRow('komunitas_logo');
            $gambar = $gambar_name;
            // check apakah upload gambar
            if ($_FILES['komunitas_logo']['name'] == '') {
                $setData = $this->setCrudIdentity('update', [
                    'komunitas_nama' => $komunitas_nama,
                    'bidang' => $bidang,
                    'jml_anggota' => $jml_anggota,
                    'ketua' => $ketua,
                    'kontak' => $kontak,
                ]);
            } else {
                if ($gambar != 'default_admin.png') {
                    @unlink("public/assets/dist/img/user/") . $gambar;
                }
                $namaFoto = $komunitas_logo->getRandomName();
                $komunitas_logo->move(WRITEPATH . '../public/assets/dist/img/user/', $namaFoto);
                $setData = $this->setCrudIdentity('update', [
                    'komunitas_nama' => $komunitas_nama,
                    'bidang' => $bidang,
                    'jml_anggota' => $jml_anggota,
                    'ketua' => $ketua,
                    'kontak' => $kontak,
                    'komunitas_logo' => $namaFoto
                ]);
            }
            $tbKomunitas->set($setData)
                ->where('komunitas_id', $komunitas_id)
                ->update();
            $this->resp_S('Profile Berhasil Diperbarui');
        }
    }
}
