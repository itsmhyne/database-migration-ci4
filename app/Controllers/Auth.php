<?php

namespace App\Controllers;

use App\Models\M_auth;

class Auth extends BaseController
{

	private $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
	}

	public function login()
	{
		if ($this->session->get('is_logged_in')) {
			return \redirect()->to(\base_url() . '/Dashboard');
		} else {
			return view('auth/login');
		}
	}

	public function check_login()
	{
		$m_auth = new M_auth();
		$userdata = $m_auth->check_login($_POST);
		if ($userdata[0] == 1) {
			$m_auth->set_userdata($userdata[1]);
			return redirect()->to(base_url() . '/Dashboard');
		} else if ($userdata[0] == 2) {
			$this->session->setFlashdata('code', '2');
			return redirect()->back()->withInput();
		} else {
			$this->session->setFlashdata('code', '3');
			return redirect()->to(base_url());
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect()->to(base_url());
	}

	public function register()
	{
		return view('auth/register');
	}

	//--------------------------------------------------------------------

}
