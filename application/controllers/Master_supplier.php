<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_supplier extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Master_Supplier_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Master_Supplier_Model->Lihatmaster()
        );

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastersupplier/index',$data);
        $this->load->view('layout/footer');
	} 


    public function tambah()
	{
        $data = array( 
            'datakelompokakun'		=> $this->Master_Supplier_Model->datakelompokakun()
        ); 
        
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastersupplier/tambah',$data);
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'namaspbg'                  => $this->input->post('namaspbg'),
                    'lokasispbg'                  => $this->input->post('lokasispbg'),
                    'jarakspbg'       => $this->input->post('jarakspbg'),
                    'hargasatuan'       => $this->input->post('hargasatuan'),
                );      
            
        $this->db->insert('dt_mastersupplier', $data);             
        
		redirect('master_supplier');
	}




    public function ubah($mastersupplier_id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Master_Supplier_Model->ubah($mastersupplier_id)
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastersupplier/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $mastersupplier_id =  $this->input->post("mastersupplier_id");

		$data = array(
            'mastersupplier_id'          => $this->input->post('mastersupplier_id'),           
            'namaspbg'                  => $this->input->post('namaspbg'),
            'lokasispbg'                  => $this->input->post('lokasispbg'),
            'jarakspbg'       => $this->input->post('jarakspbg'),
            'hargasatuan'       => $this->input->post('hargasatuan'),
		);
		$this->db->where("mastersupplier_id", $mastersupplier_id); // ubah id dan postnya
		$this->db->update("dt_mastersupplier", $data);
		redirect('master_supplier');
	}

    public function hapus($mastersupplier_id){
		if($this->Master_Supplier_Model->hapus($mastersupplier_id)){
			$this->session->set_flashdata('success', 'Supplier <strong>Berhasil</strong> Dihapus!');
			redirect('master_supplier');
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('master_supplier');
		}
	}





}



