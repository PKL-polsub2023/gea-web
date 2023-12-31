<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kwitansi extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Datakwitansi_model');
        $this->load->model('Master_Kendaraan_Model');
        $this->load->model('Master_Driver_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $role = $this->session->userdata('role');
        $data = array( 
            'datamaster'		=> $this->Datakwitansi_model->Lihatmaster(),
        );

        if($role == "admin")
        {
            $this->load->view('aadmin_layout/header');
            $this->load->view('aadmin_layout/sidebar');
            $this->load->view('aadmin_item/datakwitansi/index',$data);
            $this->load->view('aadmin_layout/footer');
        }else if ($role == "pimpinan"){
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan_item/datakwitansi/index',$data);
            $this->load->view('pimpinan/footer');
        }

		
	} 


    public function tambah()
	{
        $data = [
            'driver' => $this->Master_Driver_Model->dropDriver(),
            'kendaraan' => $this->Master_Kendaraan_Model->dropKendaraan(),
        ];

		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/datakwitansi/tambah', $data);
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
                    'satuan_harga'       => $this->input->post('hargasatuan'),
                    'total'       => $this->input->post('total'),
                    'status'       => 'N',
                );      
            
        $this->db->insert('dt_datakwitansi', $data);             
        
		redirect('data_kwitansi');
	}




    public function ubah($id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Datakwitansi_model->ubah($id),
            'driver' => $this->Master_Driver_Model->dropDriver(),
            'kendaraan' => $this->Master_Kendaraan_Model->dropKendaraan(),
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
                  'satuan_harga'       => $this->input->post('hargasatuan'),
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
                  "status" => "Y",
                  "tanggalbayar" => date('Y-m-d'),
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



