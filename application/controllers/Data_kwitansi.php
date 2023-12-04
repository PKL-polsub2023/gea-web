<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kwitansi extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Datakwitansi_model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Datakwitansi_model->Lihatmaster()
        );

		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/datakwitansi/index',$data);
        $this->load->view('aadmin_layout/footer');
	} 


    public function tambah()
	{
		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/datakwitansi/tambah');
        $this->load->view('aadmin_layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'tanggal'       => $this->input->post('tanggal'),
                    'no_polisi'       => $this->input->post('no_polisi'),
                    'nama_driver'       => $this->input->post('nama_driver'),
                    //'lokasispbg'       => $this->input->post('lokasispbg'),
                    'mastersupplier_id'       => $this->input->post('mastersupplier_id'),
                    'tekananawal'       => $this->input->post('tekananawal'),
                    'tekananakhir'       => $this->input->post('tekananakhir'),
                    'totalisatorawal'       => $this->input->post('totalisatorawal'),
                    'totalisatorakhir'       => $this->input->post('totalisatorakhir'),
                    'volumegas'       => $this->input->post('volumegas'),
                    'total'       => $this->input->post('total'),
                    'status'       => 'N',
                );      
            
        $this->db->insert('dt_datakwitansi', $data);             
        
		redirect('data_kwitansi');
	}




    public function ubah($id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Datakwitansi_model->ubah($id)
        ); 
	
        $this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/datakwitansi/edit', $data);
        $this->load->view('aadmin_layout/footer');
	}


    public function ubahsimpan()
	{
        $id =  $this->input->post("datakwitansi_id");

		$data = array(
                  'tanggal'       => $this->input->post('tanggal'),
                  'no_polisi'       => $this->input->post('no_polisi'),
                  'nama_driver'       => $this->input->post('nama_driver'),
                  //'lokasispbg'       => $this->input->post('lokasispbg'),
                  'mastersupplier_id'       => $this->input->post('mastersupplier_id'),
                  'tekananawal'       => $this->input->post('tekananawal'),
                  'tekananakhir'       => $this->input->post('tekananakhir'),
                  'totalisatorawal'       => $this->input->post('totalisatorawal'),
                  'totalisatorakhir'       => $this->input->post('totalisatorakhir'),
                  'volumegas'       => $this->input->post('volumegas'),
                  'total'       => $this->input->post('total'),
		);
		$this->db->where("datakwitansi_id", $id); // ubah id dan postnya
		$this->db->update("dt_datakwitansi", $data);
		redirect('data_kwitansi');
	}

    public function hapus($id){
		if($this->Datakwitansi_model->hapus($id)){
			$this->session->set_flashdata('success', 'rekening <strong>Berhasil</strong> Dihapus!');
			redirect('data_kwitansi');
		} else {
			$this->session->set_flashdata('error', 'rekening <strong>Gagal</strong> Dihapus!');
			redirect('data_kwitansi');
		}
	}

      public function validasi_y($id){
            $data = array(
                  "status" => "Y"
            );

            $this->db->where("datakwitansi_id", $id);
            $this->db->update("dt_datakwitansi", $data);
            redirect("data_kwitansi");
      }

      public function validasi_n($id){
            $data = array(
                  "status" => "N"
            );

            $this->db->where("datakwitansi_id", $id);
            $this->db->update("dt_datakwitansi", $data);
            redirect("data_kwitansi");
      }

      public function ambilHargaSatuan(){
        $mastersupplier_id = $this->input->post("mastersupplier_id");
        $query = $this->db->query("
              SELECT * FROM dt_mastersupplier 
              WHERE mastersupplier_id = '".$mastersupplier_id."'
        ");
        foreach($query->result() as $row){
              $hasil = array(
                    'hargasatuan' => $row->hargasatuan,
              );
        }
        echo json_encode($hasil);
  }



}



