<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//load library session
		$this->load->library('session');
		//load model KategoriModel
		$this->load->model('KategoriModel');
		//autentikasi role user
		$role = $this->session->userdata('role') ?? null;
		if(in_array($role, ['0', '1'])) {
			if($role == '1') {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Kategori Not Authorized</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>');
				redirect('kategori/baranglelangku');
				
			} 
		} else {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Kategori Not Authenticated</strong>
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
		//ambil data barang masuk dari database melalui KategoriModel function findAllAdmin
		$data['kategori'] = $this->KategoriModel->findAll($keyword) -> result();
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');
		// load view page
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/kategori/v_index', $data);
		$this->load->view('admin/layout/footer');
	}

	public function create()
	{
		//ambil input form
		$name = $this->input->post('name');
		//tampung ke dalam array
		$data = array(
			'name' => $name,
		);
		//panggil function create di KategoriModel
		$this->KategoriModel->create($data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Kategori Berhasil Dibuat!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman kategori
		redirect('admin/kategori');
	}

	public function delete($id)
	{
		//ambil id dari url
		$where = [
			'id' => $id
		];
		//check if kategori is used
		$check = $this->KategoriModel->checkAuctionItems($id);
		if($check->num_rows() > 0) {
			$this->session->set_flashdata('pesan',' <div class="alert alert-danger alert-dismissible fade
			show" role="alert">
					<strong>Kategori Tidak Dapat Dihapus Karena Digunakan Oleh Barang Lelang!</strong>
					<button type="button" class="close"
							data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>');
			redirect('admin/kategori');
		}
		//panggil function delete di KategoriModel
		$this->KategoriModel->delete($where);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Data Pelelang Berhasil Dihapus!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman kategori
		redirect('admin/kategori');
	}

	public function edit($id) {
		//ambil input form
		$name = $this->input->post('name');
		
		//tampung ke dalam array
		$where = array(
			'id' => $id
		);
	
		//tampung ke dalam array
		$data = array(
			'name' => $name,
		);
		//panggil function edit di KategoriModel
		$this->KategoriModel->edit($where,$data);
		
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Kategori Berhasil Diedit!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman kategori
		redirect('admin/kategori');
	}
}
