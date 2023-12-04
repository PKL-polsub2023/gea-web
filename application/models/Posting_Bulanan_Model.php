<?php 

class Posting_Bulanan_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

	public function cetakpdf($no_jurnal,$tgl_awal,$tgl_akhir){	

		$query = $this->db->query("SELECT * from dt_jurnal_masuk where (tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') and no_jurnal='$no_jurnal'");

		return $query->result();

	}


	public function databyjurnal(){

    	$query = $this->db->get('dt_jurnal_masuk');

    	return $query->result();

	}


	public function databyjurnal2(){
		$query = $this->db->query("SELECT * from dt_jurnal_masuk");
		if($query->num_rows > 0){
				return $query->result_array();
		}else{
				return false;
		}
	}


	// public function ambildatajurnal(){
	// 	$query = $this->db->query("INSERT INTO dt_posting_bulanan SELECT * FROM dt_jurnal_masuk");
	// 	if($query->num_rows > 0){
	// 			$row =  $query->row_array();
	// 			return $row['junalmasuk_id'];
	// 	}else{
	// 			return 0;
	// 	}
	// }


	function selectTabelA($jurnalmasuk_id){
		$this->db->select("*");
		$this->db->from("dt_jurnal_masuk");
		$this->db->where("jurnalmasuk_id",$jurnalmasuk_id);
		return $this->db->get()->result();
		}
	function insertTabelB($data){
		$this->db->insert("dt_posting_bulanan",$data);
		}
	function updateTabelA($jurnalmasuk_id){
		$this->db->set("status_postingan_jurnal",1);
		$this->db->from("dt_jurnal_masuk");
		$this->db->where("jurnalmasuk_id",$jurnalmasuk_id);
		}

	public function Lihatjurnalmasuk()
	{	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk");
	
		return $query->result_array();
	
	}


	public function save_batch($data){
		return $this->db->insert_batch('dt_posting_bulanan', $data);
	  }

	// public function cekjurnalposting2(){
	// 	$query = $this->db->query("select status_postingan_jurnal from dt_jurnal_masuk where status_postingan_jurnal=1");
	// 	if($query->num_rows > 0){
	// 			$row =  $query->row_array();
	// 			return $row['status_postingan_jurnal'];
	// 	}else{
	// 			return 0;
	// 	}
	// }

	public function cekjurnalposting(){	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk");

		return $query->row();

	}


	public function ambildata($tgl_awal,$tgl_akhir){	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk WHERE tanggal BETWEEN '" . $tgl_awal  . "as tgl_awal'  AND '" . $tgl_akhir . "as tgl_akhir' ");

		return $query->row();

	}





   
}