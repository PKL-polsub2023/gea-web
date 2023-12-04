<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('Dashboard_Model');
	}

	public function index()
	{
	    
	      $data = array( 
		
			'totaljurnalmasuk'		=> $this->Dashboard_Model->totaljurnalmasuk(),
			'totaljurnalkeluar'		=> $this->Dashboard_Model->totaljurnalkeluar(),
			'lapdebit'		        => $this->Dashboard_Model->lapdebit(),
			'lapkredit'		        => $this->Dashboard_Model->lapkredit(),
        );
        
		$this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/content',$data);
        $this->load->view('layout/footer');
	}

	public function test()
	{
		$this->load->view('test');
	}
}
