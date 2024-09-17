<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('UserModel');
		
	}

	public function index()
	{
		//autentikasi role user
		$role = $this->session->userdata('role') ?? null;
		if(in_array($role, ['0', '1'])) {
			if($role == '0') {
				redirect('admin/useradmin');
			} else {
				redirect('pelelang/baranglelangku');
			}
		}
		$this->load->view('v_login');
	}

	public function auth()
	{
		//autentikasi role user
		$role = $this->session->userdata('role') ?? null;
		if(in_array($role, ['0', '1'])) {
			if($role == '0') {
				redirect('admin/useradmin');
			} else {
				redirect('pelelang/baranglelangku');
			}
		}
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		list($check,$id,$username,$role) = $this->UserModel->auth($username, $password);

		if($check) {
			$this->session->set_userdata('id', $id);
			$this->session->set_userdata('username', $username);
			$this->session->set_userdata('role', $role);
			// echo $role;
			if($role == '0') {
				redirect('admin/useradmin');
			} else {
				redirect('pelelang/baranglelangku');
			}
		} else {
			$this->session->set_flashdata('pesan',' <div class="alert alert-danger alert-dismissible fade
			show" role="alert">
					<strong>Gagal Login!</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>');

			redirect('login');
		}





	}

	public function logout(){

		$this->session->sess_destroy();

		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
			show" role="alert">
					<strong>Sukses Logout!</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>');
		redirect('');
	}
}
