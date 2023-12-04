<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Customer_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datacustomer'		=> $this->Customer_Model->LihatCustomer()
        );

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/customer/index',$data);
        $this->load->view('layout/footer');
	} 


    public function tambah()
	{
        $this->load->library('session'); 
        
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/customer/tambah');
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{
		$data = array(
		  'nik' => $this->input->post('nik'),
		  'nama_cust' => $this->input->post('nama_cust'),
          'tmp_lahir' => $this->input->post('tmp_lahir'),
          'tgl_lahir' => $this->input->post('tgl_lahir'),
          'sertifikasi' => $this->input->post('sertifikasi'),
          'bidang' => $this->input->post('bidang'),
          'email' => $this->input->post('email'),
          'no_hp' => $this->input->post('no_hp'),
          'gol_darah' => $this->input->post('gol_darah'),
          'expired_date' => $this->input->post('expired_date'),
          'keterangan' => $this->input->post('keterangan'),
          'sertifikat' => $this->input->post('sertifikat'),
          'ktp' => $this->input->post('ktp'),
          'ijasah' => $this->input->post('ijasah'),
          'surat_permohonan' => $this->input->post('surat_permohonan'),
          'surat_pernyataan' => $this->input->post('surat_pernyataan'),
          'surat_keterangan' => $this->input->post('surat_keterangan'),
          'lisensi' => $this->input->post('lisensi'),
          'skp' => $this->input->post('skp'),
          'laporan_kegiatan' => $this->input->post('laporan_kegiatan'),
          'paklaring' => $this->input->post('paklaring'),
          'pas_photo' => $this->input->post('pas_photo'),
		);
		$this->db->insert('dt_customer',$data);

        //prepare data for table customer
        $data = array(
        'customer_id' => $this->db->insert_id(),
        'status' => 0
        );
        //insert into table progres
        $this->db->insert('dt_progres',$data);  
		redirect('customer');
	}


    public function hapus22()
	{
		$id = $this->input->post("customer_id");
		$this->Customer_Model->hapus($id);
		redirect('customer');
	}

    public function hapus()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('customer_id');

         $data = $this->Customer_Model->hapus($id);
         $data = $this->Customer_Model->hapusprogres($id);
         echo json_encode($data);
    }

}



