<?php 

class Hutang_model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmaster(){	

		$query = $this->db->query("
                  SELECT * FROM dt_tagihan_customer
                  JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
                  JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id
			JOIN dt_mastersupplier ON dt_mastersupplier.mastersupplier_id = dt_datakwitansi.mastersupplier_id
                  ORDER BY tagihan_customer_id DESC
            ");

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

		$query = $this->db->query("
		SELECT *, dt_tagihan_customer.tekananawal as tawal, dt_tagihan_customer.tekananakhir as takhir  FROM dt_tagihan_customer
            JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
            JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
            JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id 
		JOIN dt_mastersupplier ON dt_mastersupplier.mastersupplier_id = dt_datakwitansi.mastersupplier_id
		WHERE dt_tagihan_customer.tagihan_customer_id = '".$id."'; ");

		return $query->row_array();

	}

	public function hapus($id){
		return $this->db->delete('dt_tagihan_customer', ['tagihan_customer_id' => $id]);
	}

      function dropdownCustomer(){
            $data = array();

            $this->db->order_by("mastercustomer_id", "DESC");
            $query = $this->db->get("dt_mastercustomer");
            
            $data[""] = "- Pilih Customer -";
            foreach ($query->result() as $row) {
                  $data[$row->mastercustomer_id] = $row->namaperusahaan;
            }
            
            return $data;
      }

	function dropSuratjalan(){
            $data = array();

            $this->db->order_by("suratjalan_customer_id", "DESC");
            $query = $this->db->get("dt_suratjalan_customer");
            
            $data[""] = "- Pilih ID Surat Jalan -";
            foreach ($query->result() as $row) {
                  $data[$row->suratjalan_customer_id] = $row->suratjalan_customer_id;
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