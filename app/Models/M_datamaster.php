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
        $eksekusi = $this->db->table('ruangan')
            ->where('ruangan_id', $id)
            ->set($setData)
            ->update();

        $this->resp_S('Data berhasil dihapus');
    }
}
