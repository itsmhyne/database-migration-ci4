<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;
use \Config\Services;

class BaseModel extends Model
{

    protected $input;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->input = Services::request();
        $this->session = \Config\Services::session();
        helper(['date', 'str']);
    }

    protected function setCrudIdentity($mode = 'insert', $data = [], $status = '1')
    {
        $setData = [];
        switch ($mode) {
            case 'insert':
                $setData = [
                    'created_by' => $this->session->get('user_id'),
                    'created_time' => date('Y-m-d H:i:s'),
                    'status' => $status
                ];
                break;

            case 'update':
                $setData = [
                    'updated_by' => $this->session->get('user_id'),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'status' => $status
                ];
                break;

            case 'delete':
                $setData = [
                    'updated_by' => $this->session->get('user_id'),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'status' => '0'
                ];
                break;
        }

        return array_merge($setData, $data);
    }

    protected function resp_E($msg, $data = [])
    {
        header("Content-type: application/json; charset=utf-8");
        $setResp = ['status' => 2, 'msg' => $msg];
        $setResp = array_merge($setResp, $data);
        echo json_encode($setResp, JSON_PRETTY_PRINT);
        die();
    }

    protected function resp_S($msg, $data = [])
    {
        header("Content-type: application/json; charset=utf-8");
        $setResp = ['status' => 1, 'msg' => $msg];
        $setResp = array_merge($setResp, $data);
        echo json_encode($setResp, JSON_PRETTY_PRINT);
        die();
    }

    protected function setCrudIdentityApi($mode = 'insert', $data = [], $status = '1')
    {
        $setData = [];
        switch ($mode) {
            case 'insert':
                $setData = [
                    'created_by' => $this->input->getPost('user_id'),
                    'created_time' => date('Y-m-d H:i:s'),
                    'status' => $status
                ];
                break;

            case 'update':
                $setData = [
                    'updated_by' => $this->input->getPost('user_id'),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'status' => $status
                ];
                break;

            case 'delete':
                $setData = [
                    'updated_by' => $this->input->getPost('user_id'),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'status' => '0'
                ];
                break;
        }

        return array_merge($setData, $data);
    }
}
