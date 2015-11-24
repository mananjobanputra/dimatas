<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class scan_options_model extends My_Model
{
	public $primary_key = 'id';
	public $_table = 'scan_options';
	public function __construct()
	{
		parent::__construct();
	}
}
