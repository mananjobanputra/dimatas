<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Debug Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Yura Loginov
 * @link		https://github.com/yuraloginoff/codeigniter-debug-helper.git
 */
// ------------------------------------------------------------------------
/**
 * Readable print_r
 *
 * Prints human-readable information about a variable
 *
 * @access	public
 * @param	mixed 
 */
if ( ! function_exists('printr'))
{
	function printr($var)
	{
		$CI =& get_instance();
		echo '<pre>' . print_r($var, TRUE) . '</pre>';
	}
}
// ------------------------------------------------------------------------
/**
 * Readable var_dump
 *
 * Readable dump information about a variable
 *
 * @access	public
 * @param	mixed * 
 */
if ( ! function_exists('dump'))
{
	function dump($var,$exit = 'n')
	{
		$CI =& get_instance();
		echo '<pre>';
		var_dump($var);
		echo '</pre>';

		if($exit == 'y')
			exit;	

	}
}



if ( ! function_exists('print_session'))
{
	function print_session()
	{
		$CI =& get_instance();
		echo "<pre>";
		print_r($CI->session->all_userdata());
		echo "</pre>";
	}
}

