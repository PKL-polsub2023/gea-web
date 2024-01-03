<?php 

class Invoice_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }
	
	public function ChekInvoice($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT COUNT(id_invoice) FROM dt_invoice
                  WHERE mastercustomer_id = '".$mastercustomer_id."'
            ");

		return $query->result_array();

	}

	

      public function riwayatInvoice($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_invoice
                  WHERE mastercustomer_id = '".$mastercustomer_id."'
                  ORDER BY dibuat DESC
            ");

		return $query->result_array();



	}

      public function detailData($mastercustomer_id){	

		$query = $this->db->query("
                  SELECT * FROM dt_invoice
                  JOIN dt_mastercustomer
                  ON dt_invoice.mastercustomer_id = dt_mastercustomer.mastercustomer_id
                  WHERE dt_invoice.id_invoice = '".$mastercustomer_id."'
                  ORDER BY dt_invoice.dibuat DESC
            ");

		return $query->row_array();



	}

}