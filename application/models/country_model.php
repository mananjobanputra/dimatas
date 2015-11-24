<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class country_model extends My_Model
{
	public $primary_key = 'id';
	public $_table = 'country';

	public $validate = array(
		array( 'field' => 'address','label' => 'Address','rules' => 'required'),
		array( 'field' => 'unit','label' => 'Unit','rules' => 'required'),
		array( 'field' => 'ptype','label' => 'Ptype','rules' => 'required'),
		);

	public function __construct()
	{
		parent::__construct();
	}
	
}
