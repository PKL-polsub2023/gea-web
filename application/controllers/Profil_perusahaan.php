<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_perusahaan extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('Data_Perusahaan_Model');
	}

	public function index()
	{

		$data = array( 
            'dataperusahaan'		=> $this->Data_Perusahaan_Model->Lihatdataperusahaan()
        );

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/profil_perusahaan/index',$data);
        $this->load->view('layout/footer');
	}


	public function ubah()
	{		
		$id =  $this->input->post("pengaturan_id");
        $nama_logo=null;

        $upload_logo = $_FILES['logo']['name'];
		if ($upload_logo) {
			// setting konfigurasi upload
			$nmfile = "logo";
			$config['upload_path'] = './assets/logo/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['file_name'] = $nmfile;
            $config['encrypt_name'] = TRUE;
			// load library upload
			$this->load->library('upload', $config);
			// upload gambar 
			if ($this->upload->do_upload('logo')) {
                
				//$this->db->set('foto11', $data1['upload_data']['file_name']);
				$result1 = $this->upload->data();
				$result = array('logo'=>$result1);
				$data_logo = array('image_metadata' => $this->upload->data());
		        $nama_logo = $this->upload->data('file_name');

			} else {
				$this->session->set_flashdata("failed"," Gagal Insert Data ! ".$this->upload->display_errors());
				redirect(base_url('profil_perusahaan'));
			}
		}

		$data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'website' => $this->input->post('website'),
            'alamat' => $this->input->post('alamat'),
            'logo' => $nama_logo,
          );
        
		//$this->db->insert('dt_pengaturan',$data); 
		$this->db->where("pengaturan_id", $id);   
		$this->db->update("dt_pengaturan", $data);      
		redirect('profil_perusahaan');


		}

}
