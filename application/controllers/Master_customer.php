<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_customer extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Master_Customer_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Master_Customer_Model->Lihatmaster()
        );

        $role = $this->session->userdata('role');
        if($role == "akuntan")
        {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/mastercustomer/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/mastercustomer/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 


    public function tambah()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastercustomer/tambah');
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'namaperusahaan'                  => $this->input->post('namaperusahaan'),
                    'alamat'                  => $this->input->post('alamat'),
                    'namapic'       => $this->input->post('namapic'),
                    'notelp'       => $this->input->post('notelp'),
                    'radius'       => $this->input->post('radius'),
                    'harga_jual'       => $this->input->post('harga_jual'),
                );      
            
        $this->db->insert('dt_mastercustomer', $data);             
        
		redirect('master_customer');
	}




    public function ubah($mastercustomer_id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Master_Customer_Model->ubah($mastercustomer_id)
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastercustomer/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $mastercustomer_id =  $this->input->post("mastercustomer_id");

		$data = array(
            'mastercustomer_id'          => $this->input->post('mastercustomer_id'),

            'namaperusahaan'                  => $this->input->post('namaperusahaan'),
            'alamat'                  => $this->input->post('alamat'),
            'namapic'       => $this->input->post('namapic'),
            'notelp'       => $this->input->post('notelp'),
            'radius'       => $this->input->post('radius'),
            'harga_jual'       => $this->input->post('harga_jual'),
		);
		$this->db->where("mastercustomer_id", $mastercustomer_id); // ubah id dan postnya
		$this->db->update("dt_mastercustomer", $data);
		redirect('master_customer');
	}

    public function hapus($mastercustomer_id){
		if($this->Master_Customer_Model->hapus($mastercustomer_id)){
			$this->session->set_flashdata('success', 'Customer <strong>Berhasil</strong> Dihapus!');
			redirect('master_customer');
		} else {
			$this->session->set_flashdata('error', 'Customer <strong>Gagal</strong> Dihapus!');
			redirect('master_customer');
		}
	}





}



