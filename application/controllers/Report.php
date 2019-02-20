<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller {
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
	function index()
    {
        $data['request'] = $this->models->get_request_null_data();
        $data['site'] = $this->models->get_data('site');
        $this->load->view('report',$data);
    }
    function excel_export()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $where = array(
                        'type' =>$this->input->post('type'),
                        'k.site_id' =>$this->input->post('site_id')
                    );
        $date_range = array(
                        'system_date >=' => $this->input->post('start_date'),
                        'system_date <=' => $this->input->post('end_date')
                    );
        $data['request'] = $this->models->get_request_done_filter_data($where,$date_range,$this->input->post('type'),$this->input->post('site_id'));
		$date_req['start'] = $start_date;
		$date_req['end'] = $end_date;
        $data['date_req']=$date_req;

        $data['site'] = $this->models->get_data('site');
        $this->load->view('excel_report',$data);
    }
}