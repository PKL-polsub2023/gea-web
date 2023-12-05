<?php 

class Piutang_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

    public function Lihatmaster(){	

		$query = $this->db->query("SELECT * FROM dt_mastercustomer ORDER BY mastercustomer_id DESC");

		return $query->result_array();

	}

      public function LihatMasterPaid($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_tagihan_customer
                  JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
                  JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id

                  WHERE dt_mastercustomer.mastercustomer_id = '".$mastercustomer_id."' AND statushutang = 'Y'
                  ORDER BY tagihan_customer_id DESC
            ");

		return $query->result_array();

	}

      public function LihatMasterUnpayed($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_tagihan_customer
                  JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
                  JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id

                  WHERE dt_mastercustomer.mastercustomer_id = '".$mastercustomer_id."' AND statushutang = 'N'
                  ORDER BY tagihan_customer_id DESC
            ");

		return $query->result_array();

	}

	public function ChekInvoice($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT COUNT(id_invoice) FROM dt_invoice
                  WHERE mastercustomer_id = '".$mastercustomer_id."'
            ");

		return $query->result_array();

	}

	

      public function LihatMasterInvoice($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_tagihan_customer
                  JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
                  JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id

                  WHERE dt_mastercustomer.mastercustomer_id = '".$mastercustomer_id."'
                  ORDER BY tagihan_customer_id DESC
            ");

		return $query->result_array();



	}

	public function Detail($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_tagihan_customer
                  JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
                  JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id

                  WHERE dt_mastercustomer.mastercustomer_id = '".$mastercustomer_id."'
            ");

		return $query->row_array();
	}

	public function DetailTagihan($tagihan_customer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_tagihan_customer
                  JOIN dt_mastercustomer ON dt_mastercustomer.mastercustomer_id = dt_tagihan_customer.mastercustomer_id
                  JOIN dt_suratjalan_customer ON dt_suratjalan_customer.suratjalan_customer_id = dt_tagihan_customer.suratjalan_customer_id
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id

                  WHERE dt_tagihan_customer.tagihan_customer_id = '".$tagihan_customer_id."'
                  
            ");

		return $query->row_array();

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


	public function ubah($mastercustomer_id){	

		$query = $this->db->query("SELECT * FROM dt_mastercustomer WHERE mastercustomer_id = '".$mastercustomer_id."'; ");

		return $query->row_array();

	}

	public function hapus($mastercustomer_id){
		return $this->db->delete('dt_mastercustomer', ['mastercustomer_id' => $mastercustomer_id]);
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