<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_kendaraan extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Master_Kendaraan_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Master_Kendaraan_Model->Lihatmaster()
        );

        $role = $this->session->userdata('role');
        if($role == "akuntan")
        {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/masterkendaraan/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/kendaraan/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 


    public function tambah()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterkendaraan/tambah');
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'ts'                  => $this->input->post('ts'),
                    'plat_no'                  => $this->input->post('plat_no'),
                );      
            
        $this->db->insert('dt_master_kendaraan', $data);             
        
		redirect('master_kendaraan');
	}




    public function ubah($id_kendaraan){		

        $data = array( 
            'edit'		        => $this->Master_Kendaraan_Model->ubah($id_kendaraan)
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterkendaraan/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $id_kendaraan =  $this->input->post("id_kendaraan");

		$data = array(
            'ts'                  => $this->input->post('ts'),
            'plat_no'                  => $this->input->post('plat_no'),
		);
		$this->db->where("id_kendaraan", $id_kendaraan); // ubah id dan postnya
		$this->db->update("dt_master_kendaraan", $data);
		redirect('master_kendaraan');
	}

    public function hapus($id_kendaraan){
		if($this->Master_Kendaraan_Model->hapus($id_kendaraan)){
			$this->session->set_flashdata('success', 'Customer <strong>Berhasil</strong> Dihapus!');
			redirect('master_kendaraan');
		} else {
			$this->session->set_flashdata('error', 'Customer <strong>Gagal</strong> Dihapus!');
			redirect('master_kendaraan');
		}
	}





}



