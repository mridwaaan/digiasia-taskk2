<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
        if($this->agent->is_browser('Internet Explorer')) // Internet explorer older than i.e 9
        {
            redirect("forbidden"); //Redirect, load view, echo, whatever you want to do
        }
		if($this->session->userdata('isLogin') == FALSE)
		{
			redirect('auth');	
		}
		$this->load->model('models');
	}
	public function index()
	{
		$where = array('status' => 0);
		$data['qty_new_request'] = $this->models->jumlah_data_where('request', $where);
		$data['qty_karyawan'] = $this->models->jumlah_data('karyawan');
		$data['qty_admin'] = $this->models->jumlah_data('admin');
		$data['request'] = $this->models->get_new_request_data();
		$data['karyawan'] = $this->models->get_new_employee_data();
		$this->load->view('dashboard1',$data);
	}
}
