<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useradmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//load library session
		$this->load->library('session');
		//load model UserModel
		$this->load->model('UserModel');
		//autentikasi role user
		$role = $this->session->userdata('role') ?? null;
		if(in_array($role, ['0', '1'])) {
			if($role == '1') {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>User Not Authorized</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>');
				redirect('pelelang/baranglelangku');
				
			} 
		} else {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>User Not Authenticated</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>');
			redirect('login');
		}
	}

	public function index()
	{
		//ambil input nama
		$keyword = $this->input->get('nama');
		//ambil data barang masuk dari database melalui UserModel function findAllAdmin
		$data['admin'] = $this->UserModel->findAllAdmin($keyword) -> result();
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');
		// load view page
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/useradmin/v_index', $data);
		$this->load->view('admin/layout/footer');
	}

	public function create()
	{
		//ambil input form
		$username = $this->input->post('username');
		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		//tampung ke dalam array
		$data = array(
			'username' => $username,
			'password' => $password,
			'role' => "0",
			'status' => "1"
		);
		//panggil function create di UserModel
		$this->UserModel->create($data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>User Berhasil Dibuat!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman user_admin
		redirect('admin/useradmin');
	}

	public function delete($id)
	{
		//ambil id dari url
		$where = [
			'id' => $id
		];
		//panggil function delete di UserModel
		$this->UserModel->delete($where);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Data User Berhasil Dihapus!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman user_admin
		redirect('admin/useradmin');
	}

	public function edit($id) {
		//ambil input form
		$username = $this->input->post('username');
		if($this->input->post('password')) {
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
		//tampung ke dalam array
		$where = array(
			'id' => $id
		);
		if($this->input->post('password')) {
			//tampung ke dalam array
			$data = array(
				'username' => $username,
				'password' => $password,
			);
		} else {
			//tampung ke dalam array
			$data = array(
				'username' => $username,
			);
		}
		//panggil function edit di UserModel
		$this->UserModel->edit($where,$data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>User Berhasil Diedit!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman user_admin
		redirect('admin/useradmin');
	}
}
