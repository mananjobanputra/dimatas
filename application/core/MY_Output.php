<?php
/**
 * PHP Codeigniter Simplicity
 *
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
class MY_Output extends CI_Output {
	const OUTPUT_MODE_NORMAL = 10;
	const OUTPUT_MODE_TEMPLATE = 11;
	const TEMPLATE_ROOT = "layouts/";

	private $_title = "";
	private $_charset = "utf-8";
	private $_language = "en-us";
	private $_canonical = "";
	private $_meta = array("keywords"=>array(), "description"=>null);
	private $_rdf = array("keywords"=>array(), "description"=>null);
	private $_template = null;
	private $_mode = self::OUTPUT_MODE_NORMAL;
	private $_messages = array("error"=>"", "info"=>"", "debug"=>"");
	private $_output_data = array();

	function __construct(){
		parent::__construct();
	}
	/**
	 * Set the  template that should be contain the output <br /><em><b>Note:</b> This method set the output mode to MY_Output::OUTPUT_MODE_TEMPLATE</em>
	 *
	 * @uses MY_Output::set_mode()
	 * @param string $template_view
	 * @return void
	 */
	function process_data_alan($text) // 
	{
		$re = '%# Collapse ws everywhere but in blacklisted elements.
		(?>             # Match all whitespans other than single space.
			[^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
			| \s{2,}        # or two or more consecutive-any-whitespace.
			) # Note: The remaining regex consumes no text at all...
(?=             # Ensure we are not in a blacklist tag.
	(?:           # Begin (unnecessary) group.
		(?:         # Zero or more of...
			[^<]++    # Either one or more non-"<"
			| <         # or a < starting a non-blacklist tag.
			(?!/?(?:textarea|pre)\b)
			)*+         # (This could be "unroll-the-loop"ified.)
)             # End (unnecessary) group.
(?:           # Begin alternation group.
	<           # Either a blacklist start tag.
	(?>textarea|pre)\b
	| \z          # or end of file.
	)             # End alternation group.
)  # If we made it here, we are not in a blacklist tag.
%ix';
$text = preg_replace($re, " ", $text);
return $text;
}
function set_template($template_view){
	$this->set_mode(self::OUTPUT_MODE_TEMPLATE);
	$template_view = str_replace(".php", "", $template_view);
	$this->_template = self::TEMPLATE_ROOT . $template_view;
}

	/**set_mode alias
	 *
	 * Enter description here ...
	 */
	function unset_template()
	{
		$this->_template = null;
		$this->set_mode(self::OUTPUT_MODE_NORMAL);
	}

	public function set_common_meta($title, $description, $keywords)
	{
		$this->set_meta("description", $description);
		$this->set_meta("keywords", $keywords);
		$this->set_title($title);
	}

	/**
	 * Sets the way that the final output should be handled.<p>Accepts two possible values 	MY_Output::OUTPUT_MODE_NORMAL for direct output
	 * or MY_Output::OUTPUT_MODE_TEMPLATE for displaying the output contained in the specified template.</p>
	 *
	 * @throws Exception when the given mode hasn't defined.
	 * @param integer $mode one of the constants MY_Output::OUTPUT_MODE_NORMAL or MY_Output::OUTPUT_MODE_TEMPLATE
	 * @return void
	 */
	function set_mode($mode){

		switch($mode){
			case self::OUTPUT_MODE_NORMAL:
			case self::OUTPUT_MODE_TEMPLATE:
			$this->_mode = $mode;
			break;
			default:
			throw new Exception(get_instance()->lang->line("Unknown output mode."));
		}

		return;
	}

	/**
	 * Set the title of a page, it works only with MY_Output::OUTPUT_MODE_TEMPLATE
	 *
	 *
	 * @param string $title
	 * @return void
	 */
	function set_title($title){
		$this->_title = $title;
	}

	/**
	 * Append the given string at the end of the current page title
	 *
	 * @param string $title
	 * @return void
	 */
	function append_title($title){
		$this->_title .= " - {$title}";
	}

	/**
	 * Prepend the given string at the bigining of the curent title.
	 *
	 * @param string $title
	 * @return void
	 */
	function prepend_title($title){
		$this->_title = "{$title} - {$this->_title}";
	}

	function set_message($message, $type="error"){
// 		log_message($type, $message);
		$this->_messages[$type] .= $message;
//		get_instance()->session->set_flashdata("__messages", serialize($this->_messages));
	}

	/**
	 * (non-PHPdoc)
	 * @see system/libraries/CI_Output#_display($output)
	 */
	function _display($output=''){

		if($output=='')
			$output = $this->get_output();

		switch($this->_mode){
			case self::OUTPUT_MODE_TEMPLATE:
			$output = $this->get_template_output($output);
			break;
			case self::OUTPUT_MODE_NORMAL:
			default:
			$output = $output;
			break;
		}

		if(get_instance()->config->item("compress_output"))
		{
			$output=$this->process_data_alan($output);
		}
		
		parent::_display($output);
	}

	function set_output_data($varname, $value){
		$this->_output_data[$varname] = $value;
	}
	function load_template_data(){
		if(function_exists("get_instance") && class_exists("CI_Controller")){
			$ci = get_instance();

			$inline = $ci->load->get_inline_scripting();


			if($inline["infile"]!=""){
				$checksum = md5($inline["infile"], false);
				$ci->load->driver('cache');
				$ci->cache->memcached->save($checksum, $inline["infile"], 5*60);
				$ci->load->js(site_url("assets/js/{$checksum}.js"), true);
			}

			if( strlen($inline['stripped']) ){
				$inline['stripped'] = "\r\n\r\n<script type=\"text/javascript\">{$inline['stripped']}</script>";
			}

			$data = array();

			$css_files = $ci->load->get_css_files();
			$js_files = $ci->load->get_js_files();
			
			
			if (is_array($this->_meta["keywords"]))
			{
				$this->_meta["keywords"] = implode(" ,", $this->_meta["keywords"]);
			}
			$data["messages"] = $this->_messages;
			$data["modules"] = $ci->load->get_sections();
			$data["title"] = $this->_title;
			$data["meta"] = $this->_meta;
			$data["language"] = $this->_language;
			$data["rdf"] = $this->_rdf;
			$data["charset"] = $this->_charset;
			$data["js"] = $js_files;
			$data["css"] = $css_files;
			$data["inline_unstripped_scripting"] = $inline['unstripped'];
			$data["inline_stripped_scripting"] = $inline['stripped'];
			$data["canonical"] = $this->_canonical;
			$data["ci"]			= &get_instance();
			return $data;
		}
	}
	private function get_template_output($output){

		if(function_exists("get_instance") && class_exists("CI_Controller")){
			$ci = get_instance();
			$data = array();
			$data["output"] = $output;
			//$data=$this->load_template_data();
			$data = array_merge($data, $this->_output_data);

			$output = $ci->load->view($this->_template, $data, true);
		}

		return $output;
	}

	/**
	 * Adds meta tags.
	 *
	 * @access public
	 * @param string $name the name of the meta tag
	 * @param string $content the content of the meta tag
	 * @return bool
	 */
	public function set_meta($name, $content){
		$this->_meta[$name] = $content;
		return true;
	}

	public function set_canonical($url)
	{
		$this->_canonical = $url;
	}
}