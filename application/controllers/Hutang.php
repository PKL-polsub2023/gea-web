<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Hutang_model');
            $this->load->model('Datakwitansi_model');
            $this->load->model('Master_Supplier_Model');
        $this->load->library('session');
	}

	public function index()
	{     
        $data = array( 
            'datamaster'		=> $this->Hutang_model->Lihatmaster(),
            'supplier' => $this->Master_Supplier_Model->Lihatmaster(),
        );

        $role = $this->session->userdata('role');
        
        if($role == "akuntan"){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/hutang/index',$data);
            $this->load->view('layout/footer');
        }else{
            $this->load->view('pimpinan/header');
            $this->load->view('pimpinan/sidebar');
            $this->load->view('pimpinan-content/hutang/index',$data);
            $this->load->view('pimpinan/footer');
        }
	 
	} 


    public function ubah($id){		

      $data = array( 
            //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            'edit'		        => $this->Datakwitansi_model->ubah($id)
        ); 
	
      //   $data = array( 
      //       //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
      //       'edit'		        => $this->Hutang_model->ubah($id)
      //   ); 
	
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/hutang/edit', $data);
        $this->load->view('layout/footer');
	}


    public function ubahsimpan()
	{
        $id =  $this->input->post("datakwitansi_id");

		$data = array(
                  'volumegas'       => $this->input->post('volumegas'),
		);
		$this->db->where("datakwitansi_id", $id); // ubah id dan postnya
		$this->db->update("dt_datakwitansi", $data);
		redirect('hutang');
	}

    public function hapus($id){
		if($this->Hutang_model->hapus($id)){
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
            redirect("hutang");
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
                  WHERE suratjalan_customer_id = '".$suratjalan_customer_id."'
            ");
            foreach($query->result() as $row){
                  $hasil = array(
                        'suratjalan_customer_id' => $row->suratjalan_customer_id,
                        'tanggalkirim' => $row->tanggalkirim,
                  );
            }
            echo json_encode($hasil);
      }


      public function detail($id){		

            // $data = array( 
            //     //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
            //     'edit'		        => $this->Hutang_model->ubah($id)
            // ); 
            $data = array( 
                  //'saldoawal'       => $this->Saldo_Awal_Model->lihat_no_jurnal($no_jurnal),
                  'edit'		        => $this->Datakwitansi_model->ubah($id)
              ); 

            $role = $this->session->userdata('role');
        
            if($role == "akuntan"){
                  $this->load->view('layout/header');
                  $this->load->view('layout/sidebar');
                  $this->load->view('admin/hutang/detail', $data);
                  $this->load->view('layout/footer');
            }else{
                  $this->load->view('pimpinan/header');
                  $this->load->view('pimpinan/sidebar');
                  $this->load->view('pimpinan-content/hutang/detail', $data);
                  $this->load->view('pimpinan/footer');
            }
          
          
          }

      
          public function faktur($id)
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
          $getData = $this->Datakwitansi_model->ubah($id);
          function terbilang($angka)
          {
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
    
          $total = $getData['total']; 
          $total_terbilang = ucwords(terbilang($total));
          $total_rupiah = "Rp " . number_format($total, 0, ',', '.');
    
          $tanggal = $this->input->post('tanggal');
          $tanggal1 = explode("-", $tanggal);
          $tanggal2 = $tanggal1[2]."-".$bulam[$tanggal1[1]]."-".$tanggal1[0];
          $dd = $this->input->post('dd');
          $dd1 = explode("-", $dd);
          $dd2 = $dd1[2]."-".$bulam[$dd1[1]]."-".$dd1[0];

          $date = $getData['tanggal'];
          $date1 = explode("-", $date);
          $date2 = $date1[2]."-".$bulam[$date1[1]]."-".$date1[0];
          $data = array(
                'u' => $getData,
                'total' => $total,
                'terbilang' => $total_terbilang,
                'no_invoice' => $this->input->post('no_invoice'),
                'tanggal' => $tanggal2,
                'dd' => $dd2,
                'date2' => $date2,
                'rupiah' => $total_rupiah,
          );


           
             $mpdf = new \Mpdf\Mpdf(
                  [
                        'mode' => 'utf-8', 
                        'format' => 'Legal',
                    ]
             );

            $data['judul'] = $data['no_invoice'];
            $data['isi'] = 'Ini adalah isi contoh untuk file PDF.';

            $html = $this->load->view('admin/hutang/faktur', $data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Faktur-'.$data['no_invoice'].'.pdf', 'I');

          
      //     $this->load->view('admin/hutang/faktur', $data);
          }

          public function selectInvoice()
          {
            //     $fromdate =  $this->input->post('fromdate');
            //     $todate =  $this->input->post('todate');
                $mastersupplier_id =  $this->input->post('mastersupplier_id');
                $namaspbg = $this->Master_Supplier_Model->ubah($mastersupplier_id);
                $spbg = $namaspbg['namaspbg'];

                $jumlahHutang = $this->Datakwitansi_model->count($mastersupplier_id);
    
                $data = [
                  'datamaster' => $this->Datakwitansi_model->selectInvoice($mastersupplier_id),
                  'mastersupplier_id' => $mastersupplier_id,
                  'spbg' =>  $spbg,
                  'jumlahHutang' => $jumlahHutang,
            ];
            
              
                $this->load->view('layout/header');
                $this->load->view('layout/sidebar');
                $this->load->view('admin/hutang/selectInvoice',$data);
                $this->load->view('layout/footer');
    
          }

          public function invoice(){
            $mastersupplier_id =  $this->input->post('mastersupplier_id');
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


            $detailData =  $this->Master_Supplier_Model->ubah($mastersupplier_id);
            $getData =  $this->Datakwitansi_model->selectInvoice($mastersupplier_id);
      
         
            $total = 0;

            foreach ($getData as $invoice) {
            if (isset($invoice['total'])) {
                  $total += $invoice['total'];
                  $invoice['total'] = "Rp " . number_format($invoice['total'], 0, ',', '.');
            } 
            $datamaster[] = $invoice;
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
            $total_rupiah = "Rp " . number_format($total, 0, ',', '.');
            $tanggal = $this->input->post('tanggal');
            $tanggal1 = explode("-", $tanggal);
            $tanggal2 = $tanggal1[2]."-".$bulam[$tanggal1[1]]."-".$tanggal1[0];
            $dd = $this->input->post('dd');
            $dd1 = explode("-", $dd);
            $dd2 = $dd1[2]."-".$bulam[$dd1[1]]."-".$dd1[0];


            $data = array(
                  'datamaster' =>  $datamaster,
                  'total' => $total_rupiah,
                  'terbilang' => $total_terbilang,
                  'detail' => $detailData,
                  'no_invoice'=>$this->input->post('no_invoice'),
                  'tanggal'=>$tanggal2,
                  'dd'=>$dd2,
            );
          

            $this->load->view('admin/hutang/pdfinvoice',$data);
      
      }

}



