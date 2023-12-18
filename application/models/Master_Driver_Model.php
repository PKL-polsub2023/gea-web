<?php 

class Master_Driver_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmaster(){	

		$query = $this->db->query("SELECT * FROM dt_master_driver ORDER BY id_driver DESC");

		return $query->result_array();

	}



	public function ubah($id_driver){	

		$query = $this->db->query("SELECT * FROM dt_master_driver WHERE id_driver = '".$id_driver."'; ");

		return $query->row_array();

	}

	public function hapus($id_driver){
		return $this->db->delete('dt_master_driver', ['id_driver' => $id_driver]);
	}

	function dropDriver(){
		$data = array();

		$this->db->order_by("id_driver", "DESC");
		$query = $this->db->get("dt_master_driver");
		
		$data[""] = "- Pilih Driver -";
		foreach ($query->result() as $row) {
			  $value = $row->nama_driver;
			  $data[$value] = $value;
		}
		
		return $data;
  }


}