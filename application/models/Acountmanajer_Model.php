<?php 

class Acountmanajer_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmaster(){	

		$query = $this->db->query("SELECT * FROM dt_user ORDER BY id DESC");

		return $query->result_array();

	}


	public function datakelompokakun(){	

		$query = $this->db->query("SELECT * FROM dt_kelompokakun");

		return $query->result_array();

	}


    public function hapusprogres($id)
    {
        $this->db->where('mastercoa_id',$id);
        return $this->db->delete('dt_progres');
        
    }


	public function ubah($id){	

		$query = $this->db->query("SELECT * FROM dt_user WHERE id = '".$id."'; ");

		return $query->row_array();

	}

	public function hapus($id){
		return $this->db->delete('dt_user', ['id' => $id]);
	}

}