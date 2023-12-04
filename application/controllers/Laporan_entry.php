<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_entry extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->library('Pdf');
		$this->load->model('Laporan_Entry_Model');
	}

	public function index()
	{

        $data = array( 
            'databyjurnal'				=> $this->Laporan_Entry_Model->databyjurnal(),		
        );      

		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/laporan_entry/index',$data);
        $this->load->view('layout/footer');
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
        

        $tgl_awal   = $this->input->post('tgl_awal');
        $tgl_akhir  = $this->input->post('tgl_akhir'); 


        $totdebit = $this->Laporan_Entry_Model->totaldebit();   
        $totkredit = $this->Laporan_Entry_Model->totalkredit(); 
        $periode = $this->Laporan_Entry_Model->periode($tgl_awal,$tgl_akhir);
       
        
                    $html = '
                    <p align="center"><u><b><font size="14">LAPORAN ENTRY JURNAL</b></u></font>
                    <br><br>
                    <font size="10">PERIODE: '.$periode.'</font></p>
                    

             
                    
                    <table style="border-collapse: collapse; width: 100%;" border="1">
                        <tbody>
                            <tr style="background-color: #87cefa;height: 18px;">
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">Tanggal</td>
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">Keterangan</td>
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">No Akun</td>
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">Nama Akun</td>
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">No Jurnal</td>
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">Debit</td>
                                <td style="width: 14.2857%; text-align: center; line-height: 18px;">Kredit</td>
                            </tr>
                            

                            ';

                            $tgl_awal   = $this->input->post('tgl_awal');
                            $tgl_akhir  = $this->input->post('tgl_akhir');   

                            $text = "select c.no_jurnal,b.tanggal,b.keterangan,a.kode,a.nama,c.debit,c.kredit from dt_mastercoa a, dt_jurnal_masuk b, dt_jurnal_masuk_detail c 
                            where a.mastercoa_id=c.mastercoa_id and b.tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
                            and b.tipe_jurnal in(1,2) and b.no_jurnal=c.no_jurnal 
                           ";
                           
                            $data = array( 
                                'bukajalan'				=> $this->Laporan_Entry_Model->manualQuery($text),		
                            ); 
                            
                            foreach($data['bukajalan']->result_array() as $db){  

                            
                            $html .= '
                            <tr style="height: 18px;">

                                <td style="width: 14.2857%; line-height: 18px;text-align: center">'.date('d F Y', strtotime($db['tanggal'])).'</td> 
                                <td style="width: 14.2857%; line-height: 18px;text-align: left">'.$db['keterangan'].'</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: center">'.$db['kode'].'</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: left">'.$db['nama'].'</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: center">'.$db['no_jurnal'].'</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: right">'.number_format($db['debit']).'</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: right">'.number_format($db['kredit']).'</td>

                                </tr>

                                ';

                                




                        
                            }


                            $html .= '
                            <tr style="line-height: 18px;background-color: #87cefa">

                              
                                <td colspan="5" style="text-align: center;line-height: 18px">TOTAL</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: right;font-size: 12px">'.number_format($totdebit).'</td>
                                <td style="width: 14.2857%; line-height: 18px;text-align: right;font-size: 12px">'.number_format($totkredit).'</td>

                                </tr>

                                

                                ';


                       
                            $html .= '
                            
                            
                        </tbody>
                    </table>';
                    
                        

                
                

                    
            
                    $pdf->writeHTML($html, true, true, true, false, '');
                    
                    $pdf->lastPage();
            
                    ;
                            
            
                    //$pdf->writeHTML($html, true, false, true, false, '');
                    $pdf->Output('Laporan Entry Jurnal.pdf', 'I');
    }
}

	

