<?php
class BarangModel extends CI_model
{

	//cari semua data
	public function findAll()
	{
		$query = $this->db->get('auctions');
		return $query;
	}
	//cari semua auction_items
	public function findAllAuctionItem($keyword = "") 
	{
		$this->db->from('auction_items');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		//leftjoin categories
		$this->db->join('categories', 'categories.id = auction_items.category_id', 'left');
		$this->db->select(
			'
			auction_items.*,
			profiles.name AS fullname,
			categories.name AS category_name,
			'
		);
		$this->db->like('auction_items.name', $keyword);
		//or like code
		$this->db->or_like('auction_items.code', $keyword);
		$query = $this->db->get();
		return $query;
	}

	public function findAllAuctionItemActive($keyword = "", $category_id = null) 
	{
		$this->db->from('auction_items');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		//leftjoin categories
		$this->db->join('categories', 'categories.id = auction_items.category_id', 'left');
		$this->db->select(
			'
			auction_items.*,
			profiles.name AS fullname,
			categories.name AS category_name,
			'
		);
		// print_r($keyword);
		$this->db->where('auction_items.status', '1');
		$this->db->where("auction_items.name LIKE '%$keyword%'");
		$this->db->where('auction_items.close_date >=', date('Y-m-d h:i:s'));
		if ($category_id != null) {
			$this->db->where('auction_items.category_id', $category_id);
		}
		//oderby latest open_date
		$this->db->order_by('auction_items.open_date', 'DESC');
		//orderby latest close_date
		$this->db->order_by('auction_items.close_date', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	//cari barang lelang berdasarkan id
	public function findAuctionItemByID($id)
	{
		$this->db->from('auction_items');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		//leftjoin categories
		$this->db->join('categories', 'categories.id = auction_items.category_id', 'left');
		$this->db->select(
			'
			auction_items.*,
			profiles.name AS fullname,
			categories.name AS category_name,
			'
		);
		$this->db->where('auction_items.id', $id);
		
		//get data
		$query = $this->db->get()->row();
		return $query;
	}


	//cari barang lelang berdasarkan user id
	public function findAuctionItemByUserID($user_id, $keyword, $category_id = null)
	{
		$this->db->from('auction_items');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		//leftjoin categories
		$this->db->join('categories', 'categories.id = auction_items.category_id', 'left');
		$this->db->select(
			'
			auction_items.*,
			profiles.name AS fullname,
			categories.id AS category_id,
			categories.name AS category_name,
			'
		);
		$this->db->where('auction_items.user_id', $user_id);
		$this->db->where("auction_items.name LIKE '%$keyword%'");
		if ($category_id != null) {
			$this->db->where('auction_items.category_id', $category_id);
		}
		//get data
		$query = $this->db->get();
		return $query;
	}

	public function changeStatus($id)
	{
		
	}
	//input data
	public function create($data)
	{
		$this->db->insert('auction_items', $data);
		return $this->db->insert_id();
	}
	//edit data
	public function edit($where, $data)
	{
		$this->db->where($where);
		$this->db->update('auction_items', $data);
	}
	//delete data
	public function delete($where)
	{
		$this->db->where($where);
		$this->db->delete('auction_items');
	}
}
