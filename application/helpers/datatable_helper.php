<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*review edit button*/
if(!function_exists('get_operation_btn')){
	function get_operation_btn($id,$array = array('edit'=>'','delete'=>''),$extra_edit_url = null){

		$html = '<div class="btn-group"><button class="btn btn-sm blue dropdown-toggle" data-toggle="dropdown"> Action&nbsp;<i class="fa fa-angle-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">';
			if(!empty($array))
			{
				if(isset($array["view"]) && $array["view"] != '')
				{
					$html .= '<li><a href="'.$array["view"].'">View</a></li>';
				}
				if(isset($array["edit"]) && $array["edit"] != ''){
					$html .= '<li><a href="'.$array["edit"]."/".$id."/".$extra_edit_url.'">Edit</a></li>';
				}
				if(isset($array["delete"]) && $array["delete"] != ''){
					$html .= '<li><a class="delete_data" onclick="return confirm(\'Are you sure to delete this user? \');" href="'.$array["delete"]."/".$id.'">Delete</a></li>';
				}
			}
			$html .= '</ul></div>';
			return $html;
		}
	}
	/*end of review edit button*/

	/*end of the car model status*/
	if(!function_exists('get_status')){
		function get_status($status,$id,$data_page,$user_type = "admin"){
			$checked = ($status == '1' || $status == 'a' || $status == 'y') ? 'checked="checked"' : '';
			$html = '';
			$html .= '<input value="'.$status.'" class="status_change_js make-switch" type="checkbox" '.$checked.' data-id="'.$id.'"  data-url="'.$data_page.'" data-size="small">';
			return $html;
		}
	}

	if(!function_exists('get_properties_status')){
		function get_properties_status($status,$loc_fil,$cont_fil,$basic_det_fil,$med_fil,$desc_fil,$agre_fil){
			$html = '';
			$CI = & get_instance();
			$user_type = $CI->current_login_type;
			$user_d=$admin_d='<label class="label label-default">Draft</label>';
			$user_r=$admin_r='<label class="label label-danger">Rejected</label>';
			$user_a=$admin_a='<label class="label label-success">Approved</label>';

			$user_p='<label class="label label-warning">Inprocess</label>';		
			$admin_p='<label class="label label-warning">Inprocess</label>&nbsp;&nbsp;<a href="" class="btn btn-round btn-blue btn-xs">Approve</a>&nbsp;&nbsp;<a href="" class="btn btn-round btn-blue btn-xs">Reject</a>';

			$user_type = ($user_type == "admin")?"admin":"user";
			$main_var=$user_type."_".$status;
			$html.=$$main_var;
			if($user_type == "user"){
				if($status == 'd'){
					if($loc_fil == 'y' && $cont_fil == 'y' && $basic_det_fil == 'y' && $med_fil == 'y' && $desc_fil == 'y' && $agre_fil == 'y'){
						$html .= '&nbsp;&nbsp;<a href="" class="btn btn-round btn-blue btn-xs">Submit for approval</a>';
					}
				}
			}
			$html .= '';
			return $html;
		}
	}



	if(!function_exists('get_property_visible')){
		function get_property_visible($status,$is_visible,$id,$data_page){
			/*echo $status;exit;
*/
			$disabled = ($status == 'd') ? 'disabled="disabled"' : '';
			$checked = ($is_visible == 'y') ? 'checked="checked"' : '';
			$html = '';
			$html .= '<div class="checkbox make-switch"><label><input value="'.$is_visible.'" class="status_change_js" type="checkbox" '.$checked.' '.$disabled.' data-id="'.$id.'"  data-url="'.$data_page.'"><span class="cs-place"><span class="fa fa-check cs-handler"></span></span></label></div>';
			return $html;
		}
	}


	/*location model status*/

	if(!function_exists('get_type_text')){
		function get_type_text($type){
			if($type == 's')
				return "Sale";
			else if($type == 'r')
				return "Rent";
		}
	}


	if(!function_exists('get_vulnerable_hostname')){
		function get_vulnerable_hostname($host_id){
			$CI = & get_instance();
			$CI->load->model("vulnerabilityscan_hosts_model");
			$user_id = $CI->current_session["id"];
			$where = array('user_id'=>$user_id,'id'=>$host_id);
			$temp = $CI->vulnerabilityscan_hosts_model->as_array()->get_by($where);
			$host_name = $temp["host_name"];
			return $host_name;
		}	
	}


	if(!function_exists('get_vulnerable_taskprogress')){
		function get_vulnerable_taskprogress($task_id,$st){


			$CI = & get_instance();
			$CI->load->library("openvas");
			$progress_class="";
			$requested=false;
			$inprogress=false;
			$progress_text="New";
			if($st!='o'){
				if($st!='c'){
					
					//$inprogress = openvas_task_active($task_id);
					if($inprogress){
						$progress_class="progress-warning active";
					}
					else{
						$requested=true;
					}
				}
				else if($st=='c'){
					$inprogress=100;
					$progress_class="progress-success";
				}

			}
			else{
				$inprogress=100;
			}
			if($inprogress!=false && $inprogress<0){
				$inprogress=0;
				$requested==true;
			}
			if($requested==true){
				$progress_text="Requested";
				$progress_class="";

			}
			else if($st=='s' || $st=="p"){
				$progress_text=$status." at ".$inprogress."%";
				$progress_class="progress-danger active";
			}
			else if($st!='o'){
				$progress_text=$inprogress."% Completed";
			}
			$html = '<div class="progress progress progress-striped  '.$progress_class.'"><div class="bar" style="width: '.$inprogress.'%"></div><div class="progress-text">'.$progress_text.'</div></div>';

			return $html;

		}
	}



	if(!function_exists('get_vulnerable_status')){
		function get_vulnerable_status($st){
			$o="New";
			$r="Running";
			$p="Paused";
			$s="Stopped";
			$c="Completed";
			$o_class="inverse";
			$r_class="warning";
			$p_class="info";
			$s_class="important";
			$c_class="success";
			$status=$$st;
			$temp_class=$st."_class";
			$status_cls=$$temp_class;
			return '<span class="label label-'.$status_cls.' label-mini">'.$status.'</span>';
		}
	}

	if(!function_exists('get_vulnerable_operation_btn')){
		function get_vulnerable_operation_btn($scan_id,$array = array('edit'=>'','delete'=>''),$st = null){
			$vul_url = base_url().SIMPLY_VULNERABILITY_SCAN."/";
			if($st=='o'){
				$operation='<div class="btn-group hidden-phone"><a href="'.$vul_url.'scans/'.$scan_id.'/start" class="btn green" title="Start"><i class="icon-play m-icon-white"></i></a></div>';
			} else if($st=='s'){
				$operation='<div class="btn-group hidden-phone"><a href="'.$vul_url.'/scans/'.$scan_id.'/start"  title="Start" class="btn green"><i class="icon-play m-icon-white"></i></a><a href="'.$vul_url.'scans/'.$scan_id.'/resume" class="btn green" title="Resume" ><i class="icon-step-forward m-icon-white"></i></a></div>';
			} else if($st=='r'){
				$operation='<div class="btn-group hidden-phone"><a href="'.$vul_url.'/scans/'.$scan_id.'/pause" title="Pause" class="btn blue"><i class="icon-pause m-icon-white"></i></a><a href="'.$vul_url.'scans/'.$scan_id.'/stop" class="btn red" title="Stop"><i class="icon-stop m-icon-white"></i></a></div>';
			} else if($st=='p'){
				$operation='<div class="btn-group hidden-phone"><a href="'.$vul_url.'/scans/'.$scan_id.'/resume" title="Resume" class="btn yellow "><i class="icon-step-forward m-icon-white"></i></a><a href="'.$vul_url.'scans/'.$scan_id.'/stop" class="btn red" title="Stop"><i class="icon-stop m-icon-white"></i></a></div>';
			} 
			else if($st=='c'){
				$operation='<a href="'.$vul_url.'scans/'.$scan_id.'/report" class="btn green" target="_blank">View Report </a>';
			}
			$operation.='<a href="javascript:void(0);" class="btn red">
			<i class="fa fa-edit"></i>Delete</a>';
			return $operation;
		}
	}

	/*display date*/

	/* End of file MY_datatable_helper.php */
	/* Location: ./application/helpers/MY_datatable_helper.php */  