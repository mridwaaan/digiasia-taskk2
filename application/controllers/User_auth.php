<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_auth extends CI_Controller {
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
		if($this->session->userdata('UsrisLogin') == TRUE)
		{
			redirect('My_request');
		}
		$this->load->view('user_login');
	}
	public function user_login()
	{
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run()==FALSE)
		{
			$this->index();
		} else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array('username' => $username);
			$cek = $this->models->jumlah_data_where('karyawan', $where);
			if($cek == 1)
			{
        		$data['karyawan']=$this->models->get_data_where('karyawan', $where);
        		foreach ($data['karyawan'] as $k) {
					if (md5($password)==$k->password){
						$this->session->set_userdata('UsrisLogin', TRUE);
						$this->session->set_userdata('usrusername',$k->username);
						$this->session->set_userdata('usrnik',$k->nik);
						$this->session->set_userdata('usremail',$k->email);
						$this->session->set_userdata('usrname',$k->name);
						redirect('My_request');
					}
					else
					{
						echo " <script>
						alert('Failed Login: Username or Password is invalid');
						history.go(-1);
						</script>";
					}
				}
			}
			else
			{
				echo " <script>
				alert('Failed Login: Username or Password is invalid');
				history.go(-1);
				</script>";
			}
		}
	}
	function change_password()
	{
		if($this->session->userdata('UsrisLogin') == FALSE)
        {
            redirect('user_auth');
        } else
        {
			$data['id'] = $this->models->get_data_where('karyawan', array('nik' =>$this->session->userdata('usrnik')));
			$this->load->view('change_password_u',$data);
		}
	}
	function change_password_process()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
		$nik = $this->input->post('nik');
    	$this->form_validation->set_rules('old_password', 'old_password', 'required', array('required' => 'Old Password required'));
    	if ($this->form_validation->run('old_password') == TRUE)
    	{
    		$_POST['old_password'] = md5($this->input->post('old_password'));
    	}
    	$this->form_validation->set_rules('op', 'op', 'matches[old_password]', array('matches' => 'Old passwords do not match'));
    	$this->form_validation->set_rules('new_password', 'new_password', 'required|min_length[6]|max_length[20]', array('required' => 'New Password Required', 'min_length' => 'New Password minimum 6 characters', 'max_length' => 'New Password maximum 20 characters'));
    	$this->form_validation->set_rules('confirm_new_password', 'confirm_new_password', 'required|matches[new_password]', array('required' => 'Confirm Password required','matches' => 'New passwords do not match'));

        if ($this->form_validation->run() == TRUE){
        	$new_password = md5($this->input->post('new_password'));
			$data = array(
				'password' =>$new_password
				);
			// insert form data into database
			$this->models->update_data(array('nik' => $nik),$data,'karyawan');
			$this->session->sess_destroy();
			$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Password has been changed</div>');
			redirect('User_auth');	
        }
		else {
			$this->change_password();
		}
	}
	function logout()
	{
		$this->session->unset_userdata('UsrisLogin');
		$this->session->sess_destroy();
        redirect('User_auth');
	}
}
