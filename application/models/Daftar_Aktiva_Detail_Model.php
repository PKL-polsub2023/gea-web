<?php

class Daftar_Aktiva_Detail_Model extends CI_Model {
	protected $_table = 'dt_daftar_aktiva_detail';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	// public function lihat_no_penjualan($no_penjualan){
	// 	return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->result();
	// }

	public function hapusdaftaraktivadetail($no_jurnal){
		return $this->db->delete('dt_daftar_aktiva_detail', ['no_jurnal' => $no_jurnal]);
	}
	
}