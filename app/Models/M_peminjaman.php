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
            ->where('ruangan_id', $room_id)
            ->update();

        // notifikasi 
        $this->resp_S('Ruangan berhasil dipinjam');
    }

    function ruangan_dipinjam_dikembalikan($peminjaman_id, $ruangan_id)
    {
        $user_id = $this->session->get('user_id');

        // update data ke table peminjaman
        $tabelPeminjaman = $this->db->table('peminjaman');
        $dataPeminjam = $this->setCrudIdentity('insert', [
            'peminjaman_status' => 2, //dikembalikan
        ]);
        $tabelPeminjaman->set($dataPeminjam)
            ->where('peminjaman_id', $peminjaman_id)
            ->update();

        // update status ruangan
        $tabelRuangan = $this->db->table('ruangan');
        $dataRuangan = $this->setCrudIdentity('update', [
            'ruangan_status' => 1 // status di ubah menjadi tersedia
        ]);
        $tabelRuangan->set($dataRuangan)
            ->where('ruangan_id', $ruangan_id)
            ->update();

        // notifikasi 
        $this->resp_S('Ruangan Berhasil Dikembalikan');
    }

    function getBuktiPeminjaman($peminjaman_id)
    {
        $data['peminjaman'] = $this->db->table('peminjaman as p')
            ->select('peminjaman_nomor, ruangan_nama, p.created_time, komunitas_nama')
            ->join('ruangan as r', 'r.ruangan_id = r.ruangan_id')
            ->join('komunitas as k', 'k.komunitas_id = p.komunitas_id')
            ->get()
            ->getRow();

        return $data;
    }
}
