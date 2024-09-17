<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class RiwayatLelang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//load model BarangModel
		$this->load->model('BarangModel');
		$this->load->model('LelangModel');
		$this->load->model('KategoriModel');
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
		//barang lelang
		$keyword = $this->input->get('nama');
		$category_id = $this->input->get('category_id');
		$data['auction'] = $this->LelangModel->findAuctionByUserID($data['id'], $keyword, $category_id) -> result();
		$data['kategori'] = $this->KategoriModel->findAll() -> result();
		$data['category_id'] = $category_id;
		$data['keyword'] = $keyword;
		//load view page
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/riwayatlelang/v_index', $data);
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

	public function konfirmasi($auction_id) {
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		//check if already confirmed
		$check = $this->LelangModel->findAuctionPayment($auction_id);
		
		if($check) {
			$data['payment'] = $check;
			$data['auction_item'] = $this->LelangModel->findAuctionByID($auction_id);
			$data['kandidat'] = $this->UserModel->findAuctioneerByID($data['id']);
			$this->load->view('pelelang/layout/header');
			$this->load->view('pelelang/layout/sidebar', $data);
			$this->load->view('pelelang/riwayatlelang/v_detail', $data);
			$this->load->view('pelelang/layout/footer');
		} else {
			$data['auction_item'] = $this->LelangModel->findAuctionByID($auction_id);
			$data['kandidat'] = $this->UserModel->findAuctioneerByID($data['id']);
			$this->load->view('pelelang/layout/header');
			$this->load->view('pelelang/layout/sidebar', $data);
			$this->load->view('pelelang/riwayatlelang/v_form', $data);
			$this->load->view('pelelang/layout/footer');
		}
	}

	public function edit_konfirmasi($auction_id) {
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		//check if already confirmed
		$data['payment'] = $this->LelangModel->findAuctionPayment($auction_id);
		$data['auction_item'] = $this->LelangModel->findAuctionByID($auction_id);
		$data['kandidat'] = $this->UserModel->findAuctioneerByID($data['id']);
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/riwayatlelang/v_edit_form', $data);
		$this->load->view('pelelang/layout/footer');
	}

	public function edit_konfirmasi_post($auction_id) {
		
		if(empty($_FILES['proof_payment']['name'])){
			$data = array(
				'auction_id' => $auction_id,
				'recipient_name' => $this->input->post('recipient_name'),
				'recipient_address' => $this->input->post('recipient_address'),
			);
			
		} else {
			$proof_payment = $_FILES['proof_payment']['name'];
			$config['upload_path'] = './assets/proof_payments';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$this->load->library('upload',$config);

			if(!$this->upload->do_upload('proof_payment')){
				echo "Photo Gagal Diupload!";
			}else{
				$proof_payment=$this->upload->data('file_name');
			}

			$data = array(
				'auction_id' => $auction_id,
				'recipient_name' => $this->input->post('recipient_name'),
				'recipient_address' => $this->input->post('recipient_address'),
				'proof_payment' => $proof_payment,
			);
		}
		
		$where = [
			'auction_id' => $auction_id
		];
		$this->LelangModel->editAuctionPayment($where, $data);

		redirect('pelelang/riwayatlelang/konfirmasi/'.$auction_id);
	}

	public function konfirmasi_post($auction_id) {
		$proof_payment = $_FILES['proof_payment']['name'];
		$config['upload_path'] = './assets/proof_payments';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('proof_payment')){
			echo "Photo Gagal Diupload!";
		}else{
			$proof_payment=$this->upload->data('file_name');
		}

		$data = array(
			'auction_id' => $auction_id,
			'recipient_name' => $this->input->post('recipient_name'),
			'recipient_address' => $this->input->post('recipient_address'),
			'proof_payment' => $proof_payment,
		);

		$this->LelangModel->createAuctionPayment($data);

		redirect('pelelang/riwayatlelang/konfirmasi/'.$auction_id);
	}


}
