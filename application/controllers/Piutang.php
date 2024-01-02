<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Piutang_Model');
            $this->load->model('Tagihan_customer_model');
            $this->load->model('Master_Customer_Model');
            $this->load->library('session');
            $this->load->library('Pdf');
	}

	public function index()
	{    
            
            $getData = $this->Piutang_Model->Lihatmaster();

            foreach ($getData as &$datas) {
                $datas['jumlah_tagihan'] = $this->Tagihan_customer_model->count($datas['mastercustomer_id']);
            }
            
            $data = array( 
                'datamaster' => $getData,
                'customer' =>       $this->Master_Customer_Model->lihatmaster(),
            );

            $role = $this->session->userdata('role');

            if($role == "akuntan"){
                  $this->load->view('layout/header');
                  $this->load->view('layout/sidebar');
                  $this->load->view('admin/piutang/index',$data);
                  $this->load->view('layout/footer');
            }else{
                  $this->load->view('pimpinan/header');
                  $this->load->view('pimpinan/sidebar');
                  $this->load->view('pimpinan-content/piutang/index',$data);
                  $this->load->view('pimpinan/footer');
            }
	} 


      public function view_data()
      {
          
      }

      public function paid($mastercustomer_id){
            $data = array(
                  'datamaster' => $this->Piutang_Model->LihatMasterPaid($mastercustomer_id),
            );

            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/piutang/paid',$data);
            $this->load->view('layout/footer');
      }

      public function unpayed($mastercustomer_id){
            $data = array(
                  'datamaster' => $this->Piutang_Model->LihatMasterUnpayed($mastercustomer_id),
            );

            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/piutang/unpayed',$data);
            $this->load->view('layout/footer');
      }

      public function pending($mastercustomer_id){
            $data = array(
                  'datamaster' => $this->Piutang_Model->LihatMasterUnpayed($mastercustomer_id),
            );

            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/piutang/pending',$data);
            $this->load->view('layout/footer');
      }

      public function invoice($mastercustomer_id){

            $getData = $this->Piutang_Model->LihatMasterInvoice($mastercustomer_id);

            foreach ($getData as &$u) {
                  if ($u['statushutang'] == "Y") {
                      $u['statushutang'] = "sudah bayar";
                  } else {
                      $u['statushutang'] = "belum bayar";
                  }
              }
            $data = array(
                  'datamaster' => $getData,
            );

            $role = $this->session->userdata('role');

            if($role == "akuntan"){
                  $this->load->view('layout/header');
                  $this->load->view('layout/sidebar');
                  $this->load->view('admin/piutang/invoice',$data);
                  $this->load->view('layout/footer');
            }else{
                  $this->load->view('pimpinan/header');
                  $this->load->view('pimpinan/sidebar');
                  $this->load->view('pimpinan-content/piutang/invoice',$data);
                  $this->load->view('pimpinan/footer');
            }
           
      }

      function cetakinvoice($tagihan_customer_id){   
            
            
            
            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
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
    
            //$no_jurnal  = $this->input->post('no_jurnal');
            $data = $this->Piutang_Model->DetailTagihan($tagihan_customer_id); 
            $vt = number_format($data['meterakhir'] - $data['meterawal'], 2);
            $k = (1+(0.0002*$data['preasure']));
            $p = $data['preasure'];
            $t =  $data['t'];
            $ap = $data['ap'];
            $sc = $data['sc'];

            $harga_jual = $data['harga_jual'];
            $result = $data['total_tagihan'];
            $formatted_result = number_format($result, 0, ',', '.');

            $format_tanggal = $data['tanggalkirim'];
            $tanggal = date('d-F-Y', strtotime($format_tanggal));
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
                              <td>'.$data['namaperusahaan'].'</td>
                        </tr>
                        <tr>
                              <td>Date</td>
                              <td align="center">=</td>
                              <td>'.$tanggal.'</td>
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
                              <td width="90px" align="center" border="1">'.$data['meterawal'].'</td>
                              <td width="60px"><strong>M<sup>3</sup></strong></td>
                              <td>Awal Gas In</td>
                        </tr>
                        <tr>
                              <td>Present Turbine Meter Reading, V2</td>
                              <td align="center">=</td>
                              <td align="center" border="1">'.$data['meterakhir'].'</td>
                              <td><strong>M<sup>3</sup></strong></td>
                              <td>Akhir</td>
                        </tr>
                        <tr>
                              <td>Total Volume of Gas Supplied, V Turbinemete</td>
                              <td align="center">=</td>
                              <td align="center" border="1"><strong>'.$vt.'</strong></td>
                              <td><strong>m<sup>3</sup></strong></td>
                              <td><strong>(V2 - V1)</strong></td>
                        </tr>
                        <tr>
                              <td>Supply Pressure, (P)</td>
                              <td align="center">=</td>
                              <td align="center" border="1" bgcolor="yellow">'.$p.'</td>
                              <td><strong>barG</strong></td>
                              <td></td>
                        </tr>
                        <tr>
                              <td>Standard Condition Temperature,(T)</td>
                              <td align="center">=</td>
                              <td align="center" border="1" bgcolor="yellow">'.$data['t'].'</td>
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
                              <td align="center" border="1">'.$k.'</td>
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
                              <td width="70px" align="center" rowspan="2"><p>'.$vt.'</p></td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">1.01325 + '.$p.'</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="50px" align="center" rowspan="2">'.$k.'</td>
                        </tr>
                        <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td align="center">1.01325</td>
                              <td></td>
                              <td align="center">273.15 + '.$t.'</td>
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
                              <td width="70px" align="center" rowspan="2"><p>'.$vt.'</p></td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">'.(1.01325+$p).'</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="50px" align="center" rowspan="2">'.$k.'</td>
                        </tr>
                        <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td align="center">1.01325</td>
                              <td></td>
                              <td align="center">'.(273.15+$t).'</td>
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
                              '.$data['harga'].'
                              Sm<sup>3</sup></td>
                        </tr>
                        <tr>
                              <td bgcolor="yellow" width="50px">Rp. </td>
                              <td width="150px" bgcolor="yellow" align="right">
                              '.$formatted_result.'
                              </td>
                        </tr>
                  </table>
            ';
      
            $pdf->writeHTML($html, true, true, true, false, '');
            
            $pdf->lastPage();
      
            
      
            //$pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('Statement.pdf', 'I');
        }

        function cetakba($tagihan_customer_id){      

            $data = $this->Piutang_Model->DetailTagihan($tagihan_customer_id);
        
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

            $vt = number_format($data['meterakhir'] - $data['meterawal'], 2);
            $k = (1+(0.0002*$data['preasure']));
            $p = $data['preasure'];
            $t = 30;
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
                              <td>'.date('d-M-y', strtotime($data['tanggalkirim'])).'</td>
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
                              <td>'.number_format($data['meterawal'], 2, '.', '').'</td>
                        </tr>
                        <tr>
                              <td></td>
                              <td>Metering Akhir</td>
                              <td></td>
                              <td>'.number_format($data['meterakhir'], 2, '.', '').'</td>
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
                              <td align="right"><strong>'.number_format($data['harga'], 3).'</strong></td>
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
                              <td align="right"><strong>'.number_format($data['total_tagihan'],0,',','.').'</strong></td>
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

        public function pdfinvoice($mastercustomer_id){
            // $chek = $this->Piutang_Model->chekinvoice($mastercustomer_id);
            // echo $chek;
            // if ($chek == null) {
            //       $data=array(
            //             'no_invoice'                  => $this->input->post('no_invoice'),
            //             'mastercustomer_id'                  => $mastercustomer_id,
            //         );      
                
            // $this->db->insert('dt_invoice', $data);       
            // }
            $bulam = ['01' => 'Jan',
                      '02' => 'Feb',
                      '03' => 'Mar',
                      '04' => 'Apr',
                      '05' => 'Mei',
                      '06' => 'Jun',
                      '07' => 'Jul',
                        '08' => 'Ags',
                        '09' => 'Sep',
                        '10' => 'Oct',
                        '11' => 'Nov',
                        '12' => 'Des'];

            $detailData =  $this->Piutang_Model->Detail($mastercustomer_id);     
            $getData =  $this->Piutang_Model->LihatMasterInvoice($mastercustomer_id);    
            $total = 0;
            foreach ($getData as $invoice) {
            if (isset($invoice['total_tagihan'])) {
                  $total += $invoice['total_tagihan'];
            } 
             }

            function terbilang($angka) {
                  $angka = floatval($angka);
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
                  return ' seratus ' . terbilang($angka - 100);
                  } elseif ($angka < 1000) {
                  return terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
                  } elseif ($angka < 2000) {
                  return ' seribu ' . terbilang($angka - 1000);
                  } elseif ($angka < 1000000) {
                  return terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
                  } elseif ($angka < 1000000000) {
                  return terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
                  } elseif ($angka < 1000000000000) {
                  return terbilang($angka / 1000000000) . ' miliar ' . terbilang($angka % 1000000000);
                  } elseif ($angka < 1000000000000000) {
                  return terbilang($angka / 1000000000000) . ' triliun ' . terbilang($angka % 1000000000000);
                  } else {
                  return 'Angka terlalu besar';
                  }
            }

            $total_terbilang = ucwords(terbilang($total));
            $tanggal = $this->input->post('tanggal');
            $tanggal1 = explode("-", $tanggal);
            $tanggal2 = $tanggal1[2]."-".$bulam[$tanggal1[1]]."-".$tanggal1[0];
            $dd = $this->input->post('dd');
            $dd1 = explode("-", $dd);
            $dd2 = $dd1[2]."-".$bulam[$dd1[1]]."-".$dd1[0];

            $data = array(
                  'datamaster' => $this->Piutang_Model->LihatMasterInvoice($mastercustomer_id),
                  'total' => $total,
                  'terbilang' => $total_terbilang,
                  'detail' => $detailData,
                  'no_invoice'=>$this->input->post('no_invoice'),
                  'tanggal'=>$tanggal2,
                  'dd'=>$dd2,
            );

            $mpdf = new \Mpdf\Mpdf(
                  [
                        'mode' => 'utf-8', 
                        'format' => 'Legal',
                    ]
             );
      
            $data['judul'] = $data['no_invoice'];
            $data['isi'] = 'Ini adalah isi contoh untuk file PDF.';
      
            $html = $this->load->view('admin/piutang/pdfinvoice', $data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Piutang-'.$data['no_invoice'].'.pdf', 'I');

            // $this->load->view('admin/piutang/pdfinvoice',$data);
      
      }

      // function cetakinvoice($tagihan_customer_id){   
            
      //       $data = $this->Piutang_Model->DetailTagihan($tagihan_customer_id);
            
      //       $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
      //       $pdf->SetTitle('INVOICE');
      //       $pdf->SetFont('times', '', 11);
            
      //       $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  
    
      //       $pdf->setMargins(10,10,10,10);
            
      //       $pdf->SetPrintHeader(false);
      //       $pdf->SetPrintFooter(false);
    
      //       // set default header data
      //       $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 064', PDF_HEADER_STRING);
    
      //       // set header and footer fonts
      //       $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      //       $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
      //       // set default monospaced font
      //       $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
      //       // set margins
      //       //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      //       //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      //       //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
      //       $pdf->AddPage();          
    
      //       //$no_jurnal  = $this->input->post('no_jurnal');
      //       $vt = number_format($data['meterakhir'] - $data['meterawal'], 2);
      //       $k = (1+(0.0002*$data['preasure']));
      //       $p = $data['preasure'];
      //       $t = $data['t'];
      //       $ap = $data['ap'];
      //       $sc = $data['sc'];
            
      //       $html = '
      //             <h1>STATEMENT OF FACT VOLUME OF GAS</h1>
      //             <br>
      //             <br>
      //             <strong>INFORMATION</strong>
      //             <br>
      //             <table style="border-collapse: collapse; width: 100%;">
      //                   <tr>
      //                         <td width="100px">Location</td>
      //                         <td width="50px" align="center">=</td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td>Date</td>
      //                         <td align="center">=</td>
      //                         <td></td>
      //                   </tr>
      //             </table>
      //             <br>
      //             <br>
      //             <strong>DATA</strong>
      //             <br>
      //             <table style="border-collapse: collapse; width: 200%;">
      //                   <tr>
      //                         <td width="250px">Previuos Turbine Meter Reading Early, V1</td>
      //                         <td width="50px" align="center">=</td>
      //                         <td width="90px" align="center" border="1">'.$data['meterawal'].'</td>
      //                         <td width="60px"><strong>M<sup>3</sup></strong></td>
      //                         <td>Awal Gas In</td>
      //                   </tr>
      //                   <tr>
      //                         <td>Present Turbine Meter Reading, V2</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1">'.$data['meterakhir'].'</td>
      //                         <td><strong>M<sup>3</sup></strong></td>
      //                         <td>Akhir</td>
      //                   </tr>
      //                   <tr>
      //                         <td>Total Volume of Gas Supplied, V Turbinemete</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1"><strong>'.$vt.'</strong></td>
      //                         <td><strong>m<sup>3</sup></strong></td>
      //                         <td><strong>(V2 - V1)</strong></td>
      //                   </tr>
      //                   <tr>
      //                         <td>Supply Pressure, (P)</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1" bgcolor="yellow">'.$p.'</td>
      //                         <td><strong>barG</strong></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td>Standard Condition Temperature,(T)</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1" bgcolor="yellow">'.$sc.'</td>
      //                         <td><strong><sup>o</sup>C</strong></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td>Standard Condition Temperature,(T)</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1">(273+27)/(273+t)</td>
      //                         <td><strong><sup>o</sup>C</strong></td>
      //                         <td><small style="font-size:8px;"><strong><i>Faktor Kompresibilitas, untuk P ≤ 4 bar, K dianggap sama dengan (1 + (0,002* p)</i></strong></small></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td align="center"></td>
      //                         <td align="center" border="1">'.$k.'</td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td>Atmosphere Pressure, P atm</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1">'.$ap.'</td>
      //                         <td><strong>Barg</strong></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td>Gross Heating Value, GHV</td>
      //                         <td align="center">=</td>
      //                         <td align="center" border="1" bgcolor="yellow"></td>
      //                         <td><strong>BTU / SCF</strong></td>
      //                         <td>(Variable menyesuaikan hasil laboratorium)</td>
      //                   </tr>
      //             </table>
      //             <br>
      //             <br bgcolor="white">
      //             <strong bgcolor="white">KONVERSI FAKTOR</strong>
      //             <br>
      //             <table style="border-collapse: collapse; width: 200%;">
      //                   <tr>
      //                         <td width="250px">One standard cubic meter (1 Sm3)</td>
      //                         <td width="50px" align="center">=</td>
      //                         <td width="90px" align="center" ><strong>35,3147</strong></td>
      //                         <td width="50px"><strong>ft3</strong></td>
      //                         <td></td>
      //                   </tr>
      //             </table>
      //             <br>
      //             <br bgcolor="white">
      //             <strong bgcolor="white">FORMULA EQUATION OF STATE</strong>
      //             <br>
      //             <table style="border-collapse: collapse; width: 200%;">
      //                   <tr>
      //                         <td width="100px" align="right">V</td>
      //                         <td width="70px" align="center">=</td>
      //                         <td width="70px" align="center" rowspan="2"><p>VT</p></td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="150px" align="center" style="border-bottom: 2px solid black;">1.01325 + P</td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="50px" align="center" rowspan="2">K</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td align="center">1.01325</td>
      //                         <td></td>
      //                         <td align="center">273.15 + T</td>
      //                         <td></td>
      //                   </tr>
      //             </table>
      //             <br>
      //             <br bgcolor="white">
      //             <strong bgcolor="white">KALKULASI</strong>
      //             <br>
      //             <table style="border-collapse: collapse; width: 200%;">
      //                   <tr>
      //                         <td width="100px" align="right">V</td>
      //                         <td width="70px" align="center">=</td>
      //                         <td width="70px" align="center" rowspan="2"><p>'.$vt.'</p></td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="150px" align="center" style="border-bottom: 2px solid black;">1.01325 + '.$p.'</td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="50px" align="center" rowspan="2">'.$k.'</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td align="center">1.01325</td>
      //                         <td></td>
      //                         <td align="center">273.15 + '.$t.'</td>
      //                         <td></td>
      //                   </tr>
      //             </table>
      //             <br>
      //             <br>
      //             <br>
      //             <table style="border-collapse: collapse; width: 200%;">
      //                   <tr>
      //                         <td width="100px" align="right">V</td>
      //                         <td width="70px" align="center">=</td>
      //                         <td width="70px" align="center" rowspan="2"><p>'.$vt.'</p></td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="150px" align="center" style="border-bottom: 2px solid black;">'.(1.01325+$p).'</td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
      //                         <td width="50px" align="center"><strong>*</strong></td>
      //                         <td width="50px" align="center" rowspan="2">'.$k.'</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td align="center">1.01325</td>
      //                         <td></td>
      //                         <td align="center">'.(273.15+$t).'</td>
      //                         <td></td>
      //                   </tr>
      //             </table>
      //             <br>
      //             <br>
      //             <br>
      //             <table style="border-collapse: collapse; width: 200%;">
      //                   <tr>
      //                         <td width="100px" align="right" rowspan="2"></td>
      //                         <td width="70px" align="center"  rowspan="2">=</td>
      //                         <td width="200px" align="center" bgcolor="orange" colspan="2">
      //                         '.number_format(($vt * ((1.01325+$p) / 1.01325) * (300.15 / (273.15+$t)) * $k), 3).'
      //                         Sm<sup>3</sup></td>
      //                   </tr>
      //                   <tr>
      //                         <td bgcolor="yellow" width="50px">Rp. </td>
      //                         <td width="150px" bgcolor="yellow" align="right">
      //                         '.number_format((number_format(($vt * ((1.01325+$p) / 1.01325) * (300.15 / (273.15+$t)) * $k), 3) * 10250),0,',','.').'
      //                         </td>
      //                   </tr>
      //             </table>
      //       ';
      
      //       $pdf->writeHTML($html, true, true, true, false, '');
            
      //       $pdf->lastPage();
      
            
      
      //       //$pdf->writeHTML($html, true, false, true, false, '');
      //       $pdf->Output('Statement.pdf', 'I');
      //   }

      //   function cetakba($tagihan_customer_id){      

      //       $data = $this->Piutang_Model->DetailTagihan($tagihan_customer_id);
        
      //       $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
      //       $pdf->SetTitle('INVOICE');
      //       $pdf->SetFont('times', '', 11);
            
      //       $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  
    
      //       $pdf->setMargins(10,10,10,10);
            
      //       $pdf->SetPrintHeader(false);
      //       $pdf->SetPrintFooter(false);
    
      //       // set default header data
      //       $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 064', PDF_HEADER_STRING);
    
      //       // set header and footer fonts
      //       $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      //       $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
      //       // set default monospaced font
      //       $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
      //       // set margins
      //       //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      //       //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      //       //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
      //       $pdf->AddPage();          
      //       $logo = base_url('assets/logo/logogea.png');
      //       //$no_jurnal  = $this->input->post('no_jurnal');

      //       $vt = number_format($data['meterakhir'] - $data['meterawal'], 2);
      //       $k = (1+(0.0002*$data['preasure']));
      //       $p = $data['preasure'];
      //       $t = 30;
      //       $html = '
      //             <h3 >BERITA ACARA PENAGIHAN GAS TERPAKAI</h3>
      //             <h3 style="font-weight: none;"><i>STATEMENT OF GAS DELIVERY</i></h3>
                  
      //             <br>
      //             <table style="font-size: 10px;">
      //                   <tr>
      //                         <td width="50px"><strong><u>DARI</u></strong></td>
      //                         <td width="25px">:</td>
      //                         <td width="175px"><strong>PT. GLOBAL ENERGY AGRAPANA</strong></td>
      //                         <td width="50px">&nbsp;</td>
      //                         <td width="40px"><strong><u>KE</u></strong></td>
      //                         <td width="25px">:</td>
      //                         <td width="100px"><strong>'.strtoupper($data['namaperusahaan']).'</strong></td>
      //                   </tr>
      //                   <tr>
      //                         <td><i>FROM</i></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td><i>TO</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //             </table>
      //             <br><br><br>
      //             <table>
      //                   <tr>
      //                         <td align="left" width="75px">&nbsp;&nbsp;<strong>I</strong></td>
      //                         <td width="150px"><strong><u>Status Penyerahan</u></strong></td>
      //                         <td width="50px"></td>
      //                         <td width="200px"></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><strong><i>Delivery Status</i></strong></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>

      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Tanggal Penyerahan</u></td>
      //                         <td>:</td>
      //                         <td>'.date('d-M-y', strtotime($data['tanggalkirim'])).'</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Date/Time of Delivery</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <!--
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Periode Penyerahan</u></td>
      //                         <td>:</td>
      //                         <td>19 JUNI 2023 - 11 JULI 2023</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Interval of Delivery</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   -->
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Tempat Penyerahan</u></td>
      //                         <td>:</td>
      //                         <td>'.strtoupper($data['namaperusahaan']).'</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Point of Delivery</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
                        
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Sarana Penyerahan</u></td>
      //                         <td>:</td>
      //                         <td>Pressure Regulating Unit ( PRU )</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Measuring Device</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
                        
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Dasar Penyerahan</u></td>
      //                         <td>:</td>
      //                         <td>Surat Perjanjian Jual Beli CNG</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Delivery Agreement</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>

      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td>Metering Awal</td>
      //                         <td></td>
      //                         <td>'.number_format($data['meterawal'], 2, '.', '').'</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td>Metering Akhir</td>
      //                         <td></td>
      //                         <td>'.number_format($data['meterakhir'], 2, '.', '').'</td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>

      //             </table>
      //             <table>
      //                   <tr>
      //                         <td align="left" width="75px">&nbsp;&nbsp;<strong>II</strong></td>
      //                         <td width="150px"><strong><u>Keterangan Penyerahan</u></strong></td>
      //                         <td width="50px"></td>
      //                         <td width="25px"></td>
      //                         <td width="75px"></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><strong><i>Delivery Description</i></strong></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
                        
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Jumlah Yang Ditagih</u></td>
      //                         <td>:</td>
      //                         <td></td>
      //                         <td align="right"><strong>'.number_format(($vt * ((1.01325+$p) / 1.01325) * (300.15 / (273.15+$t)) * $k), 3).'</strong></td>
      //                         <td><strong>&nbsp;&nbsp;<span>Sm<sup>3</sup></span></strong></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Change Quantity</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
                        
      //                   <tr>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><u>Jumlah Yang Ditagih</u></td>
      //                         <td>:</td>
      //                         <td><strong>Rp</strong></td>
      //                         <td align="right"><strong>'.number_format((number_format(($vt * ((1.01325+$p) / 1.01325) * (300.15 / (273.15+$t)) * $k), 3) * 10250),0,',','.').'</strong></td>
      //                   </tr>
      //                   <tr>
      //                         <td></td>
      //                         <td><i>Change Quantity</i></td>
      //                         <td></td>
      //                         <td></td>
      //                   </tr>
      //             </table>

      //             <br><br>
      //             <h4>Pembayaran Melalui Transfer Bank BCA Cabang Subang <span style="color:green;">0556.138.138 PT GLOBAL ENERGY AGRAPANA</span></h4>
      //             <p>*) Validasi Maksimal 2 Hari Setelah TAGIHAN di Terima, Apabila Melebihi Waktu 2 Hari Dianggap Menyetujui</p>

      //             <br>
      //             <br>
      //             <table>
      //                   <tr>
      //                         <td width="50%" align="center">
      //                               <strong>'.strtoupper($data['namaperusahaan']).'</strong>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <strong>(_______________________________)</strong>
      //                         </td>
      //                         <td width="50%" align="center">
      //                               <strong>PT. GLOBAL ENERGY AGRAPANA</strong>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <br>
      //                               <strong><u>Bp. Fredi Ginting</u></strong>
      //                               <br>
      //                               <strong>Direktur Utama</strong>
      //                         </td>
      //                   </tr>
      //             </table>
      //       ';

      //       // echo $html;
      
      //       $pdf->writeHTML($html, true, true, true, false, '');
            
      //       $pdf->lastPage();
      
            
      
      //       //$pdf->writeHTML($html, true, false, true, false, '');
      //       $pdf->Output('Beritaacara.pdf', 'I');
      //   }

      //   public function pdfinvoice($mastercustomer_id){
      //       // $chek = $this->Piutang_Model->chekinvoice($mastercustomer_id);
      //       // echo $chek;
      //       // if ($chek == null) {
      //       //       $data=array(
      //       //             'no_invoice'                  => $this->input->post('no_invoice'),
      //       //             'mastercustomer_id'                  => $mastercustomer_id,
      //       //         );      
                
      //       // $this->db->insert('dt_invoice', $data);       
      //       // }
      //       $bulam = ['01' => 'Jan',
      //                 '02' => 'Feb',
      //                 '03' => 'Mar',
      //                 '04' => 'Apr',
      //                 '05' => 'Mei',
      //                 '06' => 'Jun',
      //                 '07' => 'Jul',
      //                   '08' => 'Ags',
      //                   '09' => 'Sep',
      //                   '10' => 'Oct',
      //                   '11' => 'Nov',
      //                   '12' => 'Des'];

      //       $detailData =  $this->Piutang_Model->Detail($mastercustomer_id);     
      //       $getData =  $this->Piutang_Model->LihatMasterInvoice($mastercustomer_id);    
      //       $total = 0;

      //       foreach ($getData as $invoice) {
      //       if (isset($invoice['total'])) {
      //             $total += $invoice['total'];
      //       } 
      //        }

      //       function terbilang($angka) {
      //             $angka = floatval($angka);
      //             $bilangan = array(
      //             '', 'satu', 'dua', 'tiga', 'empat', 'lima',
      //             'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
      //             );
      //             if ($angka < 12) {
      //             return $bilangan[$angka];
      //             } elseif ($angka < 20) {
      //             return terbilang($angka - 10) . ' belas';
      //             } elseif ($angka < 100) {
      //             return terbilang($angka / 10) . ' puluh ' . terbilang($angka % 10);
      //             } elseif ($angka < 200) {
      //             return ' seratus ' . terbilang($angka - 100);
      //             } elseif ($angka < 1000) {
      //             return terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
      //             } elseif ($angka < 2000) {
      //             return ' seribu ' . terbilang($angka - 1000);
      //             } elseif ($angka < 1000000) {
      //             return terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
      //             } elseif ($angka < 1000000000) {
      //             return terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
      //             } elseif ($angka < 1000000000000) {
      //             return terbilang($angka / 1000000000) . ' miliar ' . terbilang($angka % 1000000000);
      //             } elseif ($angka < 1000000000000000) {
      //             return terbilang($angka / 1000000000000) . ' triliun ' . terbilang($angka % 1000000000000);
      //             } else {
      //             return 'Angka terlalu besar';
      //             }
      //       }

      //       $total_terbilang = ucwords(terbilang($total));
      //       $tanggal = $this->input->post('tanggal');
      //       $tanggal1 = explode("-", $tanggal);
      //       $tanggal2 = $tanggal1[2]."-".$bulam[$tanggal1[1]]."-".$tanggal1[0];
      //       $dd = $this->input->post('dd');
      //       $dd1 = explode("-", $dd);
      //       $dd2 = $dd1[2]."-".$bulam[$dd1[1]]."-".$dd1[0];

      //       $data = array(
      //             'datamaster' => $this->Piutang_Model->LihatMasterInvoice($mastercustomer_id),
      //             'total' => $total,
      //             'terbilang' => $total_terbilang,
      //             'detail' => $detailData,
      //             'no_invoice'=>$this->input->post('no_invoice'),
      //             'tanggal'=>$tanggal2,
      //             'dd'=>$dd2,
      //       );

      //       $this->load->view('admin/piutang/pdfinvoice',$data);
      
      // }
      public function isiinvoice($mastercustomer_id)
      {
      
            $data = array(
                  'id' => $mastercustomer_id,
                  
            );
       $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/piutang/invoicee', $data);
        $this->load->view('layout/footer'); 
      }

      public function validasi_y($id){
            $data = array(
                  "statushutang" => "Y"
            );

            $this->db->where("tagihan_customer_id", $id);
            $this->db->update("dt_tagihan_customer", $data);
            redirect("piutang");
      }

      // public function validasi_n($id){
      //       $data = array(
      //             "status" => "N"
      //       );

      //       $this->db->where("datakwitansi_id", $id);
      //       $this->db->update("dt_datakwitansi", $data);
      //       redirect("data_kwitansi");
      // }


      public function pdfinvoicesatuan($tagihan_customer_id)
      {    
        
            $bulam = ['01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
              '08' => 'Ags',
              '09' => 'Sep',
              '10' => 'Oct',
              '11' => 'Nov',
              '12' => 'Des'];
      $getData = $this->Piutang_Model->DetailTagihan($tagihan_customer_id);

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
      
      $harga = $getData['total_tagihan'];
      $harga_jual = $getData['harga_jual']; 
      
      $total = $harga;
      $total_terbilang = ucwords(terbilang($total));


      $total_rupiah = "Rp " . number_format($total, 0, ',', '.');

      $tanggal = $this->input->post('tanggal');
      $tanggal1 = explode("-", $tanggal);
      $tanggal2 = $tanggal1[2]."-".$bulam[$tanggal1[1]]."-".$tanggal1[0];
      $dd = $this->input->post('dd');
      $dd1 = explode("-", $dd);
      $dd2 = $dd1[2]."-".$bulam[$dd1[1]]."-".$dd1[0];
      $data = array(
            'u' => $getData,
            'total' => $total_rupiah,
            'terbilang' => $total_terbilang,
            'no_invoice' => $this->input->post('no_invoice'),
            'tanggal' => $tanggal2,
            'dd' => $dd2,
      );

      $mpdf = new \Mpdf\Mpdf(
            [
                  'mode' => 'utf-8', 
                  'format' => 'Legal',
              ]
       );

      $data['judul'] = $data['no_invoice'];
      $data['isi'] = 'Ini adalah isi contoh untuk file PDF.';

      $html = $this->load->view('admin/piutang/pdfinvoice_satuan', $data, true);
      $mpdf->WriteHTML($html);
      $mpdf->Output('Piutang-'.$data['no_invoice'].'.pdf', 'I');



      // $this->load->view('admin/piutang/pdfinvoice_satuan', $data);
      }


      public function isiinvoice_satuan($mastercustomer_id)
      {
      
            $data = array(
                  'id' => $mastercustomer_id,
                  
            );
       $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/piutang/input-invoicesatuan', $data);
        $this->load->view('layout/footer'); 
      }

      public function selectInvoice()
      {
            $fromdate =  $this->input->post('fromdate');
            $todate =  $this->input->post('todate');
            $mastercustomer_id =  $this->input->post('mastercustomer_id');
            $statushutang =  $this->input->post('statushutang');

            $jumlahPiutang = $this->Tagihan_customer_model->count($mastercustomer_id);

            if($statushutang == "All")
            {
                  $data = [
                        'datamaster' => $this->Piutang_Model->selectInvoice($mastercustomer_id, $fromdate, $todate),
                        'fromdate' => $fromdate,
                        'todate' => $todate,
                        'mastercustomer_id' => $mastercustomer_id,
                        'statushutang' => $statushutang,
                        'jumlahPiutang' => $jumlahPiutang,
                  ];
            }else{
                  $data = [
                        'datamaster' => $this->Piutang_Model->selectInvoice2($mastercustomer_id, $fromdate, $todate, $statushutang),
                        'fromdate' => $fromdate,
                        'todate' => $todate,
                        'mastercustomer_id' => $mastercustomer_id,
                        'statushutang' => $statushutang,
                        'jumlahPiutang' => $jumlahPiutang,
                  ];
            }

           
            // $this->load->view('layout/header');
            // $this->load->view('layout/sidebar');
            $this->load->view('admin/piutang/selectInvoice',$data);
            // $this->load->view('layout/footer');

      }

      public function printSelectInvoice(){
            // $chek = $this->Piutang_Model->chekinvoice($mastercustomer_id);
            // echo $chek;
            // if ($chek == null) {
            //       $data=array(
            //             'no_invoice'                  => $this->input->post('no_invoice'),
            //             'mastercustomer_id'                  => $mastercustomer_id,
            //         );      
                
            // $this->db->insert('dt_invoice', $data);       
            // }
            $fromdate =  $this->input->post('fromdate');
            $todate =  $this->input->post('todate');
            $mastercustomer_id =  $this->input->post('mastercustomer_id');
            $statushutang =  $this->input->post('statushutang');


            $bulam = ['01' => 'Jan',
                      '02' => 'Feb',
                      '03' => 'Mar',
                      '04' => 'Apr',
                      '05' => 'Mei',
                      '06' => 'Jun',
                      '07' => 'Jul',
                        '08' => 'Ags',
                        '09' => 'Sep',
                        '10' => 'Oct',
                        '11' => 'Nov',
                        '12' => 'Des'];


            $detailData =  $this->Piutang_Model->Detail($mastercustomer_id);     
            if($statushutang == "All")
            {
                  $getData =  $this->Piutang_Model->selectInvoice($mastercustomer_id, $fromdate, $todate);   
            }else{
                  $getData =  $this->Piutang_Model->selectInvoice2($mastercustomer_id, $fromdate, $todate, $statushutang);
            }
         
            $total = 0;
            foreach ($getData as $invoice) {
            if (isset($invoice['total_tagihan'])) {
                  $total += $invoice['total_tagihan'];
            } 
             }

            function terbilang($angka) {
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
                  return ' seratus ' . terbilang($angka - 100);
                  } elseif ($angka < 1000) {
                  return terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
                  } elseif ($angka < 2000) {
                  return ' seribu ' . terbilang($angka - 1000);
                  } elseif ($angka < 1000000) {
                  return terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
                  } elseif ($angka < 1000000000) {
                  return terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
                  } elseif ($angka < 1000000000000) {
                  return terbilang($angka / 1000000000) . ' miliar ' . terbilang($angka % 1000000000);
                  } elseif ($angka < 1000000000000000) {
                  return terbilang($angka / 1000000000000) . ' triliun ' . terbilang($angka % 1000000000000);
                  } else {
                  return 'Angka terlalu besar';
                  }
            }

            $total_terbilang = ucwords(terbilang($total));
            // $total_rupiah = "Rp " . number_format($total, 0, ',', '.');
            $tanggal = $this->input->post('tanggal');
            $tanggal1 = explode("-", $tanggal);
            $tanggal2 = $tanggal1[2]."-".$bulam[$tanggal1[1]]."-".$tanggal1[0];
            $dd = $this->input->post('dd');
            $dd1 = explode("-", $dd);
            $dd2 = $dd1[2]."-".$bulam[$dd1[1]]."-".$dd1[0];

            if($statushutang == "All")
            {
                  $data = array(
                        'datamaster' => $getData,
                        'total' => $total,
                        'terbilang' => $total_terbilang,
                        'detail' => $detailData,
                        'no_invoice'=>$this->input->post('no_invoice'),
                        'tanggal'=>$tanggal2,
                        'dd'=>$dd2,
                  );
            }else{
                  $data = array(
                        'datamaster' => $getData,
                        'total' => $total,
                        'terbilang' => $total_terbilang,
                        'detail' => $detailData,
                        'no_invoice'=>$this->input->post('no_invoice'),
                        'tanggal'=>$tanggal2,
                        'dd'=>$dd2,
                  );
            }

            $mpdf = new \Mpdf\Mpdf(
                  [
                        'mode' => 'utf-8', 
                        'format' => 'Legal',
                    ]
             );
      
            $data['judul'] = $data['no_invoice'];
            $data['isi'] = 'Ini adalah isi contoh untuk file PDF.';
      
            $html = $this->load->view('admin/piutang/pdfinvoice',$data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Piutang-'.$data['no_invoice'].'.pdf', 'I');

            // $this->load->view('admin/piutang/pdfinvoice',$data);
      }


      public function detailPiutang($id)
      {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/piutang/detail/index');
            $this->load->view('layout/footer');
      }



      function rekapStat()
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
    
            $fromdate =  $this->input->post('fromdate');
            $todate =  $this->input->post('todate');
            $mastercustomer_id =  $this->input->post('mastercustomer_id');
            $statushutang =  $this->input->post('statushutang');

            $from = date('d F Y', strtotime($fromdate));
            $to = date('d F Y',  strtotime($todate));

             if($statushutang == "All")
            {
                  $getData =  $this->Piutang_Model->selectInvoice($mastercustomer_id, $fromdate, $todate);   
            }else{
                  $getData =  $this->Piutang_Model->selectInvoice2($mastercustomer_id, $fromdate, $todate, $statushutang);
            }

            foreach ($getData as $data) {
            $pdf->AddPage();          
            $vt = number_format($data['meterakhir'] - $data['meterawal'], 2);
            $k = (1+(0.0002*$data['preasure']));
            $p = $data['preasure'];
            $t =  $data['t'];
            $ap = $data['ap'];
            $sc = $data['sc'];

            $harga_jual = $data['harga_jual'];
            $result = $data['total_tagihan'];
            $formatted_result = number_format($result, 0, ',', '.');

            $format_tanggal = $data['tanggalkirim'];
            $tanggal = date('d-F-Y', strtotime($format_tanggal));
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
                              <td>'.$data['namaperusahaan'].'</td>
                        </tr>
                        <tr>
                              <td>Date</td>
                              <td align="center">=</td>
                              <td>'.$from.' - '.$to.'</td>
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
                              <td width="90px" align="center" border="1">'.$data['meterawal'].'</td>
                              <td width="60px"><strong>M<sup>3</sup></strong></td>
                              <td>Awal Gas In</td>
                        </tr>
                        <tr>
                              <td>Present Turbine Meter Reading, V2</td>
                              <td align="center">=</td>
                              <td align="center" border="1">'.$data['meterakhir'].'</td>
                              <td><strong>M<sup>3</sup></strong></td>
                              <td>Akhir</td>
                        </tr>
                        <tr>
                              <td>Total Volume of Gas Supplied, V Turbinemete</td>
                              <td align="center">=</td>
                              <td align="center" border="1"><strong>'.$vt.'</strong></td>
                              <td><strong>m<sup>3</sup></strong></td>
                              <td><strong>(V2 - V1)</strong></td>
                        </tr>
                        <tr>
                              <td>Supply Pressure, (P)</td>
                              <td align="center">=</td>
                              <td align="center" border="1" bgcolor="yellow">'.$p.'</td>
                              <td><strong>barG</strong></td>
                              <td></td>
                        </tr>
                        <tr>
                              <td>Standard Condition Temperature,(T)</td>
                              <td align="center">=</td>
                              <td align="center" border="1" bgcolor="yellow">'.$data['t'].'</td>
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
                              <td align="center" border="1">'.$k.'</td>
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
                              <td width="70px" align="center" rowspan="2"><p>'.$vt.'</p></td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">1.01325 + '.$p.'</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="50px" align="center" rowspan="2">'.$k.'</td>
                        </tr>
                        <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td align="center">1.01325</td>
                              <td></td>
                              <td align="center">273.15 + '.$t.'</td>
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
                              <td width="70px" align="center" rowspan="2"><p>'.$vt.'</p></td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">'.(1.01325+$p).'</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="150px" align="center" style="border-bottom: 2px solid black;">300.15</td>
                              <td width="50px" align="center"><strong>*</strong></td>
                              <td width="50px" align="center" rowspan="2">'.$k.'</td>
                        </tr>
                        <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td align="center">1.01325</td>
                              <td></td>
                              <td align="center">'.(273.15+$t).'</td>
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
                              '.$data['harga'].'
                              Sm<sup>3</sup></td>
                        </tr>
                        <tr>
                              <td bgcolor="yellow" width="50px">Rp. </td>
                              <td width="150px" bgcolor="yellow" align="right">
                              '.$formatted_result.'
                              </td>
                        </tr>
                  </table>
            ';
      
            $pdf->writeHTML($html, true, true, true, false, '');

            }
            $pdf->Output('Statement.pdf', 'I');
        }


        function rekapBa(){      

            // $data = $this->Piutang_Model->DetailTagihan($tagihan_customer_id);
        
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

            $fromdate =  $this->input->post('fromdate');
            $todate =  $this->input->post('todate');
            $mastercustomer_id =  $this->input->post('mastercustomer_id');
            $statushutang =  $this->input->post('statushutang');

            $from = date('d F Y', strtotime($fromdate));
            $to = date('d F Y',  strtotime($todate));

             if($statushutang == "All")
            {
                  $getData =  $this->Piutang_Model->selectInvoice($mastercustomer_id, $fromdate, $todate);   
            }else{
                  $getData =  $this->Piutang_Model->selectInvoice2($mastercustomer_id, $fromdate, $todate, $statushutang);
            }


            foreach ($getData as $data) {
                 
            $pdf->AddPage();          
            $logo = base_url('assets/logo/logogea.png');
            //$no_jurnal  = $this->input->post('no_jurnal');

            $vt = number_format($data['meterakhir'] - $data['meterawal'], 2);
            $k = (1+(0.0002*$data['preasure']));
            $p = $data['preasure'];
            $t = 30;
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
                              <td>'.date('d-M-y', strtotime($data['tanggal'])).'</td>
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
                              <td>'.number_format($data['meterawal'], 2, '.', '').'</td>
                        </tr>
                        <tr>
                              <td></td>
                              <td>Metering Akhir</td>
                              <td></td>
                              <td>'.number_format($data['meterakhir'], 2, '.', '').'</td>
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
                              <td align="right"><strong>'.number_format($data['harga'], 3).'</strong></td>
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
                              <td align="right"><strong>'.number_format($data['total_tagihan'],0,',','.').'</strong></td>
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

            }
            
            //$pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('Beritaacara.pdf', 'I');
        }
      


      }




