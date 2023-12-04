<?php 

class Progress_lisensi_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatprogress_lisensi(){	

		$query = $this->db->query("SELECT * FROM dt_customer a,dt_progres b where a.customer_id=b.customer_id");

		return $query->result_array();

	}


	public function getcustomer($id = NULL){
		
		$query = $this->db->get_where('dt_progres', array('customer_id' => $id))->row();
		return $query;
 
	}


    public function hapusprogres($id)
    {
        $this->db->where('customer_id',$id);
        return $this->db->delete('dt_progres');
        
    }

    public function hapus($id)
    {
        $this->db->where('customer_id',$id); 
        return $this->db->delete('dt_progres');
        
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