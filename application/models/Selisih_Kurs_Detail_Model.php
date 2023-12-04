<?php

class Selisih_Kurs_Detail_Model extends CI_Model {
	protected $_table = 'dt_selisih_kurs_detail';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	// public function lihat_no_penjualan($no_penjualan){
	// 	return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->result();
	// }

	public function hapusselisihkursdetail($no_jurnal){
		return $this->db->delete('dt_selisih_kurs_detail', ['no_jurnal' => $no_jurnal]);
	}
	
}