<?php 

class Jurnal_Keluar_Model extends CI_Model{

	protected $_table = 'dt_mastercoa';

	public function __construct() {

        parent::__construct();

    }

    public function Lihatjurnalkeluar(){	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk where tipe_jurnal=2");

		return $query->result_array();

	}


	public function lihat_detail_jurnal($no_jurnal){	

		$query = $this->db->query("SELECT * FROM dt_jurnal_masuk a, dt_jurnal_masuk_detail b where a.no_jurnal=b.no_jurnal and b.no_jurnal='$no_jurnal'");

		return $query->result_array();

	}
	public function lihat_no_jurnal($no_jurnal){
		return $this->db->get_where('dt_jurnal_masuk', ['no_jurnal' => $no_jurnal])->row();
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

    	$query = $this->db->get('dt_mastercoa');

    	return $query->result_array();

	}


	public function tambah($data){
		return $this->db->insert('dt_jurnal_masuk', $data);
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