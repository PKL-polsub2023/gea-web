<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_customer extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->library('Pdf');
		$this->load->model('Laporan_Customer_Model');
	}

	public function index()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/laporan_customer/index');
        $this->load->view('layout/footer');
	}

	function cetakpdf(){      
        
        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('', 'B', 14);
        $pdf->Cell(277, 10, "Laporan Customer", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(20, 8, "No", 1, 0, 'C');
        $pdf->Cell(60, 8, "NIK", 1, 0, 'C');
        $pdf->Cell(60, 8, "Nama Customer", 1, 0, 'C');
        $pdf->Cell(77, 8, "Bidang", 1, 0, 'C');
		$pdf->Cell(60, 8, "Email", 1, 1, 'C');
        $pdf->SetFont('', '', 12);        
       

        $id = $this->uri->segment(3);
            //$SuratId = 81;
            $jenis = 1;
            //$SuratId = $this->Suketusaha_Model->selectOneRequest($idRequest);
			$no = 0;
            $ById = $this->Laporan_Customer_Model->cetakpdf($jenis);
            foreach ($ById as $row) 
                {
					$no++;
					$pdf->Cell(20,8,$no,1,0, 'C');
					$pdf->Cell(60,8,$row->nik,1,0);
					$pdf->Cell(60,8,$row->nama_cust,1,0);
					$pdf->Cell(77,8,$row->bidang,1,0);
					$pdf->Cell(60,8,$row->email,1,1);
				}  
       
		$pdf->SetFont('', 'B', 10); 
        $pdf->Output('Laporan Customer.pdf'); 
    }
}

	

