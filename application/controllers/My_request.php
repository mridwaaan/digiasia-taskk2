<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_request extends CI_Controller {
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
        $this->load->library('Pdf');
	}
	function index()
    {
        $data['request'] = $this->models->get_my_request_data();
        $this->load->view('my_request',$data);
    }
    function request_form()
    {
        $this->load->view('request_form_u');
    }
    function send_request()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
        $this->form_validation->set_rules('subject', 'subject', 'required|max_length[100]', array('required' => 'Subject required', 'max_length' => 'Subject maksimum 100 characters'));
        $this->form_validation->set_rules('type', 'type', 'required', array('required' => 'Support request type required'));
        $this->form_validation->set_rules('description', 'description', 'required', array('required' => 'Description required'));
        if (!empty($_FILES['request_attachment']['name'])) {
            $this->form_validation->set_rules('request_attachment', 'request_attachment', 'callback_request_attachment');
        }
        if ($this->form_validation->run() == TRUE){
        
        $requested_by = $this->input->post('requested_by');
        $sbjct = $this->input->post('subject');
        $type = $this->input->post('type');
        $description = $this->input->post('description');
        $date = date("d/m/Y");
        $system_date = date("Y/m/d");
        $month = date('m');
        $year = date ('Y');
        $rq_no = $this->automatic_no($type);
        $request_no = $type.$year.$month.$rq_no;
        if (!empty($_FILES['request_attachment']['name'])) {
            $request_attachment = $this->upload->data();
            $data = array(
                'request_no' => $request_no,
                'rq_no' => $rq_no,
                'requested_by' => $requested_by,
                'subject' => $sbjct,
                'type' => $type,
                'description' => $description,
                'date' => $date,
                'request_attachment' => $request_attachment['file_name'],
                'system_date' => $system_date
                );
        } else {
            $data = array(
                'request_no' => $request_no,
                'rq_no' => $rq_no,
                'requested_by' => $requested_by,
                'subject' => $sbjct,
                'type' => $type,
                'description' => $description,
                'date' => $date,
                'system_date' => $system_date
                );
        }
            // insert form data into database
            $this->models->add_data($data,'request');
            $this->sendEmailToAdmin($sbjct,$type,$description,$request_no);
            redirect('my_request');
        }
        else {
            $this->request_form();
        }
    }
    function request_attachment(){
        $config['upload_path'] = './assets/images/request/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '1024'; //maksimum file 1MB
        //$config['max_width'] = ''
        //$config['max_height'] = '';
        //$config['file_name'] = $request_no;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('request_attachment')) 
        {
            $this->form_validation->set_message(__FUNCTION__, $this->upload->display_errors());
            return FALSE;
        }
        else{
            //$foto = $this->upload->data;
            return TRUE;
        }
    }
    function automatic_no($type){
        //$data['id_max'] = $this->models->get_auto_no($year,$type);
        //foreach ($data['id_max'] as $i){
        $year = date ('Y');
        $query = $this->db->query("SELECT MAX(rq_no) as max FROM request  WHERE year(system_date) = '".$year."' AND type = '".$type."'");
        foreach ($query->result() as $row)
        {
            $kode = $row->max+1;
            $rq_no =  sprintf("%04s", $kode);
        }
        //}
        return $rq_no;
    }
    function cancel_request(){
        $where = array('request_id' =>$this->input->post('request_id'));
        $this->models->delete_data($where,'request');
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Request has been deleted</div>');
        redirect('my_request');
    }
    function sendEmailToAdmin($sbjct,$type,$description,$request_no){
        $from_email = 'gid.itcj@gmail.com'; //change this to yours
        $to_email_list = array('gid-it@cj.net','gid-it@cjlogistics.co.id');
        $subject = 'SR ['.$request_no.'] / '.$sbjct;
        $message = 'From   : '.$this->session->userdata('usrname').'['.$this->session->userdata('usremail').']<br><br>'.$description.' <br /><br /><br />CJ Support Request System';
        //configure email settings
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
        $this->email->to($to_email_list);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Request has been sent</div>');
            redirect('my_request');
        } else {
            show_error($this->email->print_debugger());  
        }
    }
    function resend($request_id)
    {
        $data['request_done']=$this->models->get_data_where('request', array('request_id' => $request_id));
        foreach ($data['request_done'] as $rd) {
            $id = $rd->id;
            $password = $rd->password;
            $nik = $rd->nik;
            $system1="";
            $system2="";
            if ($rd->system1!="") {
                $system1 = $rd->system1."; ";
            }
            if ($rd->system2!="") {
                $system2 = $rd->system2."; ";
            }        
        }
        $data['karyawan']=$this->models->get_data_where('karyawan', array('nik' => $nik));
        foreach ($data['karyawan'] as $k) {
            $to_email = $k->email;
        }
        
        $from_email = 'gid.itcj@gmail.com'; //change this to yours
        $subject = 'ID & Password';
        $message = 'Dear User,<br /><br />Here is your ID.<br>ID : '.$id.' <br>Password : '.$password.' <br /><br /><br />Thanks<br />CJ Logistics Support';
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
            redirect('my_request');
        } else {
            show_error($this->email->print_debugger());  
        }
    }

    public function print_form_request($request_id)
    {   
        $data['request'] = $this->models->get_support_request_form($request_id);
        $this->load->view('support_request_form_pdf',$data);
    }
    function upload_form_process(){
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" id="error">', '</div>');
        $this->form_validation->set_rules('form_file', 'form_file', 'callback_upload_file');
        if ($this->form_validation->run()==TRUE){
            $form_file = $this->upload->data();
            $data = array(
                    'form_file' => $form_file['file_name']
            );
            $this->models->update_data(array('request_id' => $this->input->post('request_id')),$data,'request');
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Upload file success</div>');
            redirect('my_request');
        }
        else{
            //$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Failed upload file</div>');
            $this->index();
        }
    }
    function upload_file(){
        $config['upload_path'] = './assets/images/form/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|JPEG|PDF';
        $config['max_size'] = '1024'; //maksimum file 4MB
        //$config['max_width'] = ''
        //$config['max_height'] = '';
        $config['file_name'] = $this->input->post('request_no');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('form_file')) 
        {
            $this->form_validation->set_message(__FUNCTION__, $this->upload->display_errors());
            return FALSE;
        }
        else{
            $foto = $this->upload->data;
            return TRUE;
        }
    }
}