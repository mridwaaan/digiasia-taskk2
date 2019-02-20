<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_u extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
        if($this->agent->is_browser('Internet Explorer')) // Internet explorer older than i.e 9
        {
            redirect("forbidden"); //Redirect, load view, echo, whatever you want to do
        }
		if($this->session->userdata('UsrisLogin') == FALSE)
		{
			redirect('user_auth');	
		}
		$this->load->model('models');
	}
	public function index()
	{
		$where = array('status' => 0);
		$data['new_request'] = $this->models->jumlah_data_where('request', $where);
		$this->load->view('dashboard_u',$data);

	}
}
