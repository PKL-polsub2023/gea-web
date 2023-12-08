<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_driver extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Master_Driver_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Master_Driver_Model->Lihatmaster()
        );

        $role = $this->session->userdata('role');
        if($role == "akuntan")
        {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/masterdriver/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/driver/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 


    public function tambah()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterdriver/tambah');
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'nama_driver'                  => $this->input->post('nama_driver'),
                    'alamat_driver'                  => $this->input->post('alamat_driver'),
                );      
            
        $this->db->insert('dt_master_driver', $data);             
        
		redirect('master_driver');
	}




    public function ubah($id_driver){		

        $data = array( 
            'edit'		        => $this->Master_Driver_Model->ubah($id_driver)
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/masterdriver/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $id_driver =  $this->input->post("id_driver");

		$data = array(
            'nama_driver'                  => $this->input->post('nama_driver'),
            'alamat_driver'                  => $this->input->post('alamat_driver'),
		);
		$this->db->where("id_driver", $id_driver); // ubah id dan postnya
		$this->db->update("dt_master_driver", $data);
		redirect('master_driver');
	}

    public function hapus($id_driver){
		if($this->Master_Driver_Model->hapus($id_driver)){
			$this->session->set_flashdata('success', 'Customer <strong>Berhasil</strong> Dihapus!');
			redirect('master_driver');
		} else {
			$this->session->set_flashdata('error', 'Customer <strong>Gagal</strong> Dihapus!');
			redirect('master_driver');
		}
	}





}



