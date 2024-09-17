<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('UserModel');
		//autentikasi role user
		$role = $this->session->userdata('role') ?? null;
		if(in_array($role, ['0', '1'])) {
			if($role == '0') {
				redirect('admin/useradmin');
			} else {
				redirect('pelelang/baranglelangku');
			}
		}
	}

	public function index()
	{
		$this->load->view('v_register');
	}

	//post register to insert
	public function post()
	{
		//ambil input form
		$username = $this->input->post('username');
		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		//tampung ke dalam array
		$data = array(
			'username' => $username,
			'password' => $password,
			'role' => "1",
			'status' => "0"
		);
		//panggil function create di UserModel
		$user_id = $this->UserModel->create($data);
		//tampung ke dalam array
		$data = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'user_id' => $user_id,
			'register_date' => date('Y-m-d'),
			'account_name' => $this->input->post('account_name'),
			'account_number' => $this->input->post('account_number'),
			'bank_name' => $this->input->post('bank_name'),
		);
		//panggil function createProfil di UserModel
		$this->UserModel->createProfil($data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>User Berhasil Dibuat! Silakan Tunggu Admin untuk Verifikasi!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman pelelang
		redirect('login');
	}

}
