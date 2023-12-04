<?php 

class Master_COA_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmastercoa(){	

		$query = $this->db->query("
		SELECT *, dt_kelompokakun.nama AS kelompokakun, dt_mastercoa.nama as namacoa FROM dt_mastercoa
		JOIN dt_kelompokakun ON dt_mastercoa.id_kelompokakun = dt_kelompokakun.id_kelompokakun
		ORDER BY kode ASC");
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

    public function hapus($id)
    {
        $this->db->where('mastercoa_id',$id); 
        return $this->db->delete('dt_mastercoa');
        
    }


	public function ubah($mastercoa_id){	

		$query = $this->db->query(" 
		
		SELECT *, dt_kelompokakun.nama AS kelompokakun, dt_mastercoa.nama as namacoa FROM dt_mastercoa
		JOIN dt_kelompokakun ON dt_mastercoa.id_kelompokakun = dt_kelompokakun.id_kelompokakun
		WHERE dt_mastercoa.mastercoa_id = $mastercoa_id");

		return $query->row_array();

	}

	public function hapuscoa($mastercoa_id){
		return $this->db->delete('dt_mastercoa', ['mastercoa_id' => $mastercoa_id]);
	}

	function parentID(){
            $data = array();

            $this->db->order_by("kode", "ASC");
		$this->db->where("parent_id", NULL);
            $query = $this->db->get("dt_mastercoa");
            
            $data[""] = "- Primary -";
            foreach ($query->result() as $row) {
                  $data[$row->mastercoa_id] = $row->kode ." - ". $row->nama;
            }
            
            return $data;
      }

	function dropdownRekening(){
            $data = array();

            $this->db->order_by("namarekening", "ASC");
		$query = $this->db->get("dt_masterrekenign");
            
            $data[""] = "- Pilih Rekening -";
            foreach ($query->result() as $row) {
                  $data[$row->masterrekening_id] = $row->namarekening ."(".$row->norekening.") - " . $row->atasnama;
            }
            
            return $data;
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