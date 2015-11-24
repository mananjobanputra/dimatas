<?php
/**
 * PHP Codeigniter Simplicity
 *
 * Copyright (C) 2013  John Skoumbourdis.
 *
 * GROCERY CRUD LICENSE
 *
 * Codeigniter Simplicity is released with dual licensing, using the GPL v3 and the MIT license.
 * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
 * Please see the corresponding license file for details of these licenses.
 * You are free to use, modify and distribute this software, but all copyright information must remain.
 *
 * @package    	Codeigniter Simplicity
 * @copyright  	Copyright (c) 2013, John Skoumbourdis
 * @license    	https://github.com/scoumbourdis/grocery-crud/blob/master/license-grocery-crud.txt
 * @version    	0.6
 * @author     	John Skoumbourdis <scoumbourdisj@gmail.com>
 */
class MY_Loader extends CI_Loader {
	private $_javascript = array();
	private $_javascript_details = array();
	private $_css = array();
	private $_css_details = array();
	private $_inline_scripting = array("infile"=>"", "stripped"=>"", "unstripped"=>"");
	private $_sections = array();
	private $_cached_css = array();
	private $_cached_js = array();
	function __construct(){
		if(!defined('SPARKPATH'))
		{
			define('SPARKPATH', 'sparks/');
		}
		parent::__construct();
		
		
	}
	
	function css($css_files){
		$css_files = func_get_args();
		foreach($css_files as $css_file){
			$css_file = substr($css_file,0,1) == '/' ? substr($css_file,1) : $css_file;
			$is_external = false;
			if(is_bool($css_file))
				continue;
			$is_external = preg_match("/^https?:\/\//", trim($css_file)) > 0 ? true : false;
			if(!$is_external){
				$file=$css_file;
				/*if(!file_exists($css_file)){
					show_error("Cannot locate stylesheet file: {$css_file}.");
				}*/
				
				
				$css_file = $is_external == FALSE ? base_url() . $css_file : $css_file;
				if(!in_array($css_file, $this->_css)){
					$this->_css[] = $css_file;
					$css_array['file'] = $file;
					$css_array['external'] = $is_external;
					$this->_css_details[]=$css_array;
				}
			}
			else{
				$css_array['external'] = $is_external;
				$css_array['file'] = $css_file;
				$this->_css_details[]=$css_array;
			}
		}
		return;
	}
	function js(){
		$script_files = func_get_args();
		foreach($script_files as $script_file){
			$script_file = substr($script_file,0,1) == '/' ? substr($script_file,1) : $script_file;
			$is_external = false;
			if(is_bool($script_file))
				continue;
			$is_external = preg_match("/^https?:\/\//", trim($script_file)) > 0 ? true : false;
			if(!$is_external){
				
				/*if(!file_exists($script_file)){
					show_error("Cannot locate javascript file: {$script_file}.");
				}*/
				
				
				$file=$script_file;
				$script_file = $is_external == FALSE ?  base_url() . $script_file : $script_file;
				if(!in_array($script_file, $this->_javascript)){
					$this->_javascript[] = $script_file ;
					$js_array['file'] = $file;
					$js_array['external'] = $is_external;
					$this->_javascript_details[]=$js_array;
				}
			}
			else{
				$js_array['external'] = $is_external;
				$js_array['file'] = $script_file;
				$this->_javascript_details[]=$js_array;
			}
		}
		return;
	}
	function start_inline_scripting(){
		ob_start();
	}
	function end_inline_scripting($strip_tags=true, $append_to_file=true){
		$source = ob_get_clean();
		if($strip_tags){
			$source = preg_replace("/<script.[^>]*>/", '', $source);
			$source = preg_replace("/<\/script>/", '', $source);
		}
		if($append_to_file){
			$this->_inline_scripting['infile'] .= $source;
		}else{
			if($strip_tags){
				$this->_inline_scripting['stripped'] .= $source;
			}else{
				$this->_inline_scripting['unstripped'] .= $source;
			}
		}
	}
	function get_css_files(){
		return $this->_css_details;
	}
	function get_cached_css_files(){
		return $this->_cached_css;
	}
	function get_js_files(){
		return $this->_javascript_details;
	}
	function get_cached_js_files(){
		return $this->_cached_js;
	}
	function get_inline_scripting(){
		return $this->_inline_scripting;
	}
	/**
	 * Loads the requested view in the given area
	 * <em>Useful if you want to fill a side area with data</em>
	 * <em><b>Note: </b> Areas are defined by the template, those might differs in each template.</em>
	 *
	 * @param string $area
	 * @param string $view
	 * @param array $data
	 * @return string
	 */
	function section($area, $view, $data=array()){
		if(!array_key_exists($area, $this->_sections))
			$this->_sections[$area] = array();
		$content = $this->view($view, $data, true);
		$checksum = md5( $view . serialize($data) );
		$this->_sections[$area][$checksum] = $content;
		return $checksum;
	}
	function get_section($section_name)
	{
		$section_string = '';
		
		if(isset($this->_sections[$section_name]))
			foreach($this->_sections[$section_name] as $section)
				$section_string .= $section;
			return $section_string;
		}
	/**
	 * Gets the declared sections
	 *
	 * @return object
	 */
	function get_sections(){
		return (object)$this->_sections;
	}
	
}
/* End of file  user  */
/* Location:  file_path */