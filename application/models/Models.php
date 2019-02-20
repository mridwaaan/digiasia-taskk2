<?php
class Models extends CI_Model{
	function jumlah_data($table){
		return $this->db->get($table)->num_rows();
	}
	function jumlah_data_where($table,$where){
		return $this->db->get_where($table,$where)->num_rows();
	}
	function get_data($table){
		return $this->db->get($table)->result();
	}
	function get_data_where($table,$where){
		return $query = $this->db->get_where($table,$where)->result();
	}
	function get_new_request_data(){
		$this->db->select('*');
		$this->db->select('k.name AS `requested_by_name`');
		$this->db->from('request');
		$this->db->where('status', 0);
		$this->db->join('karyawan AS `k`', 'request.requested_by = k.nik', 'left');
		$this->db->join('site', 'k.site_id = site.site_id', 'left');
		$this->db->join('request_type', 'request.type = request_type.type_code', 'left');
		$this->db->order_by('request_id', 'DESC');
		return $this->db->get()->result();
	}
	function get_request_done_data(){
		$this->db->select('*');
		$this->db->select('k.name AS `requested_by_name`');
		$this->db->select('request.password AS `request_password`');
		$this->db->from('request');
		$this->db->where('status', 1);
		$this->db->join('karyawan AS `k`', 'request.requested_by = k.nik', 'left');
		$this->db->join('site', 'k.site_id = site.site_id', 'left');
		$this->db->join('request_type', 'request.type = request_type.type_code', 'left');
		$this->db->order_by('request_id', 'DESC');
		return $this->db->get()->result();
	}
	function get_request_done_filter_data($where,$date_range,$type,$site_id){
		$this->db->select('*');
		$this->db->select('k.name AS `requested_by_name`');
		$this->db->select('request.password AS `request_password`');
		$this->db->from('request');
		$this->db->where($date_range);
		if($type!="*"){
			$this->db->where('type',$type);
		}
		if($site_id!="*"){
			$this->db->where('k.site_id',$site_id);
		}
		$this->db->where('status', 1);
		$this->db->join('karyawan AS `k`', 'request.requested_by = k.nik', 'left');
		$this->db->join('site', 'k.site_id = site.site_id', 'left');
		$this->db->join('request_type', 'request.type = request_type.type_code', 'left');
		$this->db->order_by('request_id', 'ASC');
		return $this->db->get()->result();
	}
	function get_request_null_data(){
		$this->db->select('*');
		$this->db->select('k.name AS `requested_by_name`');
		$this->db->select('request.password AS `request_password`');
		$this->db->from('request');
		$this->db->where('status', 99);
		$this->db->join('karyawan AS `k`', 'request.requested_by = k.nik', 'left');
		$this->db->join('site', 'k.site_id = site.site_id', 'left');
		$this->db->join('request_type', 'request.type = request_type.type_code', 'left');
		$this->db->order_by('request_id', 'DESC');
		return $this->db->get()->result();
	}
	function get_my_request_data(){
		$this->db->select('*');
		$this->db->select('request.password AS `request_password`');
		$this->db->from('request');
		$this->db->where('requested_by', $this->session->userdata('usrnik'));
		//$this->db->join('karyawan', 'request.nik = karyawan.nik');
		$this->db->order_by('request_id', 'DESC');
		return $this->db->get()->result();
	}
	function get_new_employee_data(){
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->order_by('nik', 'DESC');
		return $this->db->get()->result();
	}
	function get_employee_data(){
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->join('site AS `r`', 'karyawan.site_id = r.site_id', 'left');
		return $this->db->get()->result();
	}
	function get_request_data($request_id){
		$this->db->select('*');
		$this->db->select('r.name AS `requested_by_name`');
		$this->db->from('request');
		$this->db->where('request_id', $request_id);
		$this->db->join('karyawan AS `r`', 'request.requested_by = r.nik', 'left');
		//$this->db->join('karyawan', 'request.nik = karyawan.nik');
		return $this->db->get()->result();
	}
	function get_admin_data(){
		$this->db->select('*');
		$this->db->select('karyawan.name AS `admin_name`');
		$this->db->select('karyawan.email AS `admin_email`');
		$this->db->from('admin');
		$this->db->join('karyawan', 'admin.username = karyawan.username');
		return $this->db->get()->result();
	}
	function get_admin_data_by_id($admin_id){
		$this->db->select('*');
		$this->db->select('karyawan.name AS `admin_name`');
		$this->db->select('karyawan.email AS `admin_email`');
		$this->db->from('admin');
		$this->db->where('admin_id', $admin_id);
		$this->db->join('karyawan', 'admin.username = karyawan.username');
		return $this->db->get()->result();
	}
	function get_admin_data_by_username($username){
		$this->db->select('*');
		$this->db->select('karyawan.name AS `admin_name`');
		$this->db->select('karyawan.email AS `admin_email`');
		$this->db->select('admin.password AS `admin_password`');
		$this->db->from('admin');
		$this->db->where('admin.username', $username);
		$this->db->join('karyawan', 'admin.username = karyawan.username');
		return $this->db->get()->result();
	}
	function get_support_request_form($request_id){
		$this->db->select('*');
		$this->db->from('request');
		$this->db->where('request.request_id', $request_id);
		$this->db->join('karyawan', 'request.requested_by = karyawan.nik');
		$this->db->join('request_type', 'request.type = request_type.type_code');
		return $this->db->get()->result();
	}
	function get_auto_no($year,$type){
		$query =  $this->db->query("SELECT MAX(rq_no) FROM request WHERE year(system_date) = '".$year."' AND type = '".$type."'");
		return $data =  $this->db->query($query)->result();
	}
	function add_data($data,$table){
		$this->db->insert($table,$data);
	}
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
}