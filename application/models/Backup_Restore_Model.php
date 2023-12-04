<?php 

class Backup_Restore_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatdataperusahaan(){	

		$query = $this->db->query("SELECT * FROM dt_pengaturan");

		return $query->row_array();

	}


    public function tampiltabel(){

       return $this->db->query("show tables")->result();
	   
    }

}