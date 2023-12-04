<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_balik extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_Model');
		$this->load->model('Jurnal_Balik_Model');
        $this->load->model('Jurnal_Balik_Detail_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datajurnalbalik'		=> $this->Jurnal_Balik_Model->Lihatjurnalbalik()
        );       

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/jurnal_balik/index',$data);
        $this->load->view('layout/footer');
	} 

    public function tambah()
	{

        $data = array( 
            'datacoa'				=> $this->Jurnal_Balik_Model->datacoa(),		
        );      
       
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/jurnal_balik/tambah',$data);
        $this->load->view('layout/footer'); 
	} 

    function get_namaakun(){
        $id=$this->input->post('id');
        $data=$this->Jurnal_Balik_Model->get_namaakun($id);
        echo json_encode($data);
    }

    public function simpan()
	{      

        $post = $this->input->post();
        for ($i = 0; $i < count($post['debit']); $i++) 
        {
        $data=array(
                    'no_jurnal' => $this->input->post('no_jurnal'),
                    'tanggal' => $this->input->post('tanggal'),
                    'keterangan' => $this->input->post('keterangan'),
                    'mastercoa_id' => $post['akunid'][$i],
                    'debit' => $post['debit'][$i],
                    'kredit' => $post['kredit'][$i],
                    'tot_debit' => $this->input->post('tot_debit'),
                    'tot_kredit' => $this->input->post('tot_kredit'),
                );          
        
            }
        $this->db->insert('dt_jurnal_balik', $data);             
        
		redirect('jurnal_balik');
	}


    public function hapus($no_jurnal){
		if($this->Jurnal_Balik_Model->hapusjurnal($no_jurnal) && $this->Jurnal_Balik_Detail_Model->hapusjurnaldetail($no_jurnal)){
			$this->session->set_flashdata('success', 'Jurnal <strong>Berhasil</strong> Dihapus!');
			redirect('jurnal_balik');
		} else {
			$this->session->set_flashdata('error', 'Jurnal <strong>Gagal</strong> Dihapus!');
			redirect('jurnal_balik');
		}
	}

     function getakun(){
	     
        $id = $this->input->post('id',TRUE);
        $data = $this->Jurnal_Balik_Model->getakun($id);
        echo json_encode($data);
     }

     public function tambahjurnal(){
		$this->load->view('admin/jurnal_balik/proses');
	}



    // public function cekprosestambah(){
	// 	$this->data['title'] = 'Tambah Jurnal';
	// 	$this->data['datacoa'] = $this->Jurnal_Balik_Model->lihat_stok();

	// 	$this->load->view('admin/jurnal_balik/tambah', $this->data);
	// }



    public function proses_tambah(){
		$jumlah_jurnalmasuk = count($this->input->post('mastercoa_id_hidden'));
		
		$data_jurnalmasuk = [       
            //'mastercoa_id' => $this->input->post('mastercoa_id'),    
			'no_jurnal' => $this->input->post('no_jurnal'),
			'tanggal' => $this->input->post('tanggal'),
			'keterangan' => $this->input->post('keterangan'),
			'tot_debit' => $this->input->post('totaldebit_hidden'),
            'tot_kredit' => $this->input->post('totalkredit_hidden'),
		];

		$data_detail_jurnalmasuk = [];

		for ($i=0; $i < $jumlah_jurnalmasuk ; $i++) { 
			array_push(
            $data_detail_jurnalmasuk, ['mastercoa_id' => $this->input->post('mastercoa_id_hidden')[$i]]);
			$data_detail_jurnalmasuk[$i]['no_jurnal'] = $this->input->post('no_jurnal');
			$data_detail_jurnalmasuk[$i]['debit'] = $this->input->post('debit_hidden')[$i];
            $data_detail_jurnalmasuk[$i]['kredit'] = $this->input->post('kredit_hidden')[$i];
			//$data_detail_jurnalmasuk[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if($this->Jurnal_Balik_Model->tambah($data_jurnalmasuk) && $this->Jurnal_Balik_Detail_Model->tambah($data_detail_jurnalmasuk)){
			for ($i=0; $i < $jumlah_jurnalmasuk ; $i++) { 
				($data_jurnalmasuk = $this->input->post('totaldebit_hidden') == $this->input->post('totalkredit_hidden')) or die('Data Jurnal Tidak Balance');
			}
			$this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');
			redirect('jurnal_balik');
		} else {
			$this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');
			redirect('jurnal_balik');
		}       


	}


    public function detail($no_jurnal){
		//$this->data['title']                = 'Detail Jurnal Masuk';
		//$this->data['jurnalmasuk']          = $this->Jurnal_Balik_Model->lihat_no_jurnal($no_jurnal);
		//$this->data['detail_jurnal_balik']  = $this->Jurnal_Balik_Model->lihat_no_jurnal($no_jurnal);
		//$this->data['no']                   = 1;



        $data = array( 
            'jurnalmasuk'               => $this->Jurnal_Balik_Model->lihat_no_jurnal($no_jurnal),
            'detail_jurnal_balik'		=> $this->Jurnal_Balik_Model->lihat_detail_jurnal($no_jurnal),
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/jurnal_balik/detail', $data);
        $this->load->view('layout/footer');
	}

    public function edit($no_jurnal)
    {
        $no_jurnal = urldecode($no_jurnal);
        $data = [
            'datacoa'=> $this->Jurnal_Balik_Model->datacoa(),
            'jurnal' => $this->General_Model->getJurnalByNoJurnal('dt_jurnal_balik', $no_jurnal),
            'detail' => $this->General_Model->getJurnalDetailByNoJurnal('dt_jurnal_balik', 'dt_jurnal_balik_detail', $no_jurnal),
        ];
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/jurnal_balik/edit', $data);
        $this->load->view('layout/footer');
    }

    public function update($no_jurnal)
    {
        if (count($this->input->post('mastercoa_id_hidden')) < 1)
            throw new Exception("Invalid data jurnal");

        if ($this->input->post('totaldebit_hidden') !== $this->input->post('totalkredit_hidden'))
            throw new Exception("Data jurnal tidak balance");

        // menyusun data detail
        $details = [];
        foreach ($this->input->post('mastercoa_id_hidden') as $key => $coa) {
            $details[] = [
                'mastercoa_id' => $coa,
                'no_jurnal' => $this->input->post('no_jurnal'),
                'debit' => $this->input->post('debit_hidden')[$key],
                'kredit' => $this->input->post('kredit_hidden')[$key],
            ];
        }

        $this->db->trans_begin();
        try {
            // update jurnal masuk
            $this->General_Model->update('dt_jurnal_balik', 'jurnalbalik_id', $this->input->post('id'), [
                'no_jurnal' => $this->input->post('no_jurnal'),
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('keterangan'),
                'tot_debit' => $this->input->post('totaldebit_hidden'),
                'tot_kredit' => $this->input->post('totalkredit_hidden')
            ]);

            $this->General_Model->updateJurnalDetail('dt_jurnal_balik_detail', $this->input->post('no_jurnal'), $details);

        } catch (\Exception $e) {
            $this->db->trans_rollback();

            $this->session->set_flashdata('error', $e->getMessage());

            redirect('jurnal_balik');
        }
        $this->db->trans_commit();

        $this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');

        redirect('jurnal_balik');
    }

}



