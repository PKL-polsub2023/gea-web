<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_Account_Ledger extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->library('Pdf');
		$this->load->model('Laporan_Account_Ledger_Model');
	}

	public function index()
	{

        // $data = array( 
        //     'databyjurnal'				=> $this->Laporan_Account_Ledger_Model->databyjurnal(),		
        //     'datarekening'				=> $this->Laporan_Account_Ledger_Model->datarekening(),	
        // );      

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/laporan_account_ledger/index');
        $this->load->view('layout/footer');
	}




    public function view_data()
	{
		        $tgl_awal = $this->input->post('tgl_awal');
                $tgl_akhir = $this->input->post('tgl_akhir');               
                $no_rek = $this->input->post('no_rek');
                
			if(!empty($no_rek)){

                
                
                $d['no_rek'] = $no_rek;
                
                
                $nama_rek = $this->Laporan_Account_Ledger_Model->CariNamaRek($no_rek);
                
                $text = "select c.no_jurnal,b.tanggal,b.keterangan,a.kode,a.nama,c.debit,c.kredit from dt_mastercoa a, dt_jurnal_masuk b, dt_jurnal_masuk_detail c 
                where a.mastercoa_id=c.mastercoa_id and a.kode='$no_rek' and b.tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' and b.no_jurnal=c.no_jurnal and b.tipe_jurnal in(1,2) group by c.no_jurnal
                ";
                $d['data'] = $this->Laporan_Account_Ledger_Model->manualQuery($text);
			
            }else{


                $tgl_awal = $this->input->post('tgl_awal');
                $tgl_akhir = $this->input->post('tgl_akhir');
                //$no_rek = $this->input->post('no_rek');
                
                $d['no_rek'] = $no_rek;
                
                
                $nama_rek = $this->Laporan_Account_Ledger_Model->CariNamaRek($no_rek);
                
                $text = "select c.no_jurnal,b.tanggal,b.keterangan,a.kode,a.nama,c.debit,c.kredit from dt_mastercoa a, dt_jurnal_masuk b, dt_jurnal_masuk_detail c 
                where a.mastercoa_id=c.mastercoa_id and b.tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
                and b.tipe_jurnal in(1,2) and b.no_jurnal=c.no_jurnal order by a.kode asc 
                ";
                $d['data'] = $this->Laporan_Account_Ledger_Model->manualQuery($text);


            }
            $this->load->view('admin/laporan_account_ledger/view_data',$d);
        
		
	}




	function cetakpdf(){   
        
        
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('LAPORAN ACCOUNT LEDGER');
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
          
        
        
        



                    $html = '
                    <p align="center"><u><b><font size="14">LAPORAN ACCOUNT LEDGER</b></u></font>
                    <br><br>
                    <font size="10">PERIODE: </font></p> ';
                    




                 
                    $saldo = 0;
                    $dr_sa = $this->Laporan_Account_Ledger_Model->dr_sa2();
                    $kr_sa = $this->Laporan_Account_Ledger_Model->kr_sa2();
                    $saldo = $dr_sa-$kr_sa;            
                    $tgl_awal   = '2022-01-01';
                    $tgl_akhir  = '2023-03-25'; 
                    $jml_dr=0;
                    $jml_kr=0;
                    $no =1;


                    $text = "select c.no_jurnal,b.tanggal,b.keterangan,a.kode,a.nama,c.debit,c.kredit from dt_mastercoa a, dt_jurnal_masuk b, dt_jurnal_masuk_detail c 
                            where a.mastercoa_id=c.mastercoa_id and b.tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
                            and b.tipe_jurnal in(1,2) and b.no_jurnal=c.no_jurnal order by a.kode asc 
                            ";
                    //$d['data'] = $this->Laporan_Account_Ledger_Model->manualQuery($text);
                    $data = array( 
                        'bukajalan'				=> $this->Laporan_Account_Ledger_Model->manualQuery($text),		
                    );  


                    foreach($data['bukajalan']->result_array() as $db){  
                    //$tgl = $this->Laporan_Account_Ledger_Model->tgl_indo($db['tgl_jurnal']);
                    $nama_rek = $this->Laporan_Account_Ledger_Model->CariNamaRek($db['kode']);
                    
                    if($db['kode'] == '101' or $db['kode'] == '102' or $db['kode'] == '103' or $db['kode'] == '104' or $db['kode'] == '105' or $db['kode'] == '106' or $db['kode'] == '107'
                    or $db['kode'] == '121' or $db['kode'] == '122' or $db['kode'] == '123' or $db['kode'] == '124' or $db['kode'] == '125' or $db['kode'] == '126' or $db['kode'] == '127'
                    or $db['kode'] == '501' or $db['kode'] == '502' or $db['kode'] == '503' or $db['kode'] == '504' or $db['kode'] == '505' or $db['kode'] == '506' or $db['kode'] == '507'){

                        $saldo = $saldo+$db['debit']-$db['kredit'];
                    }else{
                        $saldo = $saldo-$db['debit']+$db['kredit'];
                    }

                    

                    
                    $html = '

                    <table style="border-collapse: collapse; width: 100%;" border="1">
                        <tbody>
                        <tr>
                            <td style="width: 16.6667%;">Nama Akun</td>
                            <td style="width: 16.6667%;">'.$db['nama'].'</td>
                            <td style="width: 16.6667%;">&nbsp;</td>
                            <td style="width: 16.6667%;">&nbsp;</td>
                            <td style="width: 16.6667%;">No Akun</td>
                            <td style="width: 16.6667%;">'.$db['kode'].'</td>
                        </tr>
                        <tr style="background-color: #6495ED;color:#fff">
                            <td style="width: 16.6667%;">Tanggal</td>
                            <td style="width: 16.6667%;">Keterangan</td>
                            <td style="width: 16.6667%;">No Jurnal</td>
                            <td style="width: 16.6667%;">Debit</td>
                            <td style="width: 16.6667%;">Kredit</td>
                            <td style="width: 16.6667%;">Saldo</td>
                        </tr>
                        <tr>
                            <td style="width: 16.6667%;">'.$db['tanggal'].'</td>
                            <td style="width: 16.6667%;">'.$db['keterangan'].'</td>
                            <td style="width: 16.6667%;">'.$db['no_jurnal'].'</td>
                            <td style="width: 16.6667%;">'.$db['debit'].'</td>
                            <td style="width: 16.6667%;">'.$db['kredit'].'</td>
                            <td style="width: 16.6667%;">'.number_format($saldo).'</td>
                        </tr>
                        </tbody>
                    </table>';
                                
                }            
                                    	
                                        
                       

                    
            
                    $pdf->writeHTML($html, true, true, true, false, '');
                    
                    $pdf->lastPage();
            
                    ;
                            
            
                    //$pdf->writeHTML($html, true, false, true, false, '');
                    $pdf->Output('Laporan Neraca.pdf', 'I');
                
    }









    public function bukubesar_view()
	{
		# code untuk menampilkan data dari bukubesar
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$yearFromDate = date('Y', strtotime($fromDate));
		$data['periode'] = $yearFromDate;
		$data['subjudul'] = date('d F Y', strtotime($fromDate)) . ' sampai dengan ' . date('d F Y', strtotime($toDate));

		// mengambil data kode dari mastercoa
		$kode = [];
		$data_kode = $this->Laporan_Account_Ledger_Model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);
		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_Account_Ledger_Model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_Account_Ledger_Model->getdataBukuBesar($fromDate, $toDate, $kode);
		$this->load->view('laporan/buku-besar-view', $data);
	}

	public function bukubesar_pdf()
	{			
		$fromDate = $this->uri->segment(3);
		$toDate = $this->uri->segment(4);
		
		if($fromDate == false && $toDate == false){
			show_404();
		}

		$yearFromDate = date('Y', strtotime($fromDate));
		$data['periode'] = $yearFromDate;
		$data['subjudul'] = date('d F Y', strtotime($fromDate)) . ' sampai dengan ' . date('d F Y', strtotime($toDate));

		// mengambil data kode dari mastercoa
		$kode = [];
		$data_kode = $this->Laporan_Account_Ledger_Model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);
		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_Account_Ledger_Model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_Account_Ledger_Model->getdataBukuBesar($fromDate, $toDate, $kode);

		$this->load->view('laporan/buku-besar-pdf',$data);
	}








}

	

