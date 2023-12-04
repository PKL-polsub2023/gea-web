<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup_restore extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('Backup_Restore_Model');
	}

	public function index()
	{

		$data = array( 
            'tabel'		=> $this->Backup_Restore_Model->tampiltabel()
        );

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/backup_restore/index',$data);
        $this->load->view('layout/footer');
	}


	public function menubackuprestore()
    {
        $this->load->model('nama_model');
        $data['tabel'] = $this->nama_model->tampiltabel(); //AMBIL DATA TABEL-TABEL
        $this->load->view('nama_view',$data);
    }

  public function backup()
    {

      $tabel = $this->input->post('tabel');
      $this->load->dbutil();
      $prefs = array(    
              'tables'      => array($tabel),
                    'format'      => 'zip',            
                    'filename'    => 'my_db_backup.sql'
                  );
      $backup =& $this->dbutil->backup($prefs);
      $db_name = 'backup-on-'. $tabel . '-' . date("d-m-Y") .'.zip'; //NAMAFILENYA
      $save = 'pathtobkfolder/'.$db_name;
      $this->load->helper('file');
      write_file($save, $backup);
      $this->load->helper('download');
      force_download($db_name, $backup);
    }

  public function restore()   
    {

        $this->load->helper('file');       
        $config['upload_path']="./backupdb/";
        $config['allowed_types']="sql|x-sql";
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload("datafile")){
         $error = array('error' => $this->upload->display_errors());
         echo "GAGAL UPLOAD";
         var_dump($error);
         exit();
        }

        $file = $this->upload->data();  //DIUPLOAD DULU KE DIREKTORI assets/database/
        $restoreupload=$file['file_name'];
                   
          $isi_file = file_get_contents('./backupdb/' . $restoreupload); //PANGGIL FILE YANG TERUPLOAD
          $string_query = rtrim( $isi_file, "\n;" );
          $array_query = explode(";", $string_query);   //JALANKAN QUERY MERESTORE KEDATABASE
              foreach($array_query as $query)
              {
                    $this->db->query($query);
              }

          $path_to_file = './backupdb/' . $restoreupload;
            if(unlink($path_to_file)) {   // HAPUS FILE YANG TERUPLOAD
                 redirect('backup_restore');
            }
            else {
                 echo 'errors occured';
            }
       
    }

}
