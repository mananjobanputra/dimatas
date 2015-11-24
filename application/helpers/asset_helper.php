<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sekati CodeIgniter Asset Helper
 *
 * @package		Sekati
 * @author		Jason M Horwitz
 * @copyright	Copyright (c) 2013, Sekati LLC.
 * @license		http://www.opensource.org/licenses/mit-license.php
 * @link		http://sekati.com
 * @version		v1.2.7
 * @filesource
 *
 * @usage 		$autoload['config'] = array('asset');
 * 				$autoload['helper'] = array('asset');
 * @example		<img src="<?=asset_url();?>imgs/photo.jpg" />
 * @example		<?=img('photo.jpg')?>
 *
 * @install		Copy config/asset.php to your CI application/config directory
 *				& helpers/asset_helper.php to your application/helpers/ directory.
 * 				Then add both files as autoloads in application/autoload.php:
 *
 *				$autoload['config'] = array('asset');
 * 				$autoload['helper'] = array('asset');
 *
 *				Autoload CodeIgniter's url_helper in application/config/autoload.php:
 *				$autoload['helper'] = array('url');
 *
 * @notes		Organized assets in the top level of your CodeIgniter 2.x app:
 *					- assets/
 *						-- css/
 *						-- download/
 *						-- img/
 *						-- js/
 *						-- less/
 *						-- swf/
 *						-- upload/
 *						-- xml/
 *					- application/
 * 						-- config/asset.php
 * 						-- helpers/asset_helper.php
 */

// ------------------------------------------------------------------------
// URL HELPERS

/**
 * Get asset URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('asset_url'))
{
    function asset_url()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        //return the full asset path
        return base_url() . $CI->config->item('asset_path');
    }
}

if ( ! function_exists('asset_admin_url'))
{
    function asset_admin_url()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        //return the full asset path
        return base_url() . $CI->config->item('asset_admin_path');
    }
}

/**
 * Get css URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('css_url'))
{
    function css_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('css_path');
    }
}

if ( ! function_exists('admin_css_url'))
{
    function admin_css_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('asset_css_path');
    }
}

/**
 * Get less URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('less_url'))
{
    function less_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('less_path');
    }
}

/**
 * Get js URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('js_url'))
{
    function js_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('js_path');
    }
}

if ( ! function_exists('asset_js_url'))
{
    function asset_js_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('asset_js_path');
    }
}

if ( ! function_exists('view_url'))
{
    function view_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('view_path');
    }
}
/**
 * Get image URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('img_url'))
{
    function img_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('img_path');
    }
}

/**
 * Get SWF URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('swf_url'))
{
    function swf_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('swf_path');
    }
}

/**
 * Get Upload URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('upload_url'))
{
    function upload_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('upload_path');
    }
}

/**
 * Get Download URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('download_url'))
{
    function download_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('download_path');
    }
}

/**
 * Get XML URL
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('xml_url'))
{
    function xml_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('xml_path');
    }
}


// ------------------------------------------------------------------------
// PATH HELPERS

/**
 * Get asset Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('asset_path'))
{
    function asset_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . $CI->config->item('asset_path');
    }
}

if ( ! function_exists('asset_upload_path'))
{
    function asset_upload_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return asset_path()."upload/";
    }
}


if ( ! function_exists('asset_admin_path'))
{
    function asset_admin_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . $CI->config->item('asset_admin_path');
    }
}
/**
 * Get CSS Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('css_path'))
{
    function css_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . $CI->config->item('css_path');
    }
}

/**
 * Get LESS Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('less_path'))
{
    function less_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . $CI->config->item('less_path');
    }
}

/**
 * Get JS Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('js_path'))
{
    function js_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . str_replace("/","\\",$CI->config->item('js_path'));
    }
}
if ( ! function_exists('asset_js_path'))
{
    function asset_js_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . str_replace("/","\\",$CI->config->item('asset_js_path'));
    }
}



if ( ! function_exists('view_path'))
{
    function view_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . str_replace("\\",'/',$CI->config->item('view_path'));
    }
}
/**
 * Get image Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('img_path'))
{
    function img_path()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        return FCPATH . $CI->config->item('img_path');
    }
}

/**
 * Get SWF Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('swf_path'))
{
    function swf_path()
    {
        $CI =& get_instance();
        return FCPATH . $CI->config->item('swf_path');
    }
}

/**
 * Get XML Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('xml_path'))
{
    function xml_path()
    {
        $CI =& get_instance();
        return FCPATH . $CI->config->item('xml_path');
    }
}

/**
 * Get the Absolute Upload Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('upload_path'))
{
    function upload_path()
    {
        $CI =& get_instance();
        return FCPATH . $CI->config->item('upload_path');
    }
}

/**
 * Get the Relative (to app root) Upload Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('upload_path_relative'))
{
    function upload_path_relative()
    {
        $CI =& get_instance();
        return './' . $CI->config->item('upload_path');
    }
}

/**
 * Get the Absolute Download Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('download_path'))
{
    function download_path()
    {
        $CI =& get_instance();
        return FCPATH . $CI->config->item('download_path');
    }
}

/**
 * Get the Relative (to app root) Download Path
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('download_path_relative'))
{
    function download_path_relative()
    {
        $CI =& get_instance();
        return './' . $CI->config->item('download_path');
    }
}


/* End of file asset_helper.php */
