<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangLelangku extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//load model BarangModel
		$this->load->model('KategoriModel');
		$this->load->model('BarangModel');
		$this->load->model('LelangModel');
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
		$data['auction_item'] = $this->BarangModel->findAuctionItemByUserID($data['id'], $keyword, $category_id) -> result();
		$data['kategori'] = $this->KategoriModel->findAll() -> result();
		$data['category_id'] = $category_id;
		$data['keyword'] = $keyword;
		//load view page
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/baranglelangku/v_index', $data);
		$this->load->view('pelelang/layout/footer');
	}

	public function create()
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		$photo = $_FILES['photo']['name'];
		$config['upload_path'] = './assets/photos';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('photo')){
			echo "Photo Gagal Diupload!";
		}else{
			$photo=$this->upload->data('file_name');
		}

		$data = array(
			'user_id' => $data['id'],
			'category_id' => $this->input->post('category_id'),
			'code' => $this->input->post('code'),
			'name' => $this->input->post('name'),
			'photo' => $photo,
			'location' => $this->input->post('location'),
			'open_price' => str_replace('.', '', $this->input->post('open_price')),
			'note' => $this->input->post('note'),
			'open_date' => $this->input->post('open_date'),
			'close_date' => $this->input->post('close_date'),
			'status' => $this->input->post('status') ?? '1',
		);

		$this->BarangModel->create($data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Barang Lelang Berhasil Dibuat!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman user_admin
		redirect('pelelang/baranglelangku/');

	}

	public function edit($id)
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		if(empty($_FILES['photo']['name'])){
			$data = array(
				'category_id' => $this->input->post('category_id'),
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'),
				'location' => $this->input->post('location'),
				'open_price' => str_replace('.', '', $this->input->post('open_price')),
				'note' => $this->input->post('note'),
				'open_date' => $this->input->post('open_date'),
				'close_date' => $this->input->post('close_date'),
				'status' => $this->input->post('status') ?? '1',
			);
		} else {
			$photo = $_FILES['photo']['name'];
			$config['upload_path'] = './assets/photos';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$this->load->library('upload',$config);

			if(!$this->upload->do_upload('photo')){
				echo "Photo Gagal Diupload!";
			}else{
				$photo=$this->upload->data('file_name');
			}

			$data = array(
				'user_id' => $data['id'],
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'),
				'photo' => $photo,
				'location' => $this->input->post('location'),
				'open_price' => str_replace('.', '', $this->input->post('open_price')),
				'note' => $this->input->post('note'),
				'open_date' => $this->input->post('open_date'),
				'close_date' => $this->input->post('close_date'),
				'status' => $this->input->post('status'),
			);
		}
		$where = array(
			'id' => $id
		);

		$this->BarangModel->edit($where, $data);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Barang Lelang Berhasil Dibuat!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		//return ke halaman user_admin
		redirect('pelelang/baranglelangku/');

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
		redirect('pelelang/baranglelangku/');
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
		$this->load->view('pelelang/layout/header');
		$this->load->view('pelelang/layout/sidebar', $data);
		$this->load->view('pelelang/baranglelangku/v_detail', $data);
		$this->load->view('pelelang/layout/footer');

	}

	public function pilih($id) {
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['id'] = $this->session->userdata('id');

		$auction_item_id = $this->LelangModel->getAuctionItemID($id);
		$this->LelangModel->choose($id);
		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Kandidat Pelelang Berhasil Dipilih!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		redirect('pelelang/baranglelangku/detail/'.$auction_item_id);

	}

	public function konfirmasi($auction_id) {
		$payment = $this->LelangModel->findAuctionPayment($auction_id);
		$where = [
			'id' => $payment->id
		];

		$data = [
			'status' => $this->input->post('status')
		];

		$this->LelangModel->editAuctionPayment($where, $data);

		$auction_item_id =  $this->BarangModel->findAuctionItemByID($payment->auction_item_id)->id;

		//menampilkan alert success
		$this->session->set_flashdata('pesan',' <div class="alert alert-success alert-dismissible fade
		show" role="alert">
				<strong>Berhasil Verifikasi!</strong>
				<button type="button" class="close"
						data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>');
		redirect('pelelang/baranglelangku/detail/'.$auction_item_id);
	}


}
