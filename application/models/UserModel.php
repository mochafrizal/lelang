<?php
class UserModel extends CI_model
{

	//cari semua data
	public function findAll()
	{
		$query = $this->db->get('users');
		return $query;
	}
	//cari semua admin
	public function findAllAdmin($keyword = "")
	{
		$this->db->where(['role' => '0']);
		$this->db->like('username', $keyword);
		$query = $this->db->get('users');
		return $query;
	}
	//cari semua pelelang
	public function findAllAuctioneer($keyword = "")
	{
		$this->db->select(
			'users.*, 
			profiles.name AS fullname, 
			profiles.address AS address, 
			profiles.phone AS phone, 
			profiles.register_date AS register_date,
			profiles.account_name,
			profiles.account_number,
			profiles.bank_name'
		);
		$this->db->from('users');
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->where(['role' => '1']);
		//like username or profiles.name
		$this->db->like('username', $keyword);
		$this->db->or_like('profiles.name', $keyword);
		$query = $this->db->get();
		return $query;
	}

	//cari pelelang berdasarkan id
	public function findAuctioneerByID($id)
	{
		$this->db->select(
			'users.*, 
			profiles.name AS fullname, 
			profiles.address, 
			profiles.phone, 
			profiles.register_date,
			profiles.account_name,
			profiles.account_number,
			profiles.bank_name,
			'
		);
		$this->db->from('users');
		$this->db->join('profiles', 'profiles.user_id = users.id');
		$this->db->where(['users.id' => $id]);
		
		//get data
		$query = $this->db->get()->row();
		return $query;
	}

	public function changeStatus($id)
	{
		//get user by id
		$user = $this->db->get_where('users', ['id' => $id])->row_array();
		//toggle status
		if ($user['status'] == '1') {
			$status = '0';
		} else {
			$status = '1';
		}
		//update status
		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('users');

		return $this->db->affected_rows();
	}
	//input data
	public function create($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	//input data profiles
	public function createProfil($data)
	{
		$this->db->insert('profiles', $data);
		return $this->db->insert_id();
	}
	//edit data
	public function edit($where, $data)
	{
		$this->db->where($where);
		$this->db->update('users', $data);
	}
	//edit data profiles
	public function editProfiles($where, $data)
	{
		$this->db->where($where);
		$this->db->update('profiles', $data);
	}
	//delete data
	public function delete($where)
	{
		$this->db->where($where);
		$this->db->delete('users');
	}
	//autentikasi user login
	public function auth($username, $password)
	{
		$this->db->where(['username' => $username, 'status' => '1']);
		$query = $this->db->get('users')->result();

		if (count($query) > 0) {
			if (password_verify($password, $query[0]->password)) {
				return array(true, $query[0]->id, $query[0]->username, $query[0]->role);
			}
		}

		return array(false, null, null);
	}
}
