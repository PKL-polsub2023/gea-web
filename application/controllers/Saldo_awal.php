<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_awal extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Saldo_Awal_Model');
        $this->load->model('Saldo_Awal_Detail_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        
        $data = array( 
            'datacoa'			=> $this->Saldo_Awal_Model->datacoa(),
            'datasaldoawal'		=> $this->Saldo_Awal_Model->Lihatsaldoawal()
        );       
       

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/saldo_awal/index',$data);
        $this->load->view('layout/footer');
	} 

    public function tambah()
	{

        $data = array( 
            'datacoa'				=> $this->Saldo_Awal_Model->datacoa(),		
        );      
       
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/saldo_awal/tambah',$data);
        $this->load->view('layout/footer'); 
	} 

    function get_namaakun(){
        $id=$this->input->post('id');
        $data=$this->Saldo_Awal_Model->get_namaakun($id);
        echo json_encode($data);
    }

    public function simpan()
	{      
      
        $data=array(
                    'periode'       => $this->input->post('periode'),
                    'mastercoa_id'  => $this->input->post('mastercoa_id'),
                    'saldo_normal'  => $this->input->post('saldo_normal'),
                    'debit'         => $this->input->post('debit'),
                    'kredit'        => $this->input->post('kredit'),
                    'status'        => $this->input->post('status'),
                    'saldo_akhir'   => 0,
                );      
            
        $this->db->insert('dt_saldo_awal', $data);             
        
		redirect('saldo_awal');
	}


    public function hapus($saldoawal){
		if($this->Saldo_Awal_Model->hapussaldoawal($saldoawal)){
			$this->session->set_flashdata('success', 'Jurnal <strong>Berhasil</strong> Dihapus!');
			redirect('saldo_awal');
		} else {
			$this->session->set_flashdata('error', 'Jurnal <strong>Gagal</strong> Dihapus!');
			redirect('saldo_awal');
		}
	}

     function getakun(){
	     
        $id = $this->input->post('id',TRUE);
        $data = $this->Saldo_Awal_Model->getakun($id);
        echo json_encode($data);
     }

     public function tambahjurnal(){
		$this->load->view('admin/saldo_awal/proses');
	}



    public function proses_tambah(){
		$jumlah_saldoawal = count($this->input->post('mastercoa_id_hidden'));
		
		$data_saldoawal = [       
            //'mastercoa_id' => $this->input->post('mastercoa_id'),    
			'no_jurnal' => $this->input->post('no_jurnal'),
			'tanggal' => $this->input->post('tanggal'),
			'keterangan' => $this->input->post('keterangan'),
			'tot_debit' => $this->input->post('totaldebit_hidden'),
            'tot_kredit' => $this->input->post('totalkredit_hidden'),
		];

		$data_detail_saldoawal = [];

		for ($i=0; $i < $jumlah_saldoawal ; $i++) { 
			array_push(
            $data_detail_saldoawal, ['mastercoa_id' => $this->input->post('mastercoa_id_hidden')[$i]]);
			$data_detail_saldoawal[$i]['no_jurnal'] = $this->input->post('no_jurnal');
			$data_detail_saldoawal[$i]['debit'] = $this->input->post('debit_hidden')[$i];
            $data_detail_saldoawal[$i]['kredit'] = $this->input->post('kredit_hidden')[$i];
			//$data_detail_saldoawal[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if($this->Saldo_Awal_Model->tambah($data_saldoawal) && $this->Saldo_Awal_Detail_Model->tambah($data_detail_saldoawal)){
			for ($i=0; $i < $jumlah_saldoawal ; $i++) { 
				($data_saldoawal = $this->input->post('totaldebit_hidden') == $this->input->post('totalkredit_hidden')) or die('Data Jurnal Tidak Balance');
			}
			$this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');
			redirect('saldo_awal');
		} else {
			$this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');
			redirect('saldo_awal');
		}       

	}


    public function ubah($saldoawal_id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Saldo_Awal_Model->ubah($saldoawal_id),
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/saldo_awal/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $saldoawal_id =  $this->input->post("saldoawal_id");

		$data = array(
            'saldoawal_id'  => $this->input->post('saldoawal_id'),
            'periode'       => $this->input->post('periode'),
            //'mastercoa_id'  => $this->input->post('mastercoa_id'),
            'saldo_normal'  => $this->input->post('saldo_normal'),
            'debit'         => $this->input->post('debit'),
            'kredit'        => $this->input->post('kredit'),
            //'status'        => $this->input->post('status'),
		);
		$this->db->where("saldoawal_id", $saldoawal_id); // ubah id dan postnya
		$this->db->update("dt_saldo_awal", $data);
		redirect('saldo_awal');
	}





}



