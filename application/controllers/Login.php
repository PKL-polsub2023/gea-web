<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('menu_helper');
		$this->load->model('M_login');
		//$this->load->model('Dashboard_Model');
	}



	function index(){
		$this->load->view('layout/login');
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		if($role == "akuntan"){
			$where = array(
				'username' => $username,
				'password' => md5($password),
				'role' => 'akuntan'
				);
			$cek = $this->M_login->cek_login("dt_user",$where);
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
	 
				$data_session = array(
					'nama' => $row["username"],
					'status' => "login",
					'role'=>$row["role"],
					);
	 
				$this->session->set_userdata($data_session);
				redirect(base_url("dashboard"));
			}else{
				echo "Role Akuntan : Username dan password salah !";
			}
		}else if($role == "admin"){
			$where = array(
				'username' => $username,
				'password' => md5($password),
				'role' => 'admin'
				);
			$cek = $this->M_login->cek_login("dt_user",$where);
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
	 
				$data_session = array(
					'nama' => $row["username"],
					'status' => "login",
					'role'=>$row["role"],
					);
	 
				$this->session->set_userdata($data_session);
				redirect(base_url("admin"));
			}else{
				echo "Role Admin : Username dan password salah !";
			}
		}else{
			$where = array(
				'username' => $username,
				'password' => md5($password),
				'role' => 'pimpinan'
				);
			$cek = $this->M_login->cek_login("dt_user",$where);
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
	 
				$data_session = array(
					'nama' => $row["username"],
					'status' => "login",
					'role'=>$row["role"],
					);
	 
				$this->session->set_userdata($data_session);
				redirect(base_url("pimpinan"));
			}else{
				echo "Role Pimpinan : Username dan password salah !";
			}
		}
		
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login')); 
	}
}



