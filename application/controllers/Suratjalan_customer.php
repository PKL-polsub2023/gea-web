<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suratjalan_customer extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Suratjalan_customer_model');
        $this->load->model('Master_Customer_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Suratjalan_customer_model->Lihatmaster()
        );

		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/suratjalan_customer/index',$data);
        $this->load->view('aadmin_layout/footer');
	} 


    public function tambah()
	{
		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/suratjalan_customer/tambah');
        $this->load->view('aadmin_layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'datakwitansi_id'       => $this->input->post('datakwitansi_id'),
                    'mastercustomer_id'       => $this->input->post('mastercustomer_id'),
                    'tanggalkirim'       => $this->input->post('tanggalkirim'),
                    
                );      
            
        $this->db->insert('dt_suratjalan_customer', $data);             
        
		redirect('suratjalan_customer');
	}




    public function ubah($id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Suratjalan_customer_model->ubah($id)
        ); 
	
        $this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/suratjalan_customer/edit', $data);
        $this->load->view('aadmin_layout/footer');
	}


    public function ubahsimpan()
	{
        $id =  $this->input->post("suratjalan_customer_id");

		$data = array(
            'datakwitansi_id'       => $this->input->post('datakwitansi_id'),
            'mastercustomer_id'       => $this->input->post('mastercustomer_id'),
            'tanggalkirim'       => $this->input->post('tanggalkirim'),
		);
		$this->db->where("suratjalan_customer_id", $id); // ubah id dan postnya
		$this->db->update("dt_suratjalan_customer", $data);
		redirect('suratjalan_customer');
	}

    public function hapus($id){
		if($this->Suratjalan_customer_model->hapus($id)){
			$this->session->set_flashdata('success', 'rekening <strong>Berhasil</strong> Dihapus!');
			redirect('suratjalan_customer');
		} else {
			$this->session->set_flashdata('error', 'rekening <strong>Gagal</strong> Dihapus!');
			redirect('suratjalan_customer');
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


      public function ambilData(){
            $datakwitansi_id = $this->input->post("datakwitansi_id");
            $query = $this->db->query("
                  SELECT * FROM dt_datakwitansi
                  JOIN dt_mastersupplier ON dt_mastersupplier.mastersupplier_id = dt_datakwitansi.mastersupplier_id
                  WHERE datakwitansi_id = '".$datakwitansi_id."'
                  ORDER BY datakwitansi_id DESC
            ");
            foreach($query->result() as $row){
                  $hasil = array(
                        'datakwitansi_id' => $row->datakwitansi_id,
                        'tanggal' => $row->tanggal,
                        'no_polisi' => $row->no_polisi,
                        'nama_driver' => $row->nama_driver,
                        'lokasispbg' => $row->namaspbg,
                        'tekananawal' => $row->tekananawal,
                        'tekananakhir' => $row->tekananakhir,
                        'totalisatorawal' => $row->totalisatorawal,
                        'totalisatorakhir' => $row->totalisatorakhir,
                        'hargasatuan' => $row->hargasatuan,
                        'volumegas' => $row->volumegas,
                        'total' => $row->total,
                  );
            }
            echo json_encode($hasil);
      }

      public function print($id)
      {
        // $getData =  $this->Suratjalan_customer_model->ubah($id);
        // var_dump($getData);
        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Suratjalan_customer_model->ubah($id),
        ); 
        $this->load->view('aadmin_item/suratjalan_customer/print', $data);
      }





}



