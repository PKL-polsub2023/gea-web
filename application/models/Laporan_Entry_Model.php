<?php 

class Laporan_Entry_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

	public function cetakpdf($tgl_awal,$tgl_akhir){	

		$query = $this->db->query("SELECT * from dt_jurnal_masuk where (tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ");

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

	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function caritotal2(){  

		$query = $this->db->query("select sum(debit)as totaldebit,sum(kredit)as totalkredit FROM dt_jurnal_masuk_detail");

		return $query->row_array();


	}



	public function totaldebit(){
		$q = "select sum(debit)as totaldebit,sum(kredit)as totalkredit FROM dt_jurnal_masuk_detail";
		$data = $this->Laporan_Entry_Model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->totaldebit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}


	public function totalkredit(){
		$q = "select sum(debit)as totaldebit,sum(kredit)as totalkredit FROM dt_jurnal_masuk_detail";
		$data = $this->Laporan_Entry_Model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->totalkredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}


	public function periode($tgl_awal,$tgl_akhir){
		$q = "select c.no_jurnal,b.tanggal,b.keterangan,a.kode,a.nama,c.debit,c.kredit from dt_mastercoa a, dt_jurnal_masuk b, dt_jurnal_masuk_detail c 
		where a.mastercoa_id=c.mastercoa_id and b.tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
		and b.tipe_jurnal in(1,2) and b.no_jurnal=c.no_jurnal";
		$data = $this->Laporan_Entry_Model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->tanggal;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}



	


   
}