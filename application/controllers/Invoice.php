<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('Invoice_Model');
		$this->load->library('session');
		$this->load->library('Pdf');

		//$this->load->model('Dashboard_Model');
	}

	public function hapusInvoice()
    {
         $id = $this->input->post('id');
         $data = $this->Invoice_Model->hapus($id);
         echo json_encode($data);
    }

	public function validasi_y(){

		$id =  $this->input->post('id');
		$invoice = $this->Invoice_Model->detailData($id);
		$mastercustomer_id = $invoice['mastercustomer_id'];
		$data = array(
			  "status" => "Y"
		);

		$this->db->where("id_invoice", $id);
		$this->db->update("dt_invoice", $data);

		echo json_encode($data);
		// redirect("piutang/invoice/" .$mastercustomer_id);
  }


	public function cetakinvoice($id)
	{
		$invoice = $this->Invoice_Model->detailData($id);
		function terbilang($angka)
      {
          $angka = abs((int)$angka);
          $bilangan = array(
              '', 'satu', 'dua', 'tiga', 'empat', 'lima',
              'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
          );
          
          if ($angka < 12) {
              return $bilangan[$angka];
          } elseif ($angka < 20) {
              return terbilang($angka - 10) . ' belas';
          } elseif ($angka < 100) {
              return terbilang($angka / 10) . ' puluh ' . terbilang($angka % 10);
          } elseif ($angka < 200) {
              return 'seratus ' . terbilang($angka - 100);
          } elseif ($angka < 1000) {
              return terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
          } elseif ($angka < 2000) {
              return 'seribu ' . terbilang($angka - 1000);
          } elseif ($angka < 1000000) {
              return terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
          } elseif ($angka < 1000000000) {
              return terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
          } elseif ($angka < 1000000000000) {
              return terbilang($angka / 1000000000) . ' milyar ' . terbilang($angka % 1000000000);
          } else {
              return 'Angka terlalu besar';
          }
      }

	  $total_tagihan = $invoice['total_all'];
	  $terbilang = ucwords(terbilang($total_tagihan));

	  $array = [
		'data' => $invoice,
		'terbilang' => $terbilang,
		'no_invoice' => $invoice['no_invoice'],
	  ];

	  $mpdf = new \Mpdf\Mpdf(
		[
			  'mode' => 'utf-8', 
			  'format' => 'Legal',
		  ]
		);


		$html = $this->load->view('admin/piutang/invoice-new/cetak-invoice', $array, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Piutang-'.$array['no_invoice'].'.pdf', 'I');
	}

	public function cetak_stat($id)
	{
	$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle('INVOICE');
	$pdf->SetFont('times', '', 11);
	
	$pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  

	$pdf->setMargins(10,10,10,10);
	
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);

	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 064', PDF_HEADER_STRING);


	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	$pdf->AddPage();          
	$statement = $this->Invoice_Model->detailData($id);
	$total_tagihan = number_format($statement['total_all'], 0, ',', '.');
	$html = '
		  <h1>STATEMENT OF FACT VOLUME OF GAS</h1>
		  <br>
		  <br>
		  <strong>INFORMATION</strong>
		  <br>
		  <table style="border-collapse: collapse; width: 100%;">
				<tr>
					  <td width="100px">Location</td>
					  <td width="50px" align="center">=</td>
					  <td>'.$statement['namaperusahaan'].'</td>
				</tr>
				<tr>
					  <td>Date</td>
					  <td align="center">=</td>
					  <td>'.$statement['tgl_dari'].' - '.$statement['tgl_ke'].'</td>
				</tr>
		  </table>
		  <br>
		  <br>
		  <strong>DATA</strong>
		  <br>
		  <table style="border-collapse: collapse; width: 200%;">
				<tr>
					  <td width="250px">Previuos Turbine Meter Reading Early, V1</td>
					  <td width="50px" align="center">=</td>
					  <td width="90px" align="center" border="1">'.$statement['v1'].'</td>
					  <td width="60px"><strong>M<sup>3</sup></strong></td>
					  <td>Awal Gas In</td>
				</tr>
				<tr>
					  <td>Present Turbine Meter Reading, V2</td>
					  <td align="center">=</td>
					  <td align="center" border="1">'.$statement['v2'].'</td>
					  <td><strong>M<sup>3</sup></strong></td>
					  <td>Akhir</td>
				</tr>
				<tr>
					  <td>Total Volume of Gas Supplied, V Turbinemete</td>
					  <td align="center">=</td>
					  <td align="center" border="1"><strong>'.$statement['vt'].'</strong></td>
					  <td><strong>m<sup>3</sup></strong></td>
					  <td><strong>(V2 - V1)</strong></td>
				</tr>
				<tr>
					  <td>Supply Pressure, (P)</td>
					  <td align="center">=</td>
					  <td align="center" border="1" bgcolor="yellow">'.$statement['pressure'].'</td>
					  <td><strong>barG</strong></td>
					  <td></td>
				</tr>
				<tr>
					  <td>Standard Condition Temperature,(T)</td>
					  <td align="center">=</td>
					  <td align="center" border="1" bgcolor="yellow">'.$statement['t'].'</td>
					  <td><strong><sup>o</sup>C</strong></td>
					  <td></td>
				</tr>
				<tr>
					  <td>Super Compression Factor, (K)</td>
					  <td align="center">=</td>
					  <td align="center" border="1">(1+(0,002*p))</td>
					  <td><strong><sup>o</sup>C</strong></td>
					  <td><small style="font-size:8px;"><strong><i>Faktor Kompresibilitas, untuk P ≤ 4 bar, K dianggap sama dengan (1 + (0,002* p)</i></strong></small></td>
				</tr>
				<tr>
					  <td></td>
					  <td align="center"></td>
					  <td align="center" border="1">'.$statement['k'].'</td>
					  <td></td>
					  <td></td>
				</tr>
				<tr>
					  <td>Atmosphere Pressure, P atm</td>
					  <td align="center">=</td>
					  <td align="center" border="1">1.01325</td>
					  <td><strong>Barg</strong></td>
					  <td></td>
				</tr>
				<tr>
					  <td>Gross Heating Value, GHV</td>
					  <td align="center">=</td>
					  <td align="center" border="1" bgcolor="yellow"></td>
					  <td><strong>BTU / SCF</strong></td>
					  <td>(Variable menyesuaikan hasil laboratorium)</td>
				</tr>
		  </table>
		  <br>
		  <br bgcolor="white">
		  <strong bgcolor="white">KONVERSI FAKTOR</strong>
		  <br>
		  <table style="border-collapse: collapse; width: 200%;">
				<tr>
					  <td width="250px">One standard cubic meter (1 Sm3)</td>
					  <td width="50px" align="center">=</td>
					  <td width="90px" align="center" ><strong>35,3147</strong></td>
					  <td width="50px"><strong>ft3</strong></td>
					  <td></td>
				</tr>
		  </table>
		  <br>
		  <br bgcolor="white">
		  <strong bgcolor="white">FORMULA EQUATION OF STATE</strong>
		  <br>
		  <table style="border-collapse: collapse; width: 200%;">
				<tr>
					  <td width="100px" align="right">V</td>
					  <td width="70px" align="center">=</td>
					  <td width="70px" align="center" rowspan="2"><p>VT</p></td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="150px" align="center" style="border-bottom: 2px solid black;">1.01325 + P</td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="50px" align="center" rowspan="2">K</td>
				</tr>
				<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td align="center">1.01325</td>
					  <td></td>
					  <td align="center">273.15 + T</td>
					  <td></td>
				</tr>
		  </table>
		  <br>
		  <br bgcolor="white">
		  <strong bgcolor="white">KALKULASI</strong>
		  <br>
		  <table style="border-collapse: collapse; width: 200%;">
				<tr>
					  <td width="100px" align="right">V</td>
					  <td width="70px" align="center">=</td>
					  <td width="70px" align="center" rowspan="2"><p>'.$statement['vt'].'</p></td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="150px" align="center" style="border-bottom: 2px solid black;">1.01325 + '.$statement['pressure'].'</td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="50px" align="center" rowspan="2">'.$statement['k'].'</td>
				</tr>
				<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td align="center">1.01325</td>
					  <td></td>
					  <td align="center">273.15 + '.$statement['t'].'</td>
					  <td></td>
				</tr>
		  </table>
		  <br>
		  <br>
		  <br>
		  <table style="border-collapse: collapse; width: 200%;">
				<tr>
					  <td width="100px" align="right">V</td>
					  <td width="70px" align="center">=</td>
					  <td width="70px" align="center" rowspan="2"><p>'.$statement['vt'].'</p></td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="150px" align="center" style="border-bottom: 2px solid black;">'.(1.01325+$statement['pressure']).'</td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
					  <td width="50px" align="center"><strong>*</strong></td>
					  <td width="50px" align="center" rowspan="2">'.$statement['k'].'</td>
				</tr>
				<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td align="center">1.01325</td>
					  <td></td>
					  <td align="center">'.(273.15+$statement['t']).'</td>
					  <td></td>
				</tr>
		  </table>
		  <br>
		  <br>
		  <br>
		  <table style="border-collapse: collapse; width: 200%;">
				<tr>
					  <td width="100px" align="right" rowspan="2"></td>
					  <td width="70px" align="center"  rowspan="2">=</td>
					  <td width="200px" align="center" bgcolor="orange" colspan="2">
					  '.$statement['volume'].'
					  Sm<sup>3</sup></td>
				</tr>
				<tr>
					  <td bgcolor="yellow" width="50px">Rp. </td>
					  <td width="150px" bgcolor="yellow" align="right">
					  '.$total_tagihan.'
					  </td>
				</tr>
		  </table>
	';

	$pdf->writeHTML($html, true, true, true, false, '');
	$pdf->Output('Statement.pdf', 'I');

	}



	function cetakba($id){      

		$data = $this->Invoice_Model->detailData($id);
	
		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('INVOICE');
		$pdf->SetFont('times', '', 11);
		
		$pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  

		$pdf->setMargins(10,10,10,10);
		
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
		$logo = base_url('assets/logo/logogea.png');
		//$no_jurnal  = $this->input->post('no_jurnal');
		$html = '
			  <h3 >BERITA ACARA PENAGIHAN GAS TERPAKAI</h3>
			  <h3 style="font-weight: none;"><i>STATEMENT OF GAS DELIVERY</i></h3>
			  
			  <br>
			  <table style="font-size: 10px;">
					<tr>
						  <td width="50px"><strong><u>DARI</u></strong></td>
						  <td width="25px">:</td>
						  <td width="175px"><strong>PT. GLOBAL ENERGY AGRAPANA</strong></td>
						  <td width="50px">&nbsp;</td>
						  <td width="40px"><strong><u>KE</u></strong></td>
						  <td width="25px">:</td>
						  <td width="100px"><strong>'.strtoupper($data['namaperusahaan']).'</strong></td>
					</tr>
					<tr>
						  <td><i>FROM</i></td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td><i>TO</i></td>
						  <td></td>
						  <td></td>
					</tr>
			  </table>
			  <br><br><br>
			  <table>
					<tr>
						  <td align="left" width="75px">&nbsp;&nbsp;<strong>I</strong></td>
						  <td width="150px"><strong><u>Status Penyerahan</u></strong></td>
						  <td width="50px"></td>
						  <td width="200px"></td>
					</tr>
					<tr>
						  <td></td>
						  <td><strong><i>Delivery Status</i></strong></td>
						  <td></td>
						  <td></td>
					</tr>

					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Tanggal Penyerahan</u></td>
						  <td>:</td>
						  <td>'.date('d-M-y', strtotime($data['tgl_ke'])).'</td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Date/Time of Delivery</i></td>
						  <td></td>
						  <td></td>
					</tr>
					<!--
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Periode Penyerahan</u></td>
						  <td>:</td>
						  <td>19 JUNI 2023 - 11 JULI 2023</td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Interval of Delivery</i></td>
						  <td></td>
						  <td></td>
					</tr>
					-->
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Tempat Penyerahan</u></td>
						  <td>:</td>
						  <td>'.strtoupper($data['namaperusahaan']).'</td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Point of Delivery</i></td>
						  <td></td>
						  <td></td>
					</tr>
					
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Sarana Penyerahan</u></td>
						  <td>:</td>
						  <td>Pressure Regulating Unit ( PRU )</td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Measuring Device</i></td>
						  <td></td>
						  <td></td>
					</tr>
					
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Dasar Penyerahan</u></td>
						  <td>:</td>
						  <td>Surat Perjanjian Jual Beli CNG</td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Delivery Agreement</i></td>
						  <td></td>
						  <td></td>
					</tr>

					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td>Metering Awal</td>
						  <td></td>
						  <td>'.number_format($data['v1'], 2, '.', '').'</td>
					</tr>
					<tr>
						  <td></td>
						  <td>Metering Akhir</td>
						  <td></td>
						  <td>'.number_format($data['v2'], 2, '.', '').'</td>
					</tr>
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>

			  </table>
			  <table>
					<tr>
						  <td align="left" width="75px">&nbsp;&nbsp;<strong>II</strong></td>
						  <td width="150px"><strong><u>Keterangan Penyerahan</u></strong></td>
						  <td width="50px"></td>
						  <td width="25px"></td>
						  <td width="75px"></td>
					</tr>
					<tr>
						  <td></td>
						  <td><strong><i>Delivery Description</i></strong></td>
						  <td></td>
						  <td></td>
					</tr>
					
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Jumlah Yang Ditagih</u></td>
						  <td>:</td>
						  <td></td>
						  <td align="right"><strong>'.number_format($data['volume'], 3).'</strong></td>
						  <td><strong>&nbsp;&nbsp;<span>Sm<sup>3</sup></span></strong></td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Change Quantity</i></td>
						  <td></td>
						  <td></td>
					</tr>
					
					<tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
					</tr>
					<tr>
						  <td></td>
						  <td><u>Jumlah Yang Ditagih</u></td>
						  <td>:</td>
						  <td><strong>Rp</strong></td>
						  <td align="right"><strong>'.number_format($data['total_all'],0,',','.').'</strong></td>
					</tr>
					<tr>
						  <td></td>
						  <td><i>Change Quantity</i></td>
						  <td></td>
						  <td></td>
					</tr>
			  </table>

			  <br><br>
			  <h4>Pembayaran Melalui Transfer Bank BCA Cabang Subang <span style="color:green;">0556.138.138 PT GLOBAL ENERGY AGRAPANA</span></h4>
			  <p>*) Validasi Maksimal 2 Hari Setelah TAGIHAN di Terima, Apabila Melebihi Waktu 2 Hari Dianggap Menyetujui</p>

			  <br>
			  <br>
			  <table>
					<tr>
						  <td width="50%" align="center">
								<strong>'.strtoupper($data['namaperusahaan']).'</strong>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<strong>(_______________________________)</strong>
						  </td>
						  <td width="50%" align="center">
								<strong>PT. GLOBAL ENERGY AGRAPANA</strong>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<strong><u>Bp. Fredi Ginting</u></strong>
								<br>
								<strong>Direktur Utama</strong>
						  </td>
					</tr>
			  </table>
		';

		// echo $html;
  
		$pdf->writeHTML($html, true, true, true, false, '');
		
		$pdf->lastPage();
  
		
  
		//$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('Beritaacara.pdf', 'I');
	}




}





