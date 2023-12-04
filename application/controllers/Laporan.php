<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Laporan_model');
	}

	public function index()
	{
		//$this->load->view('main_page');
		show_error("Tersesat ya? kembali kejalan yang benar ya...!");
	}

	public function bukubesar()
	{
		# code untuk menampilkan halaman buku besar	
		$this->load->view('laporan/buku-besar');
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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);
		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);
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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);
		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);

		$this->load->view('laporan/buku-besar-pdf',$data);
	}

	public function neracasaldo()
	{
		# code untuk menampilkan halaman neraca saldo
		$this->load->view('laporan/neraca-saldo');
	}

	public function neracasaldo_view()
	{
		# code untuk menampilkan data dari neraca saldo
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$yearFromDate = date('Y', strtotime($fromDate));
		$data['periode'] = $yearFromDate;
		$data['subjudul'] = date('d M Y', strtotime($fromDate)) . ' sampai dengan ' . date('d M Y', strtotime($toDate));

		// mengambil data kode dari mastercoa
		$kode = [];
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);
		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);
		$this->load->view('laporan/neraca-saldo-view', $data);
	}

	public function neracasaldo_pdf()
	{
		# code untuk menampilkan data dari neraca saldo
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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);
		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);
		$this->load->view('laporan/neraca-saldo-pdf', $data);
	}

	public function neraca()
	{
		# code untuk menampilkan halaman neraca
		$this->load->view('laporan/neraca');
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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);

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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);

		$this->load->view('laporan/neraca-pdf', $data);
	}

	public function labarugi()
	{
		# code untuk menampilkan halaman laba rugi
		$this->load->view('laporan/laba-rugi');
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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);
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
		$data_kode = $this->Laporan_model->get_MasterCoa();
		$data['dtMasterCoa'] = $data_kode;

		foreach ($data_kode as $dk) {
			$kode[] = $dk['kode'];
		}

		$kode = implode(',', $kode);

		// mengambil data saldo awal dengan query yang sudah didefinisikan di model
		$data['saldoAwal'] = $this->Laporan_model->getSaldoAwal_ByKode($yearFromDate);
		$data['dt'] = $this->Laporan_model->getdataBukuBesar($fromDate, $toDate, $kode);
		$this->load->view('laporan/laba-rugi-pdf', $data);
	}
}
