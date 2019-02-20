<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Requestor extends CI_Controller {
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
        $this->load->library('Pdf');
	}
    //show new request
	function index()
    {
        $data['request'] = $this->models->get_new_request_data();
        $this->load->view('requestor',$data);
    }
    //show admin request form
    function request_form()
    {
        $this->load->view('request_form');
    }
    //show request done
    function done()
    {
        $data['request'] = $this->models->get_request_null_data();
        $data['site'] = $this->models->get_data('site');
        $this->load->view('requestor_done',$data);
    }
    function request_filter()
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
        $data['site'] = $this->models->get_data('site');
        $this->load->view('requestor_done',$data);
    }
    function report()
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
        $data['site'] = $this->models->get_data('site');
        $this->load->view('report',$data);
    }
    //show form reply request
	function form_send_id($request_id)
	{
		$data['request'] = $this->models->get_request_data($request_id);
		$this->load->view('form_send_id',$data);
	}
    //send reply of a request
	function send_id()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
    	$this->form_validation->set_rules('response', 'response', 'required', array('required' => 'Description required'));
        if (!empty($_FILES['form_file']['name'])) {
            $this->form_validation->set_rules('form_file', 'form_file', 'callback_upload_file');
        }
        if ($this->form_validation->run() == TRUE){
        $data['karyawan']=$this->models->get_data_where('karyawan', array('nik' => $this->input->post('requested_by')));
        foreach ($data['karyawan'] as $k) {
            $email = $k->email;
        }
        $request_no = $this->input->post('request_no');
        $sbjct = $this->input->post('subject');
        $description = $this->input->post('description');
        $response = $this->input->post('response');
        $id = $this->input->post('id');
        $password =$this->input->post('password');
        if (!empty($_FILES['form_file']['name'])) {
            $form_file = $this->upload->data();
    		$data = array(
    			'response' => $response,
    			'closed_by' => $this->session->userdata('username'),
    			'status' => 1,
                'form_file' => $form_file['file_name']
    			);
            } else {
                $data = array(
                'response' => $response,
                'closed_by' => $this->session->userdata('username'),
                'status' => 1
                );
            }
			// insert form data into database
			$where = array('request_id' =>$this->input->post('request_id'));
			$this->models->update_data($where,$data,'request');
            $this->sendEmail($email,$response,$sbjct,$description,$request_no);
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center"> <i class="fa fa-thumbs-up fa-3x">Sukses Bro</i></div>');
            redirect('requestor');
        }
		else {
			$this->form_send_id($this->input->post('request_id'));
		}
	}
    function upload_file(){
        $config['upload_path'] = './assets/images/form/';
        //$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|JPEG|PDF';
        $config['allowed_types'] = '*';
        $config['max_size'] = '1024'; //maksimum file 1MB
        //$config['max_width'] = ''
        //$config['max_height'] = '';
        //$config['file_name'] = $request_no;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('form_file')) 
        {
            $this->form_validation->set_message(__FUNCTION__, $this->upload->display_errors());
            return FALSE;
        }
        else{
            //$foto = $this->upload->data;
            return TRUE;
        }
    }
    //close request without sending reply
    function close($request_id){
        $data = array(
        	'closed_by' => $this->session->userdata('username'),
            'status' => 1
            );
        $where = array('request_id' =>$request_id);
        $this->models->update_data($where,$data,'request');
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Request Has Been Closed </div>');
        redirect('requestor');
    }
    //admin add request process
    function insert_request()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
        $this->form_validation->set_rules('subject', 'subject', 'required|max_length[100]', array('required' => 'Subject Required', 'max_length' => 'Subject maximum 50 characters'));
        $this->form_validation->set_rules('description', 'description', 'required', array('required' => 'Description Required'));
        /*
        if ($this->form_validation->run('nik') == TRUE)
        {
            $_POST['vrf_nik'] = $this->models->jumlah_data_where('karyawan', array('nik' => $this->input->post('nik')));
        }
        
        $this->form_validation->set_rules('vrf_nik', 'vrf_nik', 'greater_than_equal_to[1]', array('greater_than_equal_to' => 'NIK is not registered'));
        if ($this->input->post('system1')=="" AND $this->input->post('system2')=="") {
            $_POST['vrf_system'] = "";
            $this->form_validation->set_rules('vrf_system', 'vrf_system', 'required', array('required' => 'System required'));
        }

        $data['request_done1']=$this->models->get_data_where('request', array('nik' => $this->input->post('nik')));
        foreach ($data['request_done1'] as $rd1):
            if ($this->input->post('system1')!="") {
                if ($rd1->system1!="") {
                    $_POST['vrf_system_1'] = 1;
                }
            }
            if ($this->input->post('system2')!="") {
                if ($rd1->system2!="") {
                    $_POST['vrf_system_2'] = 1;
                }
            }
            $this->form_validation->set_rules('vrf_system_1', 'vrf_system_1', 'less_than_equal_to[0]', array('less_than_equal_to' => 'You have requested ID for AilisXE system, please wait until admin process it'));
            $this->form_validation->set_rules('vrf_system_2', 'vrf_system_2', 'less_than_equal_to[0]', array('less_than_equal_to' => 'You have requested ID for nSolution system, please wait until admin process it'));
        endforeach;
        */
        ///not used again
        /*
        $this->form_validation->set_rules('system', 'System', 'required|max_length[15]', array('required' => 'System required', 'max_length' => 'System maximum 15 characters'));
        $_POST['vrf_request'] = $this->models->jumlah_data_where('request', array('nik' => $this->input->post('nik'), 'system' => $this->input->post('system'), 'status' => 0));
        $this->form_validation->set_rules('vrf_request', 'vrf_request', 'less_than_equal_to[0]', array('less_than_equal_to' => 'You have requested ID for this system, please wait until admin process it'));

        $vrf_request_done = $this->models->jumlah_data_where('request', array('nik' => $this->input->post('nik'), 'system' => $this->input->post('system'), 'status' => 1));
        $_POST['vrf_request_done'] = $vrf_request_done;
        if ($vrf_request_done=1) {
        $data['request_done']=$this->models->get_data_where('request', array('nik' => $this->input->post('nik'), 'system' => $this->input->post('system'), 'status' => 1));
        foreach ($data['request_done'] as $rd):
            $this->form_validation->set_rules('vrf_request_done', 'vrf_request_done', 'less_than_equal_to[0]', array('less_than_equal_to' => 'Admin has sent ID & Password to your email. If there is no email from us yet, <a href="'.base_url().'requestor/resend/'.$rd->request_id.'"><b>click here to resend it</b></a>'));
        endforeach;
        }
        */
        if ($this->form_validation->run() == TRUE){
        $requested_by = $this->input->post('requested_by');
        $sbjct = $this->input->post('subject');
        $description = $this->input->post('description');
        $data = array(
            'requested_by' => $requested_by,
            'subject' => $sbjct,
            'description' => $description
            );
            // insert form data into database
            $this->models->add_data($data,'request');
            $this->sendEmailToAdmin($sbjct,$description);
            redirect('requestor');
        }
        else {
            $this->request_form();
        }
    }
    //send email to admin when admin make support request
    function sendEmailToAdmin($sbjct,$description){
        $from_email = 'gid.itcj@gmail.com'; //change this to yours
        $subject = 'New Request';
        $message = 'Dear IT Team,<br /><br />There is a new request.<br>Subject : '.$sbjct.' <br>Description : '.$description.' <br /><br /><br /><b><font color="red">Note : Dont Reply This to Email</font></b>';
        //configure email settings
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CJ Logistics'; //bebas sesuai keinginan kamu
        $config['protocol'] = 'smtp';
        $config['smtp_timeout']= '5';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = 'gid.itcj@gmail.com';
        $config['smtp_pass'] = 'CJkx123456'; //$from_email password
        $config['mailtype'] = 'html';
        $config['crlf']='\r\n';
        $config['newline']='\r\n';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from('gid.itcj@gmail.com','CJ');
        $this->email->to('gid-it@cj.net');
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Request has been sent</div>');
        } else {
            show_error($this->email->print_debugger());  
        }
    }
    //send email to requestor when reply the support request
    function sendEmail($to_email,$response,$sbjct,$description,$request_no)
    {
        $from_email = 'gid.itcj@gmail.com'; //change this to yours
        $subject = 'RE:SR ['.$request_no.'] / '.$sbjct;
        $message = ''.$response.' <br /><br /><b><font color="red">Note : Dont Reply This to Email</font></b>';
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CJ Support Request System'; //bebas sesuai keinginan kamu
        $config['protocol'] = 'smtp';
        $config['smtp_timeout']= '5';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = 'gid.itcj@gmail.com';
        $config['smtp_pass'] = 'CJkx123456'; //$from_email password
        $config['mailtype'] = 'html';
        $config['crlf']='\r\n';
        $config['newline']='\r\n';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from('gid.itcj@gmail.com','CJ Support Request System');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());  
        }
    }
    //resend email to reuestor
    function resend($request_id)
    {
        $data['request_done']=$this->models->get_data_where('request', array('request_id' => $request_id));
        foreach ($data['request_done'] as $rd) {
            $id = $rd->id;
            $requested_by = $rd->requested_by;
            $password = $rd->password;
            $sbjct = $rd->subject;
            $description=$rd->description;
                      
        }
        $data['karyawan']=$this->models->get_data_where('karyawan', array('nik' => $requested_by));
        foreach ($data['karyawan'] as $k) {
            $to_email = $k->email;
        }
        $from_email = 'gid.itcj@gmail.com'; //change this to yours
        $subject = 'ID & Password';
        $message = 'Dear User,<br /><br />Here is your ID for:<br>Subject : '.$sbjct.'<br>Description : '.$description.'<br>ID : '.$id.' <br>Password : '.$password.' <br /><br />Thanks<br />CJ Logistics Support';
        //configure email settings
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CJ Logistics'; //bebas sesuai keinginan kamu
        $config['protocol'] = 'smtp';
        $config['smtp_timeout']= '5';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = 'gid.itcj@gmail.com';
        $config['smtp_pass'] = 'CJkx123456'; //$from_email password
        $config['mailtype'] = 'html';
        $config['crlf']='\r\n';
        $config['newline']='\r\n';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from('gid.itcj@gmail.com','CJ');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Response has been sent to email</div>');
            redirect('requestor/done');
        } else {
            show_error($this->email->print_debugger());  
        }
    }
    //print form request
    public function print_form_request($request_id)
    {   
        $data['request'] = $this->models->get_support_request_form($request_id);
        $this->load->view('support_request_form_pdf',$data);
    }
}