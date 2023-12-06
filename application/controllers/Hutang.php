<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Hutang_model');
            $this->load->model('Datakwitansi_model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Hutang_model->Lihatmaster()
        );

        $role = $this->session->userdata('role');
        
        if($role == "akuntan"){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/hutang/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/hutang/index',$data);
            $this->load->view('pimpinan/footer');
        }
	 
	} 


    public function ubah($id){		

      $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Datakwitansi_model->ubah($id)
        ); 
	
      //   $data = array( 
      //       //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
      //       'edit'		        => $this->Hutang_model->ubah($id)
      //   ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/hutang/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $id =  $this->input->post("datakwitansi_id");

		$data = array(
                  'volumegas'       => $this->input->post('volumegas'),
		);
		$this->db->where("datakwitansi_id", $id); // ubah id dan postnya
		$this->db->update("dt_datakwitansi", $data);
		redirect('hutang');
	}

    public function hapus($id){
		if($this->Hutang_model->hapus($id)){
			$this->session->set_flashdata('success', 'rekening <strong>Berhasil</strong> Dihapus!');
			redirect('tagihan_customer');
		} else {
			$this->session->set_flashdata('error', 'rekening <strong>Gagal</strong> Dihapus!');
			redirect('tagihan_customer');
		}
	}

      public function validasi_y($id){
            $data = array(
                  "status" => "Y"
            );

            $this->db->where("datakwitansi_id", $id);
            $this->db->update("dt_datakwitansi", $data);
            redirect("hutang");
      }

      public function validasi_n($id){
            $data = array(
                  "status" => "N"
            );

            $this->db->where("datakwitansi_id", $id);
            $this->db->update("dt_datakwitansi", $data);
            redirect("data_kwitansi");
      }


      public function ambilData(){
            $suratjalan_customer_id = $this->input->post("suratjalan_customer_id");
            $query = $this->db->query("
                  SELECT * FROM dt_suratjalan_customer
                  WHERE suratjalan_customer_id = '".$suratjalan_customer_id."'
            ");
            foreach($query->result() as $row){
                  $hasil = array(
                        'suratjalan_customer_id' => $row->suratjalan_customer_id,
                        'tanggalkirim' => $row->tanggalkirim,
                  );
            }
            echo json_encode($hasil);
      }


      public function detail($id){		

            // $data = array( 
            //     //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            //     'edit'		        => $this->Hutang_model->ubah($id)
            // ); 
            $data = array( 
                  //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
                  'edit'		        => $this->Datakwitansi_model->ubah($id)
              ); 

            $role = $this->session->userdata('role');
        
            if($role == "akuntan"){
                  $this->load->view('layout/header');
                  $this->load->view('layout/sidebar');
                  $this->load->view('admin/hutang/detail', $data);
                  $this->load->view('layout/footer');
            }else{
                  $this->load->view('pimpinan/header');
                  $this->load->view('pimpinan/sidebar');
                  $this->load->view('pimpinan-content/hutang/detail', $data);
                  $this->load->view('pimpinan/footer');
            }
          
          
          }

}



