<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_awal extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Saldo_Awal_Model');
        $this->load->model('Saldo_Awal_Detail_Model');
        $this->load->model('Master_COA_Model');
        $this->load->library('session');
	}

    function alert($alert, $alert_type, $url=NULL){
        $this->session->set_userdata('alert_error', $alert);
        $this->session->set_userdata('alert_error_type', $alert_type);		
        if(!empty($url)){redirect($url);};
    }

	public function index()
	{     
        
        $data = array( 
            'datacoa'			=> $this->Saldo_Awal_Model->datacoa(),
            'datasaldoawal'		=> $this->Saldo_Awal_Model->Lihatsaldoawal()
        );       
       
        $role = $this->session->userdata('role');
        
        if($role == "akuntan"){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/saldo_awal/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/saldo_awal/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
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


    function import(){
        $fileName = time().$_FILES['import_data']['name'];
     
        $config['upload_path'] = './_uploads/excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['remove_spaces'] = FALSE;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 10000;
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if(! $this->upload->do_upload('import_data') )
        $this->alert('<strong>Status : </strong><br>'.$this->upload->display_errors(), 'alert-danger', 'superuser/peserta');
        //echo $this->upload->display_errors();

        $media = $this->upload->data('import_data');
        $file = "./_uploads/excel/".$fileName;
        $inputFileName = $file;
        
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    
        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        $berhasil = 0;
        for ($row = 3; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            
            $get_coa = $this->Master_COA_Model->get_coa($rowData[0][2]);
            $mastercoa_id = $get_coa['mastercoa_id'];

                $data = [
                    "mastercoa_id"=> $mastercoa_id,
                    "saldo_normal"=> $rowData[0][4],
                    "uang"=> $rowData[0][4],
                    "periode" => $rowData[0][6],
                ];

                    if($rowData[0][5] == 1)
                    {
                        $data = [     
                            'mastercoa_id' => $data["mastercoa_id"],
                            'saldo_normal' => $data["saldo_normal"],
                            'debit' => $data["uang"],	
                            'kredit' => 0.00,
                            'periode' => $data["periode"],		
                        ];
                    }else{
                        $data = [     
                            'mastercoa_id' => $data["mastercoa_id"],
                            'saldo_normal' => $data["saldo_normal"],
                            'debit' => 0.00,
                            'kredit' => $data["uang"],			
                            'periode' => $data["periode"],
                        ];
                    }

               
                   
                    // // $this->db->set('waktu_entri', 'NOW()', FALSE);
                    $query = $this->db->insert("dt_saldo_awal", $data);
                    
                    $berhasil++;
                
            
        }

        // unlink($inputFileName);
        // $this->alert('<strong>Success: </strong>
        //     <br>Proses import berhasil, data yang berhasil masuk sebanyak <strong>'.$berhasil.' baris</strong>.
        // ', 'alert-success', 'master_coa');
        
        
    }






}



