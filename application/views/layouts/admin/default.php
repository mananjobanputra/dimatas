<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title><?php echo $title; ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

  <?php 
  if($this->load->get_section('section_css') != '') 
   echo $this->load->get_section('section_css');
 ?>
 <!-- END THEME LAYOUT STYLES -->
 <link rel="shortcut icon" href="favicon.ico" /> </head>
 <!-- END HEAD -->

 <body class="<?php print $this->body_class;?> page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
  <?php 
  if($this->load->get_section('section_header') != '') 
  { 
    echo $this->load->get_section('section_header');
  }

  ?>    
  <!-- BEGIN HEADER & CONTENT DIVIDER -->
  <div class="clearfix"> </div>
  <!-- END HEADER & CONTENT DIVIDER -->

  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php 
    if($this->load->get_section('section_sidebar') != '') 
    { 
     echo $this->load->get_section('section_sidebar');
   }
   ?> 
   <!-- END SIDEBAR -->
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <?php
      if($this->load->get_section('section_message') != '' && $this->msg_in_seperate_template!=true) { 
        echo $this->load->get_section('section_message');
      }
      ?> 
      <?php echo $output; ?>
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN QUICK SIDEBAR -->
<?php
if($this->load->get_section('section_quicksidebar') != '') { 
  echo $this->load->get_section('section_quicksidebar');
}
?> 
<!-- END QUICK SIDEBAR -->
<!-- BEGIN FOOTER -->

<?php
if($this->load->get_section('section_footer') != '') { 
  echo $this->load->get_section('section_footer');
}
?>    


<!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->


<script type="text/javascript">
  var config={
    notification: "<?php print ($notification != NULL) ? $notification : NULL ;?>",
    siteUrl:'<?php print base_url();?>',
    AssetUrl:'<?php print base_url();?>assets/',
    ViewUrl:'<?php print base_url();?>assets/views/',
    pg_name:'<?php  echo isset($this->page_name)? $this->page_name : '' ?>',
    simply_port_scan:'<?php  echo SIMPLY_PORT_SCAN; ?>',
    simply_monitor_scan:'<?php  echo SIMPLY_MONITOR_SCAN; ?>',
    simply_vulnerability_scan:'<?php  echo SIMPLY_VULNERABILITY_SCAN; ?>',

  };
</script>    

<?php
if($this->load->get_section('section_js') != '') { 
  echo $this->load->get_section('section_js');
}
?>
</body>

</html>