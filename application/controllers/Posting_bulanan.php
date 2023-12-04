<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting_bulanan extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->library('Pdf');
		$this->load->model('Posting_Bulanan_Model');
	}

	public function index()
	{

        $data = array( 
            'databyjurnal'			=> $this->Posting_Bulanan_Model->databyjurnal(),
            'datajurnalmasuk'		=> $this->Posting_Bulanan_Model->Lihatjurnalmasuk(),	
            'cekjurnalposting'		=> $this->Posting_Bulanan_Model->cekjurnalposting()
        );      

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/posting_bulanan/index',$data);
        $this->load->view('layout/footer');
	}

	function cetakpdf(){      
        
        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('', 'B', 14);
        $pdf->Cell(277, 10, "Laporan Entry", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(20, 8, "No", 1, 0, 'C');
        $pdf->Cell(60, 8, "No Jurnal", 1, 0, 'C');
        $pdf->Cell(60, 8, "Tanggal", 1, 0, 'C');
        $pdf->Cell(77, 8, "Total Debit", 1, 0, 'C');
		$pdf->Cell(60, 8, "Total Kredit", 1, 1, 'C');
        $pdf->SetFont('', '', 12);        
       

        $no_jurnal  = $this->input->post('no_jurnal');
        $tgl_awal   = $this->input->post('tglawal');
        $tgl_akhir  = $this->input->post('tglakhir');
            
          
            //$SuratId = $this->Suketusaha_Model->selectOneRequest($idRequest);
			$no = 0;
            $ById = $this->Posting_Bulanan_Model->cetakpdf($no_jurnal,$tgl_awal,$tgl_akhir);
            foreach ($ById as $row) 
                {
					$no++;
					$pdf->Cell(20,8,$no,1,0, 'C');
					$pdf->Cell(60,8,$row->no_jurnal,1,0);
					$pdf->Cell(60,8,$row->tanggal,1,0);
					$pdf->Cell(77,8,$row->tot_debit,1,0);
					$pdf->Cell(60,8,$row->tot_kredit,1,1);
				}  
       
		$pdf->SetFont('', 'B', 10); 
        $pdf->Output('Laporan Entry.pdf'); 
    }



    public function simpanposting(){
        // Ambil data yang dikirim dari form
        $jurnalmasuk_id = $_POST['jurnalmasuk_id']; // Ambil data no_jurnal dan masukkan ke variabel no_jurnal
        $tgl_awal       = $_POST['tgl_awal'];
        $tgl_akhir      = $_POST['tgl_akhir'];
        //$status_postingan_jurnal = $_POST['status_postingan_jurnal']; 
        //$no_jurnal = $_POST['no_jurnal']; // Ambil data no_jurnal dan masukkan ke variabel no_jurnal
        
        $ambil = $this->Posting_Bulanan_Model->ambildata($tgl_awal,$tgl_akhir);
        $tgl_awal1      = $ambil['tgl_awal'] ;
        $tgl_akhir1     = $ambil['tgl_akhir'] ;

        $data = array();
        
        $index = 0; // Set index array awal dengan 0
        foreach($jurnalmasuk_id as $datajurnalmasuk_id){ // Kita buat perulangan berdasarkan no_jurnal sampai data terakhir
          array_push($data, array(
            'jurnalmasuk_id'        =>$datajurnalmasuk_id,
            //'no_jurnal'             =>$no_jurnal[$index],  // Ambil dan set data nama sesuai index array dari $index
            //'telp'=>$telp[$index],  // Ambil dan set data telepon sesuai index array dari $index
            'status_posting'        =>1,
            'tgl_awal'              =>'2022-01-01',
            'tgl_akhir'             =>'2022-01-31',
            'tgl_posting'           => date("Y-m-d")

                    
          ));
          
          $index++;

        }      
        
        $sql = $this->Posting_Bulanan_Model->save_batch($data); // Panggil fungsi save_batch yang ada di model 

        $this->db->update('dt_jurnal_masuk', array("status_postingan_jurnal" => '1'));
        
        // Cek apakah query insert nya sukses atau gagal
        if($sql){ // Jika sukses
          echo "<script>alert('Data berhasil disimpan');window.location = '".base_url('posting_bulanan')."';</script>";
        }else{ // Jika gagal
          echo "<script>alert('Data gagal disimpan');window.location = '".base_url('posting_bulanan')."';</script>";
        }
     
        
      }




}

	

