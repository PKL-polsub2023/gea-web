<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_profit_lost extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->library('Pdf');
		$this->load->model('Laporan_Profit_Lost_Model');
	}

	public function index()
	{

        // $data = array( 
        //     'databyjurnal'				=> $this->Laporan_Profit_Lost_Model->databyjurnal(),		
        // );      

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/laporan_profit_lost/index');
        $this->load->view('layout/footer');
	}

	function cetakpdf(){      
        
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('LAPORAN PROFIT & LOST');
        $pdf->SetFont('times', '', 11);
        
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  

		$pdf->setMargins(17, 3, 17);
        
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 064', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->AddPage();          

        //$no_jurnal  = $this->input->post('no_jurnal');
        

        $tgl_awal   = $this->input->post('tgl_awal');
        $tgl_akhir  = $this->input->post('tgl_akhir'); 


        $totdebit = $this->Laporan_Profit_Lost_Model->totaldebit();   
        $totkredit = $this->Laporan_Profit_Lost_Model->totalkredit(); 
        $periode = $this->Laporan_Profit_Lost_Model->periode($tgl_awal,$tgl_akhir);
       
        
                    $html = '
                    <p align="center"><u><b><font size="14">LAPORAN PROFIT & LOST</b></u></font>
                    <br><br>
                    <font size="10">PERIODE: '.$periode.'</font></p>
                    

             
                    
                    <table style="border-collapse: collapse; width: 100%;" border="1">
                        <tbody>
                        <tr style="background-color: #87cefa; height: 18px;">
                        <td style="width: 25%; text-align: center;">Kode Akun</td>
                        <td style="width: 25%; text-align: center;">Nama Akun</td>
                        <td style="width: 25%; text-align: center;">Debit</td>
                        <td style="width: 25%;">Kredit</td>
                        </tr>
                        <tr>
                        <td style="width: 25%;">&nbsp;</td>
                        <td style="width: 25%;">&nbsp;</td>
                        <td style="width: 25%;">&nbsp;</td>
                        <td style="width: 25%;">&nbsp;</td>
                        </tr>
                        <tr>
                        <td style="width: 25%;">&nbsp;</td>
                        <td style="width: 25%; text-align: center;">TOTAL</td>
                        <td style="width: 25%;">&nbsp;</td>
                        <td style="width: 25%;">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>';
                    
                        

                
                

                    
            
                    $pdf->writeHTML($html, true, true, true, false, '');
                    
                    $pdf->lastPage();
            
                    ;
                            
            
                    //$pdf->writeHTML($html, true, false, true, false, '');
                    $pdf->Output('Laporan Entry Jurnal.pdf', 'I');
    }












    public function labarugi_view()
	{
		# code untuk menampilkan hasil laba rugi
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$yearFromDate = date('Y', strtotime($fromDate));
		$data['periode'] = $yearFromDate;
		$data['subjudul'] = date('d M Y', strtotime($fromDate)) . ' sampai dengan ' . date('d M Y', strtotime($toDate));

		// mengambil data kode dari mastercoa
		$kode = [];
		$data_kode = $this->Laporan_Profit_Lost_Model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_Profit_Lost_Model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_Profit_Lost_Model->getdataBukuBesar($fromDate, $toDate, $kode);
		$this->load->view('laporan/laba-rugi-view', $data);
	}

	public function labarugi_pdf()
	{
		$fromDate = $this->uri->segment(3);
		$toDate = $this->uri->segment(4);
		
		if($fromDate == false && $toDate == false){
			show_404();
		}
		
		$yearFromDate = date('Y', strtotime($fromDate));
		$data['periode'] = $yearFromDate;
		$data['subjudul'] = date('d M Y', strtotime($fromDate)) . ' sampai dengan ' . date('d M Y', strtotime($toDate));

		// mengambil data kode dari mastercoa
		$kode = [];
		$data_kode = $this->Laporan_Profit_Lost_Model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_Profit_Lost_Model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_Profit_Lost_Model->getdataBukuBesar($fromDate, $toDate, $kode);
		$this->load->view('laporan/laba-rugi-pdf', $data);
	}








}

	

