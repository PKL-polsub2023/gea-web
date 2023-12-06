<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('Admin_Model');
	}

	public function index()
	{
	    
	//       $data = array( 
		
	// 		'totaljurnalmasuk'		=> $this->Dashboard_Model->totaljurnalmasuk(),
	// 		'totaljurnalkeluar'		=> $this->Dashboard_Model->totaljurnalkeluar(),
	// 		'lapdebit'		        => $this->Dashboard_Model->lapdebit(),
	// 		'lapkredit'		        => $this->Dashboard_Model->lapkredit(),
      //   );
        
		$this->load->view('pimpinan/header');
        $this->load->view('pimpinan/sidebar');
        $this->load->view('pimpinan/content');
        $this->load->view('pimpinan/footer');
	}

	public function test()
	{
		$this->load->view('test');
	}
}
