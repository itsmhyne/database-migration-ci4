<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class M_datamaster extends BaseModel
{

    function room_save()
    {
        $ruangan_nama = $this->input->getPost('ruangan_nama');
        $ruangan_id = $this->input->getPost('ruangan_id');

        // insert
        $setTb = $this->db->table('ruangan');
        if (!$ruangan_id) {
            $data = $this->setCrudIdentity('insert', [
                'ruangan_nama' => $ruangan_nama
            ]);
            $setTb->set($data)
                ->insert();
            $this->resp_S('Data berhasil disimpan!');
        } //update
        else {
            $data = $this->setCrudIdentity('insert', [
                'ruangan_nama' => $ruangan_nama
            ]);
            $setTb->set($data)
                ->where('ruangan_id', $ruangan_id)
                ->update();
            $this->resp_S('Data berhasil diubah!');
        }
    }

    function room_delete($id)
    {
        // update status menjadi 0 agar tidak tampil dalam tabel
        $setData = $this->setCrudIdentity('delete');
        $this->db->table('ruangan')
            ->where('ruangan_id', $id)
            ->set($setData)
            ->update();

        $this->resp_S('Data berhasil dihapus');
    }

    function nonaktifkan_komunitas()
    {
        // cek pakah password benar
        $password = \md5($this->input->getPost('password'));
        $user_id = $this->session->get('user_id');
        $komunitas_id = $this->input->getPost('komunitas_id');
        $db = $this->db->table('_sys_user')
            ->select('user_name, user_id, user_group_id, user_foto')
            ->where('user_id', $user_id)
            ->where("password", $password)
            ->get()->getRow();
        if ($db) {
            // update status komunitas
            $setDataDelete = $this->setCrudIdentity('delete');
            $data = $this->db->table('komunitas')
                ->where('komunitas_id', $komunitas_id)
                ->set($setDataDelete)
                ->update();
            // notifikasi 
            $this->resp_S('Komunitas berhasil dinonaktifkan');
        } else {
            $this->resp_E('Password Anda Salah');
        }
    }
}
