<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
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
		if($this->session->userdata('isLogin') == TRUE)
		{
			redirect('Dashboard');
		}
		$this->load->view('login');
	}
	public function login()
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
			$cek = $this->models->jumlah_data_where('admin', $where);
			if($cek == 1)
			{
        		$data['admin']=$this->models->get_admin_data_by_username($username);
        		foreach ($data['admin'] as $a) {
					if (md5($password)==$a->admin_password){
						$this->session->set_userdata('isLogin', TRUE);
						$this->session->set_userdata('username',$a->username);
						$this->session->set_userdata('nik',$a->nik);
						$this->session->set_userdata('admin_id',$a->admin_id);
						$this->session->set_userdata('name',$a->admin_name);
						//SESSION USER
						$this->session->set_userdata('UsrisLogin', TRUE);
						$this->session->set_userdata('usrusername',$a->username);
						$this->session->set_userdata('usrnik',$a->nik);
						$this->session->set_userdata('usremail',$a->email);
						$this->session->set_userdata('usrname',$a->admin_name);
						redirect('dashboard');
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
			$data['id'] = $this->models->get_data_where('admin', array('admin_id' =>$this->session->userdata('admin_id')));
			$this->load->view('change_password',$data);
		}
	}
	function change_password_process()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
		$admin_id = $this->input->post('admin_id');
    	$this->form_validation->set_rules('old_password', 'old_password', 'required', array('required' => 'Old Password Required'));
    	if ($this->form_validation->run('old_password') == TRUE)
    	{
    		$_POST['old_password'] = md5($this->input->post('old_password'));
    	}
    	$this->form_validation->set_rules('op', 'op', 'required|matches[old_password]', array('required' => 'Confirm Password Required','matches' => 'Old passwords do not match<br>'.$this->input->post('op').'<br>'.$this->input->post('old_password')));
		//$this->form_validation->set_rules('md5_old_password', 'md5_old_password', 'matches[confirm_old_password]', array('matches' => 'Old passwords do not match<br>'.$this->input->post('confirm_old_password').'<br>'.$this->input->post('md5_old_password')));
    	$this->form_validation->set_rules('new_password', 'new_password', 'required|min_length[6]|max_length[20]', array('required' => 'New Password Required', 'min_length' => 'New Password Minimal 6 Karakter', 'max_length' => 'New Password Maksimal 20 Karakter'));
    	$this->form_validation->set_rules('confirm_new_password', 'confirm_new_password', 'required|matches[new_password]', array('required' => 'Confirm Password Required','matches' => 'New passwords do not match'));
        if ($this->form_validation->run() == TRUE){
        	$new_password = md5($this->input->post('new_password'));
			$data = array(
				'password' =>$new_password
				);
			// insert form data into database
			$this->models->update_data(array('admin_id' => $admin_id),$data,'admin');
			$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Password Has Been Changed</div>');
            redirect('auth/logout');
        }
		else {
			$this->change_password();
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
        redirect('Auth');
	}
}
