<?php 

class Saldo_Awal_Model extends CI_Model{

	protected $_table = 'dt_mastercoa';

	public function __construct() {

        parent::__construct();

    }

    public function Lihatsaldoawal(){	

		$query = $this->db->query("SELECT * FROM dt_mastercoa a, dt_saldo_awal b where a.mastercoa_id=b.mastercoa_id");

		return $query->result_array();

	}

	public function editsaldoawal($id){	

		$query = $this->db->query("SELECT * FROM dt_mastercoa a, dt_saldo_awal b where a.mastercoa_id=b.mastercoa_id and b.saldoawal_id=$id");

		return $query->result_array();

	}


	public function ubah($saldoawal_id){	

		$query = $this->db->query("SELECT * FROM dt_mastercoa a, dt_saldo_awal b where a.mastercoa_id=b.mastercoa_id and b.saldoawal_id=$saldoawal_id");

		return $query->row_array();

	}
	public function lihat_no_jurnal($no_jurnal){
		return $this->db->get_where('dt_saldo_awal', ['no_jurnal' => $no_jurnal])->row();
	}

	
	public function hapussaldoawal($saldoawal){
		return $this->db->delete('dt_saldo_awal', ['saldoawal_id' => $saldoawal]);
	}


    public function hapusprogres($id)
    {
        $this->db->where('dt_saldo_awal',$id);
        return $this->db->delete('dt_progres');
        
    }

    public function hapus($id)
    {
        $this->db->where('dt_saldo_awal_id',$id); 
        return $this->db->delete('dt_saldo_awal');
        
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
		return $this->db->insert('dt_saldo_awal', $data);
	}
	


    public function edit_saldoawal2($kode,$nama,$saldo_normal,$debit,$kredit,$status){
        $hasil=$this->db->query("UPDATE dt_saldo_awal SET kode='$kode',nama='$nama',saldo_normal='$saldo_normal',debit='$debit',kredit='$kredit',status='$status' WHERE saldoawal_id='$kode'");
        return $hasil;
    }

	function edit_saldoawal(){
        $hasil=$this->db->query("SELECT * FROM dt_mastercoa a, dt_saldo_awal b where a.mastercoa_id=b.mastercoa_id");
        return $hasil;
    }

}