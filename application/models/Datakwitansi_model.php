<?php 

class Datakwitansi_model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmaster(){	

		$query = $this->db->query("
		SELECT * FROM dt_datakwitansi 
		JOIN dt_mastersupplier ON dt_mastersupplier.mastersupplier_id = dt_datakwitansi.mastersupplier_id 
		ORDER BY dt_datakwitansi.datakwitansi_id DESC");

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

		$query = $this->db->query("SELECT * FROM dt_datakwitansi
		JOIN dt_mastersupplier ON dt_mastersupplier.mastersupplier_id = dt_datakwitansi.mastersupplier_id
		WHERE datakwitansi_id = '".$id."'; ");

		return $query->row_array();

	}

	public function hapus($id){
		return $this->db->delete('dt_datakwitansi', ['datakwitansi_id' => $id]);
	}

	function dropSupplier(){
            $data = array();

            $this->db->order_by("mastersupplier_id", "DESC");
            $query = $this->db->get("dt_mastersupplier");
            
            $data[""] = "- Pilih Lokasi Supplier -";
            foreach ($query->result() as $row) {
                  $data[$row->mastersupplier_id] = $row->lokasispbg;
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