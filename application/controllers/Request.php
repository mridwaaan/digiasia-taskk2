<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
        if($this->agent->is_browser('Internet Explorer')) // Internet explorer older than i.e 9
        {
            redirect("forbidden"); //Redirect, load view, echo, whatever you want to do
        }
		$this->load->model('models');
	}
	public function index()
	{
		$this->load->view('send_request');
	}
	function send_request()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
    	$this->form_validation->set_rules('nik', 'nik', 'required|max_length[15]', array('required' => 'NIK required', 'max_length' => 'NIK maximum 15 characters'));
    	if ($this->form_validation->run('nik') == TRUE)
		{
			$_POST['vrf_nik'] = $this->models->jumlah_data_where('karyawan', array('nik' => $this->input->post('nik')));
		}
		$this->form_validation->set_rules('vrf_nik', 'vrf_nik', 'greater_than_equal_to[1]', array('greater_than_equal_to' => 'You are not registered'));
    	$this->form_validation->set_rules('system', 'System', 'required|max_length[15]', array('required' => 'System Required', 'max_length' => 'System Maksimal 15 Karakter'));

		$_POST['vrf_request'] = $this->models->jumlah_data_where('request', array('nik' => $this->input->post('nik'), 'system' => $this->input->post('system'), 'status' => 0));
		$this->form_validation->set_rules('vrf_request', 'vrf_request', 'less_than_equal_to[0]', array('less_than_equal_to' => 'You Have Requested ID For This System, Please Wait Until Admin Process It'));

		$vrf_request_done = $this->models->jumlah_data_where('request', array('nik' => $this->input->post('nik'), 'system' => $this->input->post('system'), 'status' => 1));
		$_POST['vrf_request_done'] = $vrf_request_done;
		if ($vrf_request_done=1) {
		$data['request_done']=$this->models->get_data_where('request', array('nik' => $this->input->post('nik'), 'system' => $this->input->post('system'), 'status' => 1));
		foreach ($data['request_done'] as $rd):
			$this->form_validation->set_rules('vrf_request_done', 'vrf_request_done', 'less_than_equal_to[0]', array('less_than_equal_to' => 'Admin Has Sent ID & Password To Your Email. If There Is No Email From Us Yet, <a href="'.base_url().'requestor/resend/'.$rd->request_id.'"><b>Click Here To Resend It</b></a>'));
		endforeach;
		}
        if ($this->form_validation->run() == TRUE){
		$data = array(
			'nik' => $this->input->post('nik'),
			'system' => $this->input->post('system'),
			'description' => $this->input->post('description')
			);
			// insert form data into database
			$this->models->add_data($data,'request');
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Request Has Been Sent</div>');
            redirect('request');
        }
		else {
			$this->index();
		}
	}
}