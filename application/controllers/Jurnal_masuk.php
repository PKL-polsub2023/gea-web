<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_masuk extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_Model');
		$this->load->model('Jurnal_Masuk_Model');
        $this->load->model('Jurnal_Masuk_Detail_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datajurnalmasuk'		=> $this->Jurnal_Masuk_Model->Lihatjurnalmasuk()
        );       

        $role = $this->session->userdata('role');
        if($role == "akuntan")
        {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/jurnal_masuk/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/jurnal_masuk/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 

    public function tambah()
	{

        $data = array( 
            'datacoa'				=> $this->Jurnal_Masuk_Model->datacoa(),		
        );      
       
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/jurnal_masuk/tambah',$data);
        $this->load->view('layout/footer'); 
	} 

    function get_namaakun(){
        $id=$this->input->post('id');
        $data=$this->Jurnal_Masuk_Model->get_namaakun($id);
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
        $this->db->insert('dt_jurnal_masuk', $data);             
        
		redirect('jurnal_masuk');
	}


    public function hapus($no_jurnal){
		if($this->Jurnal_Masuk_Model->hapusjurnal($no_jurnal) && $this->Jurnal_Masuk_Detail_Model->hapusjurnaldetail($no_jurnal)){
			$this->session->set_flashdata('success', 'Jurnal <strong>Berhasil</strong> Dihapus!');
			redirect('jurnal_masuk');
		} else {
			$this->session->set_flashdata('error', 'Jurnal <strong>Gagal</strong> Dihapus!');
			redirect('jurnal_masuk');
		}
	}

     function getakun(){
	     
        $id = $this->input->post('id',TRUE);
        $data = $this->Jurnal_Masuk_Model->getakun($id);
        echo json_encode($data);
     }

     public function tambahjurnal(){
		$this->load->view('admin/jurnal_masuk/proses');
	}



    // public function cekprosestambah(){
	// 	$this->data['title'] = 'Tambah Jurnal';
	// 	$this->data['datacoa'] = $this->Jurnal_Masuk_Model->lihat_stok();

	// 	$this->load->view('admin/jurnal_masuk/tambah', $this->data);
	// }



    public function proses_tambah(){
		$jumlah_jurnalmasuk = count($this->input->post('mastercoa_id_hidden'));
        $jenis = "";
        if($this->input->post('jenis_transaksi') == 1){
            $jenis = "IN";
        }else if($this->input->post('jenis_transaksi') == 2){
            $jenis = "OUT";
        }
        
        $id = $this->db->query('SELECT jurnalmasuk_id FROM dt_jurnal_masuk ORDER BY jurnalmasuk_id DESC LIMIT 1');
        $id = $id->row()->jurnalmasuk_id + 1;

		$data_jurnalmasuk = [       
            //'mastercoa_id' => $this->input->post('mastercoa_id'),    
			// 'no_jurnal' => $this->input->post('no_jurnal'),
			'no_jurnal' => "GEA-" . $jenis ."-". date('Ym', strtotime($this->input->post('tanggal'))) ."-". $id,
			'tanggal' => $this->input->post('tanggal'),
			'keterangan' => $this->input->post('keterangan'),
			'tot_debit' => $this->input->post('totaldebit_hidden'),
            'tot_kredit' => $this->input->post('totalkredit_hidden'),
            
            'tipe_jurnal' => $this->input->post('jenis_transaksi'),
            'qty' => $this->input->post('qty'),
            'hargasatuan' => $this->input->post('hargasatuan'),
            'status' => $this->input->post('status'),
            //'tipe_jurnal' => 1,
		];

		$data_detail_jurnalmasuk = [];

		for ($i=0; $i < $jumlah_jurnalmasuk ; $i++) { 
			array_push(
            $data_detail_jurnalmasuk, ['mastercoa_id' => $this->input->post('mastercoa_id_hidden')[$i]]);
			$data_detail_jurnalmasuk[$i]['no_jurnal'] = "GEA-" . $jenis ."-". date('Ym', strtotime($this->input->post('tanggal'))) ."-". $id;
			$data_detail_jurnalmasuk[$i]['debit'] = $this->input->post('debit_hidden')[$i];
            $data_detail_jurnalmasuk[$i]['kredit'] = $this->input->post('kredit_hidden')[$i];
			//$data_detail_jurnalmasuk[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if($this->Jurnal_Masuk_Model->tambah($data_jurnalmasuk) && $this->Jurnal_Masuk_Detail_Model->tambah($data_detail_jurnalmasuk)){
			for ($i=0; $i < $jumlah_jurnalmasuk ; $i++) { 
				($data_jurnalmasuk = $this->input->post('totaldebit_hidden') == $this->input->post('totalkredit_hidden')) or die('Data Jurnal Tidak Balance');
			}
			$this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');
			redirect('jurnal_masuk');
		} else {
			$this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');
			redirect('jurnal_masuk');
		}       


	}


    public function detail($no_jurnal){
		//$this->data['title']                = 'Detail Jurnal Masuk';
		//$this->data['jurnalmasuk']          = $this->Jurnal_Masuk_Model->lihat_no_jurnal($no_jurnal);
		//$this->data['detail_jurnal_masuk']  = $this->Jurnal_Masuk_Model->lihat_no_jurnal($no_jurnal);
		//$this->data['no']                   = 1;


        $no_jurnal = urldecode($no_jurnal);
        $data = array( 
            'jurnalmasuk'               => $this->Jurnal_Masuk_Model->lihat_no_jurnal($no_jurnal),
            'detail_jurnal_masuk'		=> $this->Jurnal_Masuk_Model->lihat_detail_jurnal($no_jurnal),
        ); 
        
        $role = $this->session->userdata('role');
        if($role == "akuntan"){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/jurnal_masuk/detail', $data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/jurnal_masuk/detail', $data);
            $this->load->view('pimpinan/footer');
        }
       
	}

    public function edit($no_jurnal)
    {
        $no_jurnal = urldecode($no_jurnal);
        $data = [
            'datacoa'=> $this->Jurnal_Masuk_Model->datacoa(),
            'jurnal' => $this->Jurnal_Masuk_Model->getJurnal($no_jurnal),
            'detail' => $this->Jurnal_Masuk_Model->lihat_detail_jurnal($no_jurnal),
        ];
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/jurnal_masuk/edit', $data);
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
        $jenis = "";
        if($this->input->post('jenis_transaksi') == 1){
            $jenis = "IN";
        }else if($this->input->post('jenis_transaksi') == 2){
            $jenis = "OUT";
        }
        foreach ($this->input->post('mastercoa_id_hidden') as $key => $coa) {
            $details[] = [
                'mastercoa_id' => $coa,
                //'no_jurnal' => $this->input->post('no_jurnal'),
                'no_jurnal' => "GEA-" . $jenis ."-". date('Ym', strtotime($this->input->post('tanggal'))) ."-". $this->input->post('id'),
                'debit' => $this->input->post('debit_hidden')[$key],
                'kredit' => $this->input->post('kredit_hidden')[$key],
            ];
        }

        $this->db->trans_begin();
        try {
            // update jurnal masuk
            $dataupdate = [
                // 'no_jurnal' => $this->input->post('no_jurnal'),
                'no_jurnal' => "GEA-" . $jenis ."-". date('Ym', strtotime($this->input->post('tanggal'))) ."-". $this->input->post('id'),
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('keterangan'),
                'tot_debit' => $this->input->post('totaldebit_hidden'),
                'tot_kredit' => $this->input->post('totalkredit_hidden'),

                'tipe_jurnal' => $this->input->post('jenis_transaksi'),
                'qty' => $this->input->post('qty'),
                'hargasatuan' => $this->input->post('hargasatuan'),
                'status' => $this->input->post('status'),
                
            ];

            $this->db->where("jurnalmasuk_id", $this->input->post('id'));
	        $this->db->update("dt_jurnal_masuk", $dataupdate);

            $this->General_Model->updateJurnalDetail('dt_jurnal_masuk_detail', "GEA-" . $jenis ."-". date('Ym', strtotime($this->input->post('tanggal'))) ."-". $this->input->post('id'), $details);

        } catch (\Exception $e) {
            $this->db->trans_rollback();

            $this->session->set_flashdata('error', $e->getMessage());

            redirect('jurnal_masuk');
        }
        $this->db->trans_commit();

        $this->session->set_flashdata('success', 'Jurnal <strong>Masuk</strong> Berhasil Dibuat!');

        redirect('jurnal_masuk');
    }


    public function filter()
	{     
        $fromdate =  $this->input->post('fromdate');
        $todate =  $this->input->post('todate');
        $no_jurnal =  $this->input->post('no_jurnal');

        $data = array( 
            'datajurnalmasuk'		=> $this->Jurnal_Masuk_Model->Lihatjurnalmasuk_filter($no_jurnal, $fromdate, $todate)
        );   

        $role = $this->session->userdata('role');
        if($role == "akuntan")
        {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/jurnal_masuk/filter',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/jurnal_masuk/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 

}



