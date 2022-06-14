<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class M_auth extends BaseModel
{

    // public function __construct()
    // {
    //     $this->db = Database::connect();
    // }

    function check_login($data)
    {
        // cek username dan email
        $data['password'] = md5($data['password']);
        $db = $this->db->table('_sys_user')
            ->select('user_name, user_id, user_group_id, user_foto')
            ->groupStart()
            ->where('username', $data['email'])
            ->orWhere('email', $data['email'])
            ->groupEnd()
            ->where("password", $data['password'])
            ->where('status', '1')
            ->get()->getRow();

        $checkKomunitas = $this->db->table('komunitas')
            ->select('komunitas_nama as user_name, komunitas_id as user_id, user_group_id, komunitas_logo as user_foto')
            ->where('username', $data['email'])
            ->where('password', $data['password'])
            ->where('status', '1')
            ->get()
            ->getRow();

        if ($db) {
            return [1, $db];
        } else if ($checkKomunitas) {
            return [1, $checkKomunitas];
        } else {
            $checkUserMail = $this->db->table('_sys_user')
                ->select('user_name, user_id, user_group_id')
                ->where('username', $data['email'])
                ->orWhere('email', $data['email'])
                ->get()->getRow();
            if ($checkUserMail) {
                return [2];
            } else {
                return [3];
            }
        }
    }

    function set_userdata($data)
    {
        $session = \Config\Services::session();

        $array = array(
            'name' => $data->user_name,
            'user_id' => $data->user_id,
            'group_id' => $data->user_group_id,
            'is_logged_in' => true,
            'user_foto' => $data->user_foto
        );

        $session->set($array);
    }

    function registerMember($data)
    {
        // cek apakah username sudah terdaftar
        $checkUsername = $this->db->table('komunitas')
            ->where('username', $data['username'])
            ->get()
            ->getRow();

        if (!$checkUsername) {
            // cek apakah password sama
            if ($data['password'] == $data['password_confirmation']) {
                // insert data ke table peminjaman
                $tabelKomunitas = $this->db->table('komunitas');
                $dataMember =  [
                    'komunitas_logo' => 'default.jpg',
                    'komunitas_nama' => $data['komunitas_nama'],
                    'username' => $data['username'],
                    'password' => \md5($data['password']),
                    'created_time' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'status' => 1
                ];
                $tabelKomunitas->set($dataMember)
                    ->insert();
                return [1];
            } else {
                return [3];
            }
        } else {
            return [2];
        }
    }
}
