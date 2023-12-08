<?php 

class Master_Kendaraan_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmaster(){	

		$query = $this->db->query("SELECT * FROM dt_master_kendaraan ORDER BY id_kendaraan DESC");

		return $query->result_array();

	}



	public function ubah($id_kendaraan){	

		$query = $this->db->query("SELECT * FROM dt_master_kendaraan WHERE id_kendaraan = '".$id_kendaraan."'; ");

		return $query->row_array();

	}

	public function hapus($id_kendaraan){
		return $this->db->delete('dt_master_kendaraan', ['id_kendaraan' => $id_kendaraan]);
	}


}