<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('UserModel');
		$this->load->model('BarangModel');
		$this->load->model('KategoriModel');
	}

	public function index()
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role') ?? null;
		$data['id'] = $this->session->userdata('id');

		if($data['id']) {
			$data['dashboard_route'] = $data['role'] == '0' ? 'admin/dashboard' : 'pelelang/dashboard';
		}
		$keyword = $this->input->get('nama');
		$category_id = $this->input->get('category_id');
		$data['barang'] = $this->BarangModel->findAllAuctionItemActive($keyword, $category_id) -> result();
		$data['kategori'] = $this->KategoriModel->findAll() -> result();
		$data['category_id'] = $category_id;
		$data['keyword'] = $keyword;

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/v_home', $data);
		$this->load->view('web/layout/footer');
	}

	public function about_us()
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role') ?? null;
		$data['id'] = $this->session->userdata('id');

		if($data['id']) {
			$data['dashboard_route'] = $data['role'] == '0' ? 'admin/dashboard' : 'pelelang/dashboard';
		}

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/v_about', $data);
		$this->load->view('web/layout/footer');
	}

	public function tnc()
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role') ?? null;
		$data['id'] = $this->session->userdata('id');

		if($data['id']) {
			$data['dashboard_route'] = $data['role'] == '0' ? 'admin/dashboard' : 'pelelang/dashboard';
		}

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/v_tnc', $data);
		$this->load->view('web/layout/footer');
	}

	public function contact()
	{
		//ambil username dari session
		//ambil user role dari session
		//ambil user id dari session
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role') ?? null;
		$data['id'] = $this->session->userdata('id');

		if($data['id']) {
			$data['dashboard_route'] = $data['role'] == '0' ? 'admin/dashboard' : 'pelelang/dashboard';
		}

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/v_contact', $data);
		$this->load->view('web/layout/footer');
	}
}
