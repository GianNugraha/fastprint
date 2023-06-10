<?php

/**
 * Crud Model
 */
class Crud extends CI_Model
{

	public function insert($table, $data)
	{
		$result = $this->db->insert($table, $data);
		return $result;
	}

	public function generate($table, $data)
	{
		$result = $this->db->insert($table, $data);
		return $result;
	}

	public function update($table, $data, $id)
	{
		$result = $this->db->where('id_produk', $id)->update($table, $data);
		return $result;
	}

	public function delete($table, $id)
	{
		$result = $this->db->delete($table, ['id_produk' => $id]);
		return $result;
	}

	public function get_records($table, $whr)
	{
		$result = $this->db->where('status =', $whr)->get($table)->result();
		// $result = $this->db->get($table)->result();
		return $result;
	}

	public function find_record_by_id($table, $id)
	{
		$result = $this->db->get_where($table, ['id_produk' => $id])->row();
		return $result;
	}
}
