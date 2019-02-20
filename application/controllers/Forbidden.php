<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class forbidden extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('internet_explorer_error');
	}
}