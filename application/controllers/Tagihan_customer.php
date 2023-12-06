<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_customer extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Tagihan_customer_model');
        $this->load->library('session');
        
        $this->load->library('Pdf');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Tagihan_customer_model->Lihatmaster()
        );

        $role = $this->session->userdata('role');

        if($role == "admin")
        {
            $this->load->view('aadmin_layout/header');
            $this->load->view('aadmin_layout/sidebar');
            $this->load->view('aadmin_item/tagihan_customer/index',$data);
            $this->load->view('aadmin_layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan_item/tagihan_customer/index',$data);
            $this->load->view('pimpinan/footer');
        }
		
	} 


    public function tambah()
	{
		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/tagihan_customer/tambah');
        $this->load->view('aadmin_layout/footer'); 
	} 

    public function simpan()
	{      
      
        $data=array(
                    'mastercustomer_id'       => $this->input->post('mastercustomer_id'),
                    'suratjalan_customer_id'       => $this->input->post('suratjalan_customer_id'),
                    
                    'tekananawal'       => $this->input->post('tekananawal'),
                    'tekananakhir'       => $this->input->post('tekananakhir'),
                    'volumeberangkat'       => $this->input->post('volumeberangkat'),
                    'preasure'       => $this->input->post('preasure'),
                    'meterawal'       => $this->input->post('meterawal'),
                    'meterakhir'       => $this->input->post('meterakhir'),
                    'bbm'       => $this->input->post('bbm'),
                    'ritase'       => $this->input->post('ritase'),
                    // 'total'       => $this->input->post('total'),
                );      
            
        $this->db->insert('dt_tagihan_customer', $data);             
        
		redirect('tagihan_customer');
	}




    public function ubah($id){		

        $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Tagihan_customer_model->ubah($id)
        ); 
	
        $this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_item/tagihan_customer/edit', $data);
        $this->load->view('aadmin_layout/footer');
	}


    public function ubahsimpan()
	{
        $id =  $this->input->post("tagihan_customer_id");

		$data = array(
                  'mastercustomer_id'       => $this->input->post('mastercustomer_id'),
                  'suratjalan_customer_id'       => $this->input->post('suratjalan_customer_id'),
                  
                  'tekananawal'       => $this->input->post('tekananawal'),
                  'tekananakhir'       => $this->input->post('tekananakhir'),
                  'volumeberangkat'       => $this->input->post('volumeberangkat'),
                  'preasure'       => $this->input->post('preasure'),
                  'meterawal'       => $this->input->post('meterawal'),
                  'meterakhir'       => $this->input->post('meterakhir'),
                  'bbm'       => $this->input->post('bbm'),
                  'ritase'       => $this->input->post('ritase'),
                //   'total'       => $this->input->post('total'),
		);
		$this->db->where("tagihan_customer_id", $id); // ubah id dan postnya
		$this->db->update("dt_tagihan_customer", $data);
		redirect('tagihan_customer');
	}

    public function hapus($id){
		if($this->Tagihan_customer_model->hapus($id)){
			$this->session->set_flashdata('success', 'rekening <strong>Berhasil</strong> Dihapus!');
			redirect('tagihan_customer');
		} else {
			$this->session->set_flashdata('error', 'rekening <strong>Gagal</strong> Dihapus!');
			redirect('tagihan_customer');
		}
	}

      public function validasi_y($id){
            $data = array(
                  "status" => "Y"
            );

            $this->db->where("datakwitansi_id", $id);
            $this->db->update("dt_datakwitansi", $data);
            redirect("data_kwitansi");
      }

      public function validasi_n($id){
            $data = array(
                  "status" => "N"
            );

            $this->db->where("datakwitansi_id", $id);
            $this->db->update("dt_datakwitansi", $data);
            redirect("data_kwitansi");
      }


      public function ambilData(){
            $suratjalan_customer_id = $this->input->post("suratjalan_customer_id");
            $query = $this->db->query("
                  SELECT * FROM dt_suratjalan_customer 
                  JOIN dt_datakwitansi ON dt_datakwitansi.datakwitansi_id = dt_suratjalan_customer.datakwitansi_id 
                  WHERE suratjalan_customer_id = '".$suratjalan_customer_id."'
            ");
            foreach($query->result() as $row){
                  $hasil = array(
                        'suratjalan_customer_id' => $row->suratjalan_customer_id,
                        'tanggalkirim' => $row->tanggalkirim,
                        'total' => $row->total,
                  );
            }
            echo json_encode($hasil);
      }

      function pdf($tagihan_customer_id){      
        $this->load->model('Piutang_Model');
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
              <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td></td>
                    <td><h1>SURAT JALAN</h1></td>
                    <td>Kantor : Jl. Raya Otista No. 138 Karanganyar Subang No Telp: 02604250402</td>
                </tr>
              </table>
        ';

        echo $html;
  
        //$pdf->writeHTML($html, true, true, true, false, '');
        
        //$pdf->lastPage();
  
        
  
        //$pdf->writeHTML($html, true, false, true, false, '');
        //$pdf->Output('Beritaacara.pdf', 'I');
    }




}



