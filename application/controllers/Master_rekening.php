<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_rekening extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Master_Rekening_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Master_Rekening_Model->Lihatmaster()
        );

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterrekening/index',$data);
        $this->load->view('layout/footer');
	} 


    public function tambah()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterrekening/tambah');
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'namarekening'       => $this->input->post('namarekening'),
                    'atasnama'       => $this->input->post('atasnama'),
                    'norekening'       => $this->input->post('norekening'),
                );      
            
        $this->db->insert('dt_masterrekening', $data);             
        
		redirect('master_rekening');
	}




    public function ubah($masterrekening_id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Master_Rekening_Model->ubah($masterrekening_id)
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterrekening/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $masterrekening_id =  $this->input->post("masterrekening_id");

		$data = array(
            'masterrekening_id'          => $this->input->post('masterrekening_id'),

            'namarekening'       => $this->input->post('namarekening'),
            'atasnama'       => $this->input->post('atasnama'),
            'norekening'       => $this->input->post('norekening'),
		);
		$this->db->where("masterrekening_id", $masterrekening_id); // ubah id dan postnya
		$this->db->update("dt_masterrekening", $data);
		redirect('master_rekening');
	}

    public function hapus($masterrekening_id){
		if($this->Master_Rekening_Model->hapus($masterrekening_id)){
			$this->session->set_flashdata('success', 'rekening <strong>Berhasil</strong> Dihapus!');
			redirect('master_rekening');
		} else {
			$this->session->set_flashdata('error', 'rekening <strong>Gagal</strong> Dihapus!');
			redirect('master_rekening');
		}
	}





}



