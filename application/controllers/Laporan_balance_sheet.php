<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Balance_Sheet extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
        $this->load->library('Pdf');
        //$this->load->helper('html');
		$this->load->model('Laporan_Balance_Sheet_Model');
		$this->load->library('session');
	}

	public function index()
	{

        // $data = array( 
        //     'databyjurnal'				=> $this->Laporan_Balance_Sheet_Model->databyjurnal(),		
        // );      
		$role = $this->session->userdata('role');
        if($role == "akuntan")
		{
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$this->load->view('admin/laporan_balance_sheet/index');
			$this->load->view('layout/footer');
		}else{
			$this->load->view('pimpinan/header');
			$this->load->view('pimpinan/sidebar');
			$this->load->view('pimpinan-content/laporan_balance_sheet/index');
			$this->load->view('pimpinan/footer');
		}
		
	}

	function cetakpdf(){   
        
        
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('LAPORAN NERACA');
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
        $tgl_awal   = $this->input->post('tglawal');
        $tgl_akhir  = $this->input->post('tglakhir');   
            

                    $html = '
                    <p align="center"><u><b><font size="14">LAPORAN NERACA</b></u></font>
                    <br><br>
                    <font size="10">PERIODE: </font></p>
                    

                    <table style="border-collapse: collapse; width: 100%; height: 54px;" border="1">
                    <tbody>
                    <tr style="height: 18px;">
                    <td style="width: 50.0001%; text-align: center; height: 18px;font-size:13px" colspan="3"><strong>AKTIVA</strong></td>
                    <td style="width: 50.0001%; height: 18px; text-align: center;font-size:13px" colspan="3"><strong>PASSIVA</strong></td>
                    </tr>
                    <tr style="height: 18px;">
                    <td style="width: 11.6563%; height: 18px;text-align: center;"><strong>Kode</strong></td>
                    <td style="width: 26.8963%; height: 18px;"><strong>Nama Rekening</strong></td>
                    <td style="width: 11.4475%; height: 18px;text-align: center;"><strong>Jumlah</strong></td>
                    <td style="width: 11.6563%; height: 18px;text-align: center;"><strong>Kode</strong></td>
                    <td style="width: 26.8963%; height: 18px;"><strong>Nama Rekening</strong></td>
                    <td style="width: 11.4475%; height: 18px;text-align: center;"><strong>Jumlah</strong></td>
                    </tr>



                    ';


                    // $total=0;
                    // foreach($ju as $j)
                    // {
                    // $total += $j->debet - $j->kredit;
                    // echo $j->debet;
                    // echo $j->kredit;
                    // echo $total;
                    // }

                    $totaktiva = $this->Laporan_Balance_Sheet_Model->totalaktiva();
                    $totpassiva = $this->Laporan_Balance_Sheet_Model->totalpassiva();
                    //$amblaktiva = $totaktiva['totalaktiva'];
                    $ById1 = $this->Laporan_Balance_Sheet_Model->get_data();
                    //$kode = $ById['kode'];
                    foreach ($ById1 as $row1) 
                        {

                    $html .='


                    <tr style="height: 18px;">                    

                    <td style="width: 11.6563%; height: 18px;text-align:center;">'.$row1->kode.'</td>
                    <td style="width: 26.8963%; height: 18px;">'.$row1->nama.'</td>
                    <td style="width: 11.4475%; height: 18px;text-align:right;">'.$row1->nama.'</td>

              

                 

                    <td style="width: 11.6563%; height: 18px;text-align:center;">'.$row1->kode.'</td>
                    <td style="width: 26.8963%; height: 18px;">'.$row1->nama.'</td>
                    <td style="width: 11.4475%; height: 18px;text-align:right;">'.$row1->nama.'</td>
                    </tr>

                  ';
                        }
                  $html .='

                    <tr>
                    <td colspan="2" style="text-align:right"><strong>Total</strong></td>
                    <td style="width: 11.4475%;text-align:right">'.number_format($totaktiva['totalaktiva'],2,",",".").'</td>
                    <td colspan="2" style="text-align:right;"><strong>Total</strong></td>
                    <td style="width: 11.4475%;text-align:right">'.number_format($totpassiva['totalpassiva'],2,",",".").'</td>
                    </tr>
                   
                    

                    </tbody>
                    </table>';


                
                    
            
                    $pdf->writeHTML($html, true, true, true, false, '');
                    
                    $pdf->lastPage();
            
                    ;
                            
            
                    //$pdf->writeHTML($html, true, false, true, false, '');
                    $pdf->Output('Laporan Neraca.pdf', 'I');
                
    }









    function laporan_neraca()
	{
		//$data['title'] = "LAPORAN NERACA";
		//$data['wajib_pajak_data'] = $this->pajak_model->get_data();	
		//$bulan = $this->uri->segment(3);

        $tgl_awal   = $this->input->post('tgl_awal');
        $tgl_akhir  = $this->input->post('tgl_akhir'); 

		//$data['bulan'] = ($bulan) ? nama_bulan($bulan) : FALSE;
		//$data['tahun'] = $this->uri->segment(4);
		$data['neraca_data'] = $this->get_neraca_data($tgl_awal,$tgl_akhir);
		if($role == "akuntan"){
			$this->load->view('admin/laporan_balance_sheet/neraca', $data);
		}else{
			$this->load->view('pimpinan-content/laporan_balance_sheet/neraca', $data);
		}
		
	}
	
	function get_neraca_data($tgl_awal,$tgl_akhir)
	{

		//$this->jurnal_model->set_month_year($bulan, $tahun, '<=');
		//$this->jurnal_model->set_account_group_id(array(1,2,3));
		$journal_data = $this->Laporan_Balance_Sheet_Model->get_data();

		$this->Laporan_Balance_Sheet_Model->set_account_group_id(array(1,2,3));
		$akun = $this->Laporan_Balance_Sheet_Model->get_all_data();

		if($akun)
		{
			foreach ($akun as $row)
			{
				$result[$row->kategori][$row->mastercoa_id] = array('nama' => $row->nama, 'saldo_normal' => $row->saldo_normal);
			}

			if($journal_data)
			{
				foreach ($journal_data as $row)
				{
					if(isset($result[$row->kategori][$row->mastercoa_id]))
					{
						if($row->debit > 0)
						{
							$result[$row->kategori][$row->mastercoa_id]['saldo_normal'] += $row->debit;
						}
						else
						{
							$result[$row->kategori][$row->mastercoa_id]['saldo_normal'] -= $row->kredit;
						}
					}
				}
			}
			return $result;
		}
		else
		{
			$this->session->set_userdata('ERRMSG_ARR', 'Laporan Neraca tidak dapat dibuat karena belum ada data akun pada kelompok aktiva, kewajiban, dan modal');
			redirect('laporan_balance_sheet');
		}
	}











    public function neraca_view()
	{
		# code untuk menampilkan data dari neraca
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$yearFromDate = date('Y', strtotime($fromDate));
		$data['periode'] = $yearFromDate;
		$data['subjudul'] = date('d M Y', strtotime($fromDate)) . ' sampai dengan ' . date('d M Y', strtotime($toDate));

		// mengambil data kode dari mastercoa
		$kode = [];
		$data_kode = $this->Laporan_Balance_Sheet_Model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_Balance_Sheet_Model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_Balance_Sheet_Model->getdataBukuBesar($fromDate, $toDate, $kode);

		$this->load->view('laporan/neraca-view', $data);
	}

	public function neraca_pdf()
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
		$data_kode = $this->Laporan_Balance_Sheet_Model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_Balance_Sheet_Model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_Balance_Sheet_Model->getdataBukuBesar($fromDate, $toDate, $kode);

		$this->load->view('laporan/neraca-pdf', $data);
	}








}

	

