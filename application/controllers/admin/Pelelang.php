<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelelang extends CI_Controller {

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
		$data['pelelang'] = $this->UserModel->findAllAuctioneer($keyword) -> result();
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');
		// load view page
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/pelelang/v_index', $data);
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
			'role' => "1",
			'status' => "1"
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
				<strong>User Berhasil Dibuat!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman pelelang
		redirect('admin/pelelang');
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
				<strong>Data Pelelang Berhasil Dihapus!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman pelelang
		redirect('admin/pelelang');
	}

	public function change_status($id)
	{
		//panggil function changeStatus di UserModel
		$this->UserModel->changeStatus($id);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Data User Berhasil Diubah!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman pelelang
		redirect('admin/pelelang');
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
		$where = array(
			'user_id' => $id
		);
		//tampung ke dalam array
		$data = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'account_name' => $this->input->post('account_name'),
			'account_number' => $this->input->post('account_number'),
			'bank_name' => $this->input->post('bank_name'),
		);
		//panggil function editProfil di UserModel
		$this->UserModel->editProfiles($where,$data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>User Berhasil Diedit!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman pelelang
		redirect('admin/pelelang');
	}

	public function detail($id) {
		//panggil function findAuctioneerByID di UserModel
		$data['pelelang'] = $this->UserModel->findAuctioneerByID($id);
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');
		// load view page
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/pelelang/v_detail', $data);
		$this->load->view('admin/layout/footer');

	}
}
