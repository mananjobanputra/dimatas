<?php   

$msg_succ = $this->session->flashdata('success');
$msg_error = $this->session->flashdata('error');
$msg_info = $this->session->flashdata('message');



if($msg_succ != "")
{
  $not_type = "success";
  if(!empty($msg_succ) && is_array($msg_succ))
  {
    foreach ($msg_succ as $key => $value) {
      $msg .= $value."<br />";
    }
  }
  else
   $msg = $msg_succ;
}
else if($msg_info!=""){
  $not_type = "info";
  if(!empty($msg_info) && is_array($msg_info))
  {
    foreach ($msg_info as $key => $value) {
      $msg .= $value."<br />";
    }
  }
  else
   $msg = $msg_info;
} 
else{
 $not_type = "error";
 if(!empty($msg_error) && is_array($msg_error))
 {
   
  foreach ($msg_error as $key => $value) {
    $msg .= $value."<br />";
  }
}
else
  $msg = $msg_error;

$msg = $msg;
}

if($msg != "")
{
  $notification = $msg;               
}
else
{
  $notification = '';
} 
?>