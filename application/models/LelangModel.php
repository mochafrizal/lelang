<?php
class LelangModel extends CI_model
{

	//cari semua data
	public function findAll()
	{
		$query = $this->db->get('auctions');
		return $query;
	}
	//cari semua auctions
	public function findAllAuction($keyword = "") 
	{
		$this->db->from('auctions');
		//join users
		$this->db->join('users', 'users.id = auctions.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->select(
			'
			auctions.*,
			profiles.name AS fullname,
			'
		);
		//order by latest auctions.date
		$this->db->order_by('auctions.date', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	public function findAllAuctionByAuctionItemID($id) 
	{
		$this->db->from('auctions');
		//join users
		$this->db->join('users', 'users.id = auctions.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->select(
			'
			auctions.*,
			profiles.name AS fullname,
			'
		);
		$this->db->where('auction_item_id', $id);
		//order by latest auctions.date
		$this->db->order_by('auctions.date', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	public function getAuctionItemID($id)
	{
		$this->db->from('auctions');
		$this->db->where('id', $id);

		//only get one row
		$query = $this->db->get()->row()->auction_item_id;
		return $query;
	}

	public function choose($id)
	{
		//findAuctionByID
		$selected_auction = $this->findAuctionByID($id);
		//findAllAuctionByAuctionItemID
		$all_auctions = $this->findAllAuctionByAuctionItemID($selected_auction->auction_item_id)->result();
		
		//set status to 2
		foreach($all_auctions as $auction) {
			$this->db->set('status', '2');
			$this->db->where('id', $auction->id);
			$this->db->update('auctions');
		}

		//set status to 1
		$this->db->set('status', '1');
		$this->db->where('id', $id);
		$this->db->update('auctions');

		//set auction_items to '2'
		$this->db->set('status', '2');
		$this->db->where('id', $selected_auction->auction_item_id);
		$this->db->update('auction_items');

		return true;
	}

	public function findAllAuctionItemActive($keyword = "") 
	{
		$this->db->from('auction_items');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->select(
			'
			auction_items.*,
			profiles.name AS fullname,
			'
		);
		$this->db->where('auction_items.status', '1');
		$this->db->where("auction_items.name LIKE '%$keyword%'");
		$query = $this->db->get();
		return $query;
	}

	//cari barang lelang berdasarkan id
	public function findAuctionByID($id)
	{
		$this->db->from('auctions');
		//join users
		$this->db->join('users AS kandidat_users', 'kandidat_users.id = auctions.user_id', 'left');
		$this->db->join('users AS pelelang_users', 'pelelang_users.id = auctions.user_id', 'left');
		//join profiles
		$this->db->join('profiles AS kandidat_profiles', 'kandidat_profiles.user_id = kandidat_users.id');
		$this->db->join('profiles AS pelelang_profiles', 'pelelang_profiles.user_id = pelelang_users.id');
		//join auction_items
		$this->db->join('auction_items', 'auction_items.id = auctions.auction_item_id');
		//leftjoin categories
		$this->db->join('categories', 'categories.id = auction_items.category_id', 'left');
		$this->db->select(
			'
			auctions.*,
			auction_items.code AS auction_item_code,
			auction_items.name AS auction_item_name,
			auction_items.photo AS auction_item_photo,
			auction_items.open_price AS auction_item_open_price,
			auction_items.open_date AS auction_item_open_date,
			auction_items.close_date AS auction_item_close_date,
			auction_items.location AS auction_item_location,
			auction_items.note AS auction_item_note,
			kandidat_profiles.name AS kandidat_fullname,
			kandidat_profiles.address AS kandidat_address,
			pelelang_profiles.name AS pelelang_fullname,
			pelelang_profiles.account_name AS pelelang_account_name,
			pelelang_profiles.account_number AS pelelang_account_number,
			pelelang_profiles.bank_name AS pelelang_bank_name,
			categories.name AS category_name,
			'
		);
		$this->db->where('auctions.id', $id);
		//get data
		$query = $this->db->get()->row();
		return $query;
	}

	//cari lelang berdasarkan user id
	public function findAuctionByUserID($user_id, $keyword, $category_id = null)
	{
		$this->db->from('auctions');
		//join auction items
		$this->db->join('auction_items', 'auction_items.id = auctions.auction_item_id');
		//leftjoin categories
		$this->db->join('categories', 'categories.id = auction_items.category_id', 'left');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->select(
			'
			auctions.*,
			auction_items.category_id AS auction_item_category_id,
			auction_items.photo AS auction_item_photo,
			auction_items.name AS auction_item_name,
			profiles.name AS fullname,
			categories.name AS category_name,
			'
		);
		$this->db->where('auctions.user_id', $user_id);
		$this->db->where("auction_items.name LIKE '%$keyword%'");
		if ($category_id != null) {
			$this->db->where('auction_items.category_id', $category_id);
		}
		//get data
		$query = $this->db->get();
		return $query;
	}

	public function findAuctionPayment($id)
	{
		$this->db->from('auction_payments');
		//join auction items
		$this->db->join('auctions', 'auctions.id = auction_payments.auction_id');
		$this->db->join('auction_items', 'auction_items.id = auctions.auction_item_id');
		//join users
		$this->db->join('users', 'users.id = auction_items.user_id', 'left');
		//join profiles
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->select(
			'
			auction_payments.id AS id,
			auction_payments.auction_id AS auction_id,
			auction_payments.recipient_name AS recipient_name,
			auction_payments.recipient_address AS recipient_address,
			auction_payments.status AS status,
			auction_payments.proof_payment AS proof_payment,
			auctions.price AS auction_price,
			auction_items.id AS auction_item_id,
			auction_items.code AS auction_item_code,
			auction_items.name AS auction_item_name,
			auction_items.photo AS auction_item_photo,
			auction_items.open_price AS auction_item_open_price,
			auction_items.open_date AS auction_item_open_date,
			auction_items.close_date AS auction_item_close_date,
			profiles.name AS fullname,
			'
		);
		$this->db->where('auction_payments.auction_id', $id);
		//get data
		$query = $this->db->get()->row();
		return $query;
	}

	//input data
	public function createAuctionPayment($data)
	{
		$this->db->insert('auction_payments', $data);
		return $this->db->insert_id();
	}

	public function editAuctionPayment($where, $data)
	{
		$this->db->where($where);
		$this->db->update('auction_payments', $data);
	}

	//input data
	public function create($data)
	{
		$this->db->insert('auctions', $data);
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
