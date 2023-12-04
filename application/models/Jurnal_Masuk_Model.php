<?php 

class Jurnal_Masuk_Model extends CI_Model{

	protected $_table = 'dt_mastercoa';

	public function __construct() {

        parent::__construct();

    }

    public function Lihatjurnalmasuk(){	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk ORDER BY jurnalmasuk_id DESC");

		return $query->result_array();

	}


	public function lihat_detail_jurnal($no_jurnal){	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk a, dt_jurnal_masuk_detail b, dt_mastercoa c where a.no_jurnal=b.no_jurnal and b.mastercoa_id=c.mastercoa_id and b.no_jurnal='$no_jurnal'");

		return $query->result_array();

	}
	public function lihat_no_jurnal($no_jurnal){
		return $this->db->get_where('dt_jurnal_masuk', ['no_jurnal' => $no_jurnal])->row();
	}
	
	public function getJurnal($no_jurnal){
		$data = $this->db->query("select * from dt_jurnal_masuk where no_jurnal = '$no_jurnal'")->result_array();
		return count($data) > 0 ? (object)$data[0] : $data;
	}

	
	public function hapusjurnal($no_jurnal){
		return $this->db->delete('dt_jurnal_masuk', ['no_jurnal' => $no_jurnal]);
	}


    public function hapusprogres($id)
    {
        $this->db->where('dt_jurnal_masuk_id',$id);
        return $this->db->delete('dt_progres');
        
    }

    public function hapus($id)
    {
        $this->db->where('dt_jurnal_masuk_id',$id); 
        return $this->db->delete('dt_jurnal_masuk');
        
    }

	function get_idakun(){
        $hasil=$this->db->query("SELECT * FROM dt_mastercoa");
        return $hasil;
    }

	function get_namaakun($id){
        $hasil=$this->db->query("SELECT * FROM dt_mastercoa WHERE mastercoa_id='$id'");
        return $hasil->result();
    }


 



	public function getakun($id){
    	
		$query = $this->db->query("SELECT * FROM dt_mastercoa WHERE mastercoa_id='$id'");

		return $query->result();

	}



	public function datacoa(){

	$this->db->order_by('kode', 'asc');
    	$query = $this->db->get('dt_mastercoa');

    	return $query->result_array();

	}


	public function tambah($data){
		return $this->db->insert('dt_jurnal_masuk', $data);
	}
	
	public function updateJurnal($id, $data)
	{
		$this->db->where('jurnalmasuk_id', $id);
		$this->db->update('dt_jurnal_masuk', $data);
	}

	public function updateJurnalDetail(string $no_jurnal, array $data)
	{
		// hapus detail dengan no_jurnal ini
		$details = $this->db->query("SELECT * FROM dt_jurnal_masuk_detail WHERE no_jurnal = '$no_jurnal'")->result();

		if (count($details) > 0) {
			foreach ($details as $detail) {
				$this->db->delete('dt_jurnal_masuk_detail', array(
					'no_jurnal' => $detail->no_jurnal,
					'mastercoa_id' => $detail->mastercoa_id
				)); 
			}
		}

		foreach ($data as $item) {
			$this->db->insert('dt_jurnal_masuk_detail', $item);
		}

		// kurang update total debit + kredit di jurnal masuk
		
		// echo "<pre>";
		// var_dump($details);
		// echo "</pre>";
		// die();
	}

    
    

    // public function getDokumenAktif($periode){
	// 	$query = $this->db->query("select Dokumen from Ang_Kontrol_Dokumen where Periode=$periode and isActive=1");
	// 	if($query->num_rows > 0){
	// 			$row =  $query->row_array();
	// 			return $row['Dokumen'];
	// 	}else{
	// 			return 0;
	// 	}
	// }

    // public function getDataLokasi($id)
	// {
	// 	$query = $this->db->query("SELECT KodeLokasi FROM Aset_peralatan_mesin Where Id=".$id);
	// 	//$query = $this->db->query("SELECT KodeLokasi FROM Aset_peralatan_mesin Where Id=".$id);

	// 	if($query->num_rows > 0){
	// 		return $query->row_array();
	// 	}else{
	// 		return false;
	// 	}		

	// }


    // public function fetchAlllokasi($parentid,$level){
	// 	$query = $this->db->query("SELECT lokasiid, kode, nama FROM gnr_lokasi_barang where Level=$level and parentid=$parentid");
	// 	if($query->num_rows > 0){
	// 			return $query->result_array();
	// 	}else{
	// 			return false;
	// 	}
	// }

}