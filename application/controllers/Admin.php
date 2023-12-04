<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        
		$this->load->view('aadmin_layout/header');
        $this->load->view('aadmin_layout/sidebar');
        $this->load->view('aadmin_layout/content');
        $this->load->view('aadmin_layout/footer');
	}

	public function test()
	{
		$this->load->view('test');
	}
}
