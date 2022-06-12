<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class M_pengajuan extends BaseModel
{

    function konfirmasi_pengajuan($no_peminjaman)
    {
        $ruangan_id = $this->input->getPost('id');
        $user_id = $this->input->getPost('user');

        // insert data ke table peminjaman
        $tabelPeminjaman = $this->db->table('peminjaman');
        $dataPeminjam = $this->setCrudIdentity('insert', [
            'peminjaman_nomor' => $no_peminjaman,
            'ruangan_id' => $ruangan_id,
            'komunitas_id' => $user_id
        ]);
        $tabelPeminjaman->set($dataPeminjam)
            ->insert();

        // update status ruangan
        $tabelRuangan = $this->db->table('ruangan');
        $dataRuangan = $this->setCrudIdentity('update', [
            'ruangan_status' => 2 //2 adalah status jika ruangan sedang dipinjam, 1 jika tersedia
        ]);
        $tabelRuangan->set($dataRuangan)
            ->where('ruangan_id', $ruangan_id)
            ->update();

        // hapus pengajuan untuk ruangan yang sudah dikonfirmasi;
        $setDataDelete = $this->setCrudIdentity('delete');
        $data = $this->db->table('pengajuan')
            ->where('ruangan_id', $ruangan_id)
            ->set($setDataDelete)
            ->update();

        $this->resp_S('Konfirmasi Pengajuan Ruangan Berhasil');
    }
}
