<?php
class KategoriModel extends CI_model
{

	//cari semua data
	public function findAll()
	{
		$query = $this->db->get('categories');
		return $query;
	}

	//input data
	public function create($data)
	{
		$this->db->insert('categories', $data);
		return $this->db->insert_id();
	}

	//check if auction_items exists
	public function checkAuctionItems($id)
	{
		$this->db->where('category_id', $id);
		$query = $this->db->get('auction_items');
		return $query;
	}

	//edit data
	public function edit($where, $data)
	{
		$this->db->where($where);
		$this->db->update('categories', $data);
	}
	
	//delete data
	public function delete($where)
	{
		$this->db->where($where);
		$this->db->delete('categories');
	}
}
