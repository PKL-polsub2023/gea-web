<?php 

class Laporan_Customer_Model extends CI_Model{

	public function __construct() {

        parent::__construct();

    }

	public function cetakpdf($jenis){	

		$query = $this->db->query("SELECT * from dt_customer a, dt_progres b, dt_laporan c where a.customer_id=b.customer_id and c.laporan_id=$jenis");

		return $query->result();

	}


   
}