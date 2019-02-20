<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan extends CI_Controller {
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
		$data['karyawan'] = $this->models->get_employee_data();
		$this->load->view('karyawan',$data);
	}
	function add_karyawan()
	{
		$data['site'] = $this->models->get_data('site');
		$this->load->view('form_karyawan',$data);
	}
	function insert_karyawan()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
    	$this->form_validation->set_rules('name', 'name', 'required|max_length[50]', array('required' => 'Name required', 'max_length' => 'Name maximum 50 characters'));
    	$this->form_validation->set_rules('site_id', 'site_id', 'required', array('required' => 'Office Site required'));
    	$this->form_validation->set_rules('dept', 'dept', 'required|max_length[50]', array('required' => 'Name required', 'max_length' => 'Name maximum 50 characters'));
    	$this->form_validation->set_rules('username', 'username', 'required|max_length[30]|is_unique[karyawan.username]', array('required' => 'Username required', 'max_length' => 'Username maximum 30 characters', 'is_unique' => 'Username has been registered'));
    	$this->form_validation->set_rules('email', 'email', 'required|max_length[50]', array('required' => 'Email required', 'max_length' => 'Email maximum 50 characters'));
    	$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]', array('required' => 'Password required', 'min_length' => 'Password minimum 6 characters', 'max_length' => 'Password maksimum 20 characters'));
    	$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('required' => 'Confirm Password required','matches' => 'Confirm Password do not match'));
        if ($this->form_validation->run() == TRUE){
		$data = array(
			'username' =>$this->input->post('username'),
			'name' =>$this->input->post('name'),
			'site_id' =>$this->input->post('site_id'),
			'dept' =>$this->input->post('dept'),
			'email' =>$this->input->post('email'),
			'password' =>md5($this->input->post('password'))
			);
			// insert form data into database
			$this->models->add_data($data,'karyawan');
            redirect('karyawan');
        }
		else {
			$this->add_karyawan();
		}
	}
	function update_karyawan()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
		$nik = $this->input->post('nik');
    	$this->form_validation->set_rules('name', 'name', 'required|max_length[50]', array('required' => 'Name required', 'max_length' => 'Name maximum 50 characters'));
    	$this->form_validation->set_rules('site_id', 'site_id', 'required', array('required' => 'Office Site required'));
    	$this->form_validation->set_rules('dept', 'dept', 'required|max_length[50]', array('required' => 'Department required', 'max_length' => 'Department maximum 50 characters'));
    	$this->form_validation->set_rules('email', 'email', 'required|max_length[50]', array('required' => 'Email required', 'max_length' => 'Email maximum 50 characters'));
    	if ($this->input->post('password')!="" OR $this->input->post('confirm_password')!="") {
    		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]', array('required' => 'Password Required', 'min_length' => 'Password minimum 6 characters', 'max_length' => 'Password maximum 20 characters'));
    		$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('required' => 'Confirm Password required','matches' => 'Confirm Password do not match'));
    	}
        if ($this->form_validation->run() == TRUE){
	        
	        if ($this->input->post('password')!="") 
	        {
	        	$data = array(
					'name' =>$this->input->post('name'),
					'site_id' =>$this->input->post('site_id'),
					'dept' =>$this->input->post('dept'),
					'email' =>$this->input->post('email'),
					'password' =>md5($this->input->post('password'))
					);
	        } else 
	        {
				$data = array(
					'name' =>$this->input->post('name'),
					'site_id' =>$this->input->post('site_id'),
					'dept' =>$this->input->post('dept'),
					'email' =>$this->input->post('email')
					);
	        }
	        // Update form data into database
		    $where = array('nik' => $nik);
			$this->models->update_data($where,$data,'karyawan');
		    redirect('karyawan');
        }
		else {
			$this->edit_karyawan($nik);
		}
	}
	function edit_karyawan($nik)
	{
		$where=array('nik' => $nik);
		$data['site'] = $this->models->get_data('site');
		$data['karyawan'] = $this->models->get_data_where('karyawan',$where);
		$this->load->view('form_karyawan_edit',$data);
	}
	function delete_karyawan(){
		$nik=$this->input->post('nik');
		$where = array('nik' =>$nik);
		$this->models->delete_data($where,'karyawan');
		$this->models->delete_data($where,'admin');
		redirect('karyawan');
	}
}
?>