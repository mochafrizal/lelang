<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('UserModel');

		//autentikasi role user
		$role = $this->session->userdata('role') ?? null;
		if(in_array($role, ['0', '1'])) {
			if($role == '0') {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>User Not Authorized</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>');
				redirect('admin/useradmin');
				
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
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		//panggil function findAuctioneerByID di UserModel
		$data['pelelang'] = $this->UserModel->findAuctioneerByID($data['id']);
		//load view page
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/profile/v_index', $data);
		$this->load->view('pelelang/layout/footer');
	}

	public function edit()
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		$username = $this->input->post('username');
		if($this->input->post('password')) {
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}

		//tampung ke dalam array
		$where = array(
			'id' =>$data['id']
		);
		if($this->input->post('password')) {
			//tampung ke dalam array
			$data_user = array(
				'username' => $username,
				'password' => $password,
			);
		} else {
			//tampung ke dalam array
			$data_user = array(
				'username' => $username,
			);
		}

		//panggil function edit di UserModel
		$this->UserModel->edit($where, $data_user);
		$where = array(
			'user_id' => $data['id']
		);
		
		//tampung ke dalam array
		$data_profile = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'account_name' => $this->input->post('account_name'),
			'account_number' => $this->input->post('account_number'),
			'bank_name' => $this->input->post('bank_name'),
		);
		//panggil function editProfil di UserModel
		$this->UserModel->editProfiles($where,$data_profile);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
			show" role="alert">
					<strong>Profile Berhasil Diupdate!</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>');

		redirect('pelelang/profile');
	}
}
