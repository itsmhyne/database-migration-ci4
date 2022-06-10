<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class M_peminjaman extends BaseModel
{

    function room_pinjam($room_id, $no_peminjaman)
    {
        $user_id = $this->session->get('user_id');

        // insert data ke table peminjaman
        $tabelPeminjaman = $this->db->table('peminjaman');
        $dataPeminjam = $this->setCrudIdentity('insert', [
            'peminjaman_nomor' => $no_peminjaman,
            'ruangan_id' => $room_id,
            'user_id' => $user_id
        ]);
        $tabelPeminjaman->set($dataPeminjam)
            ->insert();

        // update status ruangan
        $tabelRuangan = $this->db->table('ruangan');
        $dataRuangan = $this->setCrudIdentity('insert', [
            'ruangan_status' => 2 //2 adalah status jika ruangan sedang dipinjam, 1 jika tersedia
        ]);
        $tabelRuangan->set($dataRuangan)
            ->where('ruangan_id', $room_id)
            ->update();

        // notifikasi 
        $this->resp_S('Ruangan berhasil dipinjam');
    }
}
