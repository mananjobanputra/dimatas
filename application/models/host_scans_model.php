<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class host_scans_model extends My_Model
{
	public $primary_key = 'id';
	public $_table = 'host_scans';
	public $validate = array(
		array( 'field' => 'h','label' => 'Host','rules' => 'required'),
		array( 'field' => 'hostname','label' => 'Hostname','rules' => 'required'),
		array( 'field' => 'alias','label' => 'Alias','rules' => 'required'),
		array( 'field' => 'address','label' => 'Address','rules' => 'required')
	);
	public function __construct()
	{
		parent::__construct();
	}
}
