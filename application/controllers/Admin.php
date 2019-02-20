<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
		$data['admin'] = $this->models->get_admin_data();
		$this->load->view('admin',$data);
	}
	function add_admin()
	{
		$this->load->view('form_admin');
	}
	function insert_admin()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
    	$this->form_validation->set_rules('username', 'username', 'required|max_length[30]|is_unique[admin.username]', array('required' => 'Username Required', 'max_length' => 'Username maximum 30 characters', 'is_unique' => 'Username has been registered as Admin'));
    	if ($this->form_validation->run('username') == TRUE)
        {
            $_POST['vrf_username'] = $this->models->jumlah_data_where('karyawan', array('username' => $this->input->post('username')));
        }
        $this->form_validation->set_rules('vrf_username', 'vrf_username', 'greater_than_equal_to[1]', array('greater_than_equal_to' => 'This username is not registered in Employee Master'));
        /*
    	$this->form_validation->set_rules('name', 'name', 'required|max_length[50]', array('required' => 'Name Required', 'max_length' => 'Name maximum 50 characters'));
    	$this->form_validation->set_rules('email', 'email', 'required|max_length[50]|is_unique[admin.email]', array('required' => 'Email Required', 'max_length' => 'Email maximum 50 characters','is_unique' => 'Email has been registered'));
		*/
    	$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]', array('required' => 'Password Required', 'min_length' => 'Password minimum 6 characters', 'max_length' => 'Password maximum 20 characters'));
    	$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('required' => 'Confirm Password Required','matches' => 'Confirm Password do not match'));
        if ($this->form_validation->run() == TRUE){
        
		$data = array(
			'username' =>$this->input->post('username'),
			'password' =>md5($this->input->post('password'))
			);
			// insert form data into database
			$this->models->add_data($data,'admin');
            redirect('admin');
        }
		else {
			$this->add_admin();
		}
	}
	function update_admin()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
    	$this->form_validation->set_rules('name', 'name', 'required|max_length[50]', array('required' => 'Name Required', 'max_length' => 'Name maximum 50 characters'));
    	//$this->form_validation->set_rules('email', 'email', 'required|max_length[50]|is_unique[admin.email]', array('required' => 'Email Required', 'max_length' => 'Email Maksimal 50 Karakter','is_unique' => 'Email Telah Terdaftar'));
    	if ($this->input->post('password')!="" OR $this->input->post('confirm_password')!="") {
    		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]', array('required' => 'Password Required', 'min_length' => 'Password minimum 6 characters', 'max_length' => 'Password maximum 20 characters'));
    		$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('required' => 'Confirm Password Required','matches' => 'Confirm Password do not match'));
    	}
        if ($this->form_validation->run() == TRUE){
        $admin_id = $this->input->post('admin_id');
        if ($this->input->post('password')!="") {
			$data = array(
				'password' =>md5($this->input->post('password'))
				);
		} else{
			$data = array(
				);
		}
			// insert form data into database
			$where = array('admin_id' => $admin_id);
			$this->models->update_data($where,$data,'admin');
            redirect('admin');
        }
		else {
			$this->edit_admin($this->input->post('admin_id'));
		}
	}
	function edit_admin($admin_id)
	{
		$data['admin'] = $this->models->get_admin_data_by_id($admin_id);
		$this->load->view('form_admin_edit',$data);
	}
	function delete_admin(){
		$admin_id=$this->input->post('admin_id');
		$where = array('admin_id' =>$admin_id);
		$this->models->delete_data($where,'admin');
		redirect('admin');
	}
}