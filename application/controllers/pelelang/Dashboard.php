<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
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
		//load view page
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/v_dashboard', $data);
		$this->load->view('pelelang/layout/footer');
	}
}
