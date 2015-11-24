<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_mail'))
{
    function send_mail($from,$to,$subject,$message)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.test1.dimatas.com',
            'smtp_port' => 587,
            'smtp_user' => 'smtpuser2@dimatas.com',
            'smtp_pass' => 'Hell0_123$'
            );
        $CI =& get_instance();
        $CI->load->library( 'email');
        $CI->email->set_newline("\r\n");
        $CI->email->from($from, 'Admin-dimatas');
        $CI->email->to($to);
        $CI->email->set_mailtype('html');
        $CI->email->subject($subject);
        $CI->email->message($message);
        $CI->email->send();
        /*echo $CI->email->print_debugger();
        exit;*/
            /*
            return the full asset path
            return base_url() . $CI->config->item('asset_path');*/
        }
    }
