<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class BarangLelang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//load model BarangModel
		$this->load->model('BarangModel');
		$this->load->model('LelangModel');
		$this->load->model('KategoriModel');
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
		//barang lelang
		$keyword = $this->input->get('nama');
		$category_id = $this->input->get('category_id');
		$data['auction_item'] = $this->BarangModel->findAllAuctionItemActive($keyword, $category_id) -> result();
		$data['kategori'] = $this->KategoriModel->findAll() -> result();
		$data['category_id'] = $category_id;
		$data['keyword'] = $keyword;
		//load view page
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/baranglelang/v_index', $data);
		$this->load->view('pelelang/layout/footer');
	}

	public function detail($id) {
		//panggil function findAuctionItemByID di BarangModel
		$data['auction_item'] = $this->BarangModel->findAuctionItemByID($id);
		$data['auction'] = $this->LelangModel->findAllAuctionByAuctionItemID($id)->result();
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');
		// load view page
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/baranglelang/v_detail', $data);
		$this->load->view('pelelang/layout/footer');

	}

	public function lelang($auction_item_id) {
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		$data = array(
			'user_id' => $data['id'],
			'auction_item_id' => $auction_item_id,
			'price' => str_replace('.', '', $this->input->post('price')),
			'status' => '0',
			'date' => date('Y-m-d H:i:s')
		);

		$this->LelangModel->create($data);

		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Harga Penawaran Berhasil Diinput!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman sebelumnya
		redirect('pelelang/baranglelang/detail/'.$auction_item_id);
	}


}
