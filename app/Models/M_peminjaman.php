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
        $dataPeminjam = $this->setCrudIdentity('update', [
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

    function getPrintRekap()
    {
        $user_id = $this->session->get('user_id');
        $data['peminjaman'] = $this->db->table('peminjaman as p')
            ->select('peminjaman_nomor, ruangan_nama, p.created_time, komunitas_nama, peminjaman_status')
            ->join('ruangan as r', 'r.ruangan_id = p.ruangan_id')
            ->join('komunitas as k', 'k.komunitas_id = p.komunitas_id')
            ->where('p.komunitas_id', $user_id)
            ->orderBy('peminjaman_status', 'asc')
            ->get()
            ->getResultArray();

        return $data;
    }

    function ajukan_peminjaman()
    {

        $ruangan_id = $this->input->getPost('id');
        $user_id = $this->session->get('user_id');

        // cek pakah user sudah mengajukan peminjaman
        $checkPeminjaman = $this->db->table('pengajuan')
            ->where('ruangan_id', $ruangan_id)
            ->where('komunitas_id', $user_id)
            ->where('status', 1)
            ->get()
            ->getRow();

        // jika sudah mengajukan
        if ($checkPeminjaman) {
            $this->resp_E('Anda sudah mengajukan peminjaman ruangan ini. Mohon tunggu konfirmasi dari admin');
        } else {

            // insert ke table pengajuan
            $tabelPengajuan = $this->db->table('pengajuan');
            $dataPengajuan = $this->setCrudIdentity('insert', [
                'ruangan_id' => $ruangan_id,
                'komunitas_id' => $user_id
            ]);
            $tabelPengajuan->set($dataPengajuan)
                ->insert();

            // send notofikasi
            $this->resp_S('Pengajuan peminjaman ruangan berhasil. Mohon tunggu konfirmasi dari Admin');
        }
    }
}
