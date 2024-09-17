<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangLelang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//load model BarangModel
		$this->load->model('BarangModel');
		$this->load->model('LelangModel');
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
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');
		//barang lelang
		$keyword = $this->input->get('nama');
		$data['barang'] = $this->BarangModel->findAllAuctionItem($keyword) -> result();
		//load view page
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/baranglelang/v_index', $data);
		$this->load->view('admin/layout/footer');
	}

	public function delete($id)
	{
		//ambil id dari url
		$where = [
			'id' => $id
		];
		//panggil function delete di UserModel
		$this->BarangModel->delete($where);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Data Barang Berhasil Dihapus!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman barang
		redirect('admin/baranglelang/');
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

		//get $data['auction'] where status = 1 and store it in $auction_id
		$auction_id = null;
		foreach ($data['auction'] as $auction) {
			if ($auction->status == '1') {
				$auction_id = $auction->id;
			}
		}
		$payment = null;
		if($auction_id) {
			$payment = $this->LelangModel->findAuctionPayment($auction_id);
		}
		$data['payment'] = $payment;
		
		// load view page
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/baranglelang/v_detail', $data);
		$this->load->view('admin/layout/footer');

	}


}
