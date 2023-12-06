<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acountmanajer extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('Acountmanajer_Model');
        $this->load->model('Master_Customer_Model');
        $this->load->library('session');
	}



	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Acountmanajer_Model->Lihatmaster()
        );

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/usermanajer/index',$data);
        $this->load->view('layout/footer');
	} 

	public function tambah()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/usermanajer/tambah');
        $this->load->view('layout/footer'); 
	} 
	public function simpan()
	{      
        $data=array(
                    'username'                  => $this->input->post('username'),
                    'password'                  => md5($this->input->post('alamat')),
                    'role'       => $this->input->post('role'),
                );      
            
        $this->db->insert('dt_user', $data);             
        
		redirect('Acountmanajer');
	}

	public function ubah($id){		

        $data = array( 
            'edit'		        => $this->Acountmanajer_Model->ubah($id)
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/usermanajer/edit', $data);
        $this->load->view('layout/footer');
	}

	public function ubahsimpan()
	{
        $id =  $this->input->post("id");

		$data = array(
            'username'                  => $this->input->post('username'),
            'role'                  => $this->input->post('role'),
		);
		$this->db->where("id", $id);
		$this->db->update("dt_user", $data);

		if ($this->input->post("password") <> null) {
			$data = array(
				'password'                  => md5($this->input->post('password')),
			);
			$this->db->where("id", $id);
			$this->db->update("dt_user", $data);
		}
		redirect('Acountmanajer');
	}
	
	public function hapus($id){
		if($this->Acountmanajer_Model->hapus($id)){
			$this->session->set_flashdata('success', 'User <strong>Berhasil</strong> Dihapus!');
			redirect('Acountmanajer');
		} else {
			$this->session->set_flashdata('error', 'User <strong>Gagal</strong> Dihapus!');
			redirect('Acountmanajer');
		}
	}
}



