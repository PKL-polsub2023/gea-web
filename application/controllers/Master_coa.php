<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_coa extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
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
            'datamastercoa'		=> $this->Master_COA_Model->Lihatmastercoa()
        );
        $role = $this->session->userdata('role');

        if($role == "akuntan")
        {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/mastercoa/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/mastercoa/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 


    public function tambah()
	{
        $data = array( 
            'datakelompokakun'		=> $this->Master_COA_Model->datakelompokakun()
        ); 
        
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastercoa/tambah',$data);
        $this->load->view('layout/footer'); 
	} 

    public function simpan()
	{      
      
        $parent_id = $this->input->post("parent_id");
        if($parent_id == ""){
            $parent_id = NULL;
        }
        $data=array(
                    'kode'                  => $this->input->post('kode'),
                    'nama'                  => $this->input->post('nama'),
                    'id_kelompokakun'       => $this->input->post('id_kelompokakun'),
                    'parent_id'             => $parent_id,
                    'bank'       => $this->input->post('bank'),
                    'norekening'       => $this->input->post('norekening'),
                    'atasnama'       => $this->input->post('atasnama'),
                );      
            
        $this->db->insert('dt_mastercoa', $data);             
        
		redirect('master_coa');
	}




    public function ubah($mastercoa_id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Master_COA_Model->ubah($mastercoa_id),
            'datakelompokakun'	=> $this->Master_COA_Model->datakelompokakun()
        ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/mastercoa/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $mastercoa_id =  $this->input->post("mastercoa_id");

        $parent_id = $this->input->post("parent_id");
        if($parent_id == ""){
            $parent_id = NULL;
        }
		$data = array(
            'mastercoa_id'          => $this->input->post('mastercoa_id'),           
            'kode'                  => $this->input->post('kode'),
            'nama'                  => $this->input->post('nama'),
            'id_kelompokakun'       => $this->input->post('id_kelompokakun'),
            'parent_id'             => $parent_id,
            'bank'       => $this->input->post('bank'),
            'norekening'       => $this->input->post('norekening'),
            'atasnama'       => $this->input->post('atasnama'),
		);
		$this->db->where("mastercoa_id", $mastercoa_id); // ubah id dan postnya
		$this->db->update("dt_mastercoa", $data);
		redirect('master_coa');
	}

    public function hapus($mastercoa_id){
		if($this->Master_COA_Model->hapuscoa($mastercoa_id)){
			$this->session->set_flashdata('success', 'COA <strong>Berhasil</strong> Dihapus!');
			redirect('master_coa');
		} else {
			$this->session->set_flashdata('error', 'COA <strong>Gagal</strong> Dihapus!');
			redirect('master_coa');
		}
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

            $data = [
                "id_kelompokakun"=> $rowData[0][1],
                "kode"=> $rowData[0][2],
                "nama"=> $rowData[0][3],
            ];

                
                    $data = [
                        
                        'id_kelompokakun' => $data["id_kelompokakun"],
                        'kode' => $data["kode"],
                        'nama' => $data["nama"],
									
                    ];
                    // $this->db->set('waktu_entri', 'NOW()', FALSE);
                    $query = $this->db->insert("dt_mastercoa", $data);
                    
                    $berhasil++;
                
            
        }

        unlink($inputFileName);
        $this->alert('<strong>Success: </strong>
            <br>Proses import berhasil, data yang berhasil masuk sebanyak <strong>'.$berhasil.' baris</strong>.
        ', 'alert-success', 'master_coa');
        
        
    }





}



