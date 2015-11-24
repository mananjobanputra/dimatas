<?php
/**
* A base controller for CodeIgniter with view autoloading, layout support,
* model loading, helper loading, asides/partials and per-controller 404
*
* @link http://github.com/jamierumbelow/codeigniter-base-controller
* @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
*/
class MY_Controller extends CI_Controller
{
/* --------------------------------------------------------------
* VARIABLES
* ------------------------------------------------------------ */
public $site_name;
/*user,admin*/
public $login_type=false;
/*nologin,login*/
public $access='login';
public $body_class='';
public $isAjax=false;
public $menutype = '';
public $menu_array = array();
public $current_login_type = "";
public $current_session;
public $user_session = array();
public $admin_session = array();
public $msg_in_seperate_template = false;
public $message_type = "alert";
public $message_text="";
public $message_class="";
public $message_title="";
public $message_session="";


/**
* The current request's view. Automatically guessed
* from the name of the controller and action
*/
protected $view = '';
protected $json=false;
/**
* An array of variables to be passed through to the
* view, layout and any asides
*/
protected $data = array();
/**
* The name of the layout to wrap around the view.
*/
protected $layout;
/**
* An arbitrary list of asides/partials to be loaded into
* the layout. The key is the declared name, the value the file
*/
protected $sections = array();
/* --------------------------------------------------------------
* GENERIC METHODS
* ------------------------------------------------------------ */
/**
* Initialise the controller, tie into the CodeIgniter superobject
* and try to autoload the models and helpers
*/
public function __construct()
{
  parent::__construct();
  $this->lang->load('message');
   /* $this->load->config('forms',TRUE);
    $froms_config=$this->config->item('forms_settings','forms');
    $this->form_builder->init($froms_config);*/
    /*$this->load->model('menu_model','menu');*/
    $this->isAjax= $this->input->is_ajax_request();
    $this->site_name=$this->config->item('site_name');
    $msg_succ = $this->session->flashdata('success');
    $msg_error = $this->session->flashdata('error');
    $msg_info = $this->session->flashdata('message');

    $this->beforeload();
    
  }
  public function beforeload(){
    /*All session data*/
    $this->data['isAjax']=$this->isAjax;
    
    $this->data['controller_name']=$this->router->fetch_class();
    $this->data['method_name']=$this->router->fetch_method();

    $this->load->model("user_model");
    $this->user_model->manage_session();

    if($this->current_session)
    { 
     $array = array('id'=>$this->current_session["id"],'session_update'=>true,'skip_validation'=>true,'type'=>$this->current_login_type);
     $this->user_model->check_login($array);
   }

   /*var_dump($this->current_login_type);exit;*/
   check_session();
   /*All session data*/

   $msg_succ = $this->session->flashdata('success');
   $msg_error = $this->session->flashdata('error');
   $msg_404error = $this->session->flashdata('404_error');
   $msg_info = $this->session->flashdata('message');
   if($msg_404error!=''){
    $this->session->keep_flashdata('404_error');
   }
   if($msg_succ != "")
   {
    $this->message_session = "success";
    $this->message_class = "success";
    $this->message_title = "Success";
    if(!empty($msg_succ) && is_array($msg_succ))
    {
      foreach ($msg_succ as $key => $value) 
      {
        $this->message_text.= $value."<br />";
      }
    }
    else{
      $this->message_text = $msg_succ;
    }
  }
  else if($msg_info!=""){
    $this->message_class = "info";
    $this->message_session = "message";
    $this->message_title = "Info";
    if(!empty($msg_info) && is_array($msg_info))
    {
      foreach ($msg_info as $key => $value) 
      {
        $this->message_text .= $value."<br />";
      }
    }
    else{
      $this->message_text = $msg_info;
    }
  } 
  else{
    $this->message_class = "danger";
    $this->message_session = "error";
    $this->message_title = "Error";
    if(!empty($msg_error) && is_array($msg_error))
    {
      foreach ($msg_error as $key => $value) {
        $this->message_text .= $value."<br />";
      }
    }
    else{
      $this->message_text = $msg_error;
    }
  }
  /*if($this->admin_session){*/
   /*$this->load->css('css/fonts.css');*/
   $this->load->css('plugins/font-awesome/css/font-awesome.min.css');
   $this->load->css('plugins/simple-line-icons/simple-line-icons.min.css');
   $this->load->css('plugins/bootstrap/css/bootstrap.min.css');
   $this->load->css('plugins/uniform/css/uniform.default.css');
   $this->load->css('plugins/bootstrap-switch/css/bootstrap-switch.min.css');
   $this->load->css('plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');
   $this->load->css('plugins/morris/morris.css');
   $this->load->css('plugins/fullcalendar/fullcalendar.min.css');
   $this->load->css('plugins/bootstrap-toastr/toastr.css');

   /*  $this->load->css('plugins/jqvmap/jqvmap/jqvmap.css');*/

   $this->load->css('plugins/uniform/css/uniform.default.css');


   $this->load->js('js/jquery.min.js');
   $this->load->js('js/jquery.validate.min.js');
   $this->load->js('plugins/bootstrap/js/bootstrap.min.js');
   $this->load->js('js/jquery.cokie.min.js');
   $this->load->js('plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');
   $this->load->js('plugins/jquery-slimscroll/jquery.slimscroll.min.js');
   $this->load->js('js/jquery.blockui.min.js');
   $this->load->js('plugins/uniform/jquery.uniform.min.js');
   $this->load->js('plugins/bootstrap-switch/js/bootstrap-switch.min.js');
   $this->load->js('plugins/bootstrap-daterangepicker/moment.min.js');
   $this->load->js('plugins/bootstrap-daterangepicker/daterangepicker.js');
   $this->load->js('plugins/morris/morris.min.js');
   $this->load->js('plugins/morris/raphael-min.js');
   $this->load->js('plugins/counterup/jquery.waypoints.min.js');
   $this->load->js('plugins/counterup/jquery.counterup.min.js');
   $this->load->js('plugins/bootstrap-toastr/toastr.js');     
   $this->load->js('plugins/uniform/jquery.uniform.min.js');



      /* $this->load->js('plugins/amcharts/amcharts/amcharts.js');
       $this->load->js('plugins/amcharts/amcharts/serial.js');
       $this->load->js('plugins/amcharts/amcharts/pie.js');
       $this->load->js('plugins/amcharts/amcharts/radar.js');
       $this->load->js('plugins/amcharts/amcharts/themes/light.js');
       $this->load->js('plugins/amcharts/amcharts/themes/patterns.js');
       $this->load->js('plugins/amcharts/amcharts/themes/chalk.js');
       $this->load->js('plugins/amcharts/ammap/ammap.js');
       $this->load->js('plugins/amcharts/ammap/maps/js/worldLow.js');
       $this->load->js('plugins/amcharts/amstockcharts/amstock.js');
       $this->load->js('plugins/fullcalendar/fullcalendar.min.js');*/



       $this->load->js('plugins/flot/jquery.flot.min.js');
       $this->load->js('plugins/flot/jquery.flot.resize.min.js');
       $this->load->js('plugins/flot/jquery.flot.categories.min.js');
       $this->load->js('plugins/jquery-easypiechart/jquery.easypiechart.min.js');
       $this->load->js('js/jquery.sparkline.min.js');
       
       /*$this->load->js('plugins/jqvmap/jqvmap/jquery.vmap.js');
       $this->load->js('plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js');
       $this->load->js('plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js');
       $this->load->js('plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js');
       $this->load->js('plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js');
       $this->load->js('plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js');
       $this->load->js('plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js');*/
       /*}    */



    /*$this->load->start_inline_scripting();
    echo "
    var config={
        siteUrl:'".base_url()."',
        AssetUrl:'".base_url()."assets/',
        userUrl:'".user_url()."'
    };";
    $this->load->end_inline_scripting(TRUE,FALSE);*/

    $this->load->start_inline_scripting();

    if($this->admin_session){
      /* echo "App.init(config);";
      echo "Appad.init(config);";*/
    }else{
     echo "Appp.init(config);";
   }

   $this->load->end_inline_scripting(false,false);
   
 }
 public function afterload(){
  $this->load->css('css/components-md.min.css');
  $this->load->css('css/plugins-md.min.css');
  $this->load->css('css/layout.min.css');
  $this->load->css('css/themes/blue.min.css');
  $this->load->css('css/custom.css');

  if($this->layout=='' || $this->layout!='home'){
    $this->load->js('js/app.js'); 
  }
  $this->sections['section_css'] = 'sections/css';
  $this->sections['section_js'] = 'sections/js';
  $this->sections['section_message'] = 'sections/message';
  /* $this->sections['section_loadmore'] = 'sections/loadmore';*/

  $this->output->append_title(site_name());
  /*Get menu*/
  /* echo $this->menutype;*/
  /*$this->menu_array = $this->menu->get_menu($this->menutype,current_url());*/


  if(!empty($this->admin_session) && $this->admin_session){
    $this->load->js('js/admin/common.js'); 
  }else{        

    $this->load->js('js/common.js'); 
  }
  /*$this->load->js('js/appcommon.js');  */  
  $this->data['body_class']=$this->body_class;
  /*printr($this->menu_array);*/
  /* printr($menu);exit;*/
  /*Get menu ends*/
}
/* --------------------------------------------------------------
* VIEW RENDERING
* ------------------------------------------------------------ */
/**
* Override CodeIgniter's despatch mechanism and route the request
* through to the appropriate action. Support custom 404 methods and
* autoload the view into the layout.
*/
public function _remap($method)
{
  try
  {
    if (method_exists($this, $method))
    {
      $parameters = array_slice($this->uri->rsegments, 2);
      call_user_func_array(array($this, $method), $parameters);
    }
    else
    {
      if (method_exists($this, '_404'))
      {
        call_user_func_array(array($this, '_404'), array($method));
      }
      else
      {
        show_404(strtolower(get_class($this)).'/'.$method);
      }
    }
    $this->afterload();
    $this->_load_view();
  }
  catch(Exception $e)
  {
    show_error($e->getMessage());
  }
}
/*Function to check user is admin or not*/
public function admin_loggedin(){
  if($this->admin_session && !empty($this->admin_session))
    return true;
  else
    return false;   
}
/*Function to check user is admin or not*/
/*Function to check user is loggedin or not*/
public function user_loggedin(){
  if($this->user_session && !empty($this->user_session))
    return true;
  else
    return false;  
}
/*Function to check user is loggedin or not ends*/
/*Function to check any of user or admin is loggedin or not*/
public function both_loggedin(){
  if(!empty($this->user_session) || !empty($this->admin_session))
    return true;
  else
    return false;   
}
/*Function to check tc is loggedin or not ends*/

/**
* Automatically load the view, allowing the developer to override if
* he or she wishes, otherwise being conventional.
*/
protected function _load_view()
{
  /*If $this->view == FALSE, we don't want to load anything*/
  if ($this->view !== FALSE && $this->json===false)
  {
    /* If $this->view isn't empty, load it. If it isn't, try and guess based on the controller and action name*/
    $view = (!empty($this->view)) ? $this->view : $this->router->directory . $this->router->class . '/' . $this->router->method;
    $layout = FALSE;
    /*If we didn't specify the layout, try to guess it*/
    if (!isset($this->layout))
    {
      if (file_exists(APPPATH . 'views/layouts/' . $this->router->class . '.php'))
      {
        $layout = $this->router->class;
      }
      else
      {
       if($this->admin_session){
        $layout = 'admin/default';
      }
      else{
        $layout = 'default';
      }

    }   
  }
  elseif($this->layout !== FALSE)
  {
    $layout=$this->layout;
  }
  if ($layout == FALSE)
  {
    $this->output->unset_template();
  }
  else{
    $this->layout=$layout;
    $this->output->set_template($this->layout);
  }
  $data_all=$this->output->load_template_data();
  /*printr($data_all);*/
  $this->data=array_merge($this->data,$data_all);
  /*printr($this->data);*/
  /*Do we have any asides? Load them.*/
  if (!empty($this->sections))
  {
    foreach ($this->sections as $name => $file)
    {
      $this->load->section($name, $file,$this->data);
    }
  }
  $this->load->view($view,$this->data);  
}
else if($this->json===true){
  $this->output->set_content_type('application/json')->set_output(json_encode($this->data));
}
}
}