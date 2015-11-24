 <div class="login-content content">
   <h1 class="form-title">Reset your Password ?</h1>
   
   <form class="forget-form validate_form" action="<?php echo base_url(); ?>resetpassword/<?php print $token;?>" method="post">
    <?php 
    if($this->load->get_section('section_message') != '') { 
      echo $this->load->get_section('section_message');
    }
    ?>
    <div class="form-group form-md-line-input form-md-floating-label">
      <div class="input-group left-addon">
        <span class="input-group-addon">
        <i class="fa fa-lock"></i>
        </span>
        <input class="form-control preview-password" type="password" autocomplete="off" id="password" name="password" data-rule-required="true" tabindex="1" /> 
        <label for="password">Password</label>
      </div>
    </div>
    <div class="form-group form-md-line-input form-md-floating-label">
     <div class="input-group left-addon">
      <span class="input-group-addon">
       <i class="fa fa-key"></i>
     </span>
     <input class="form-control preview-password" type="password" data-rule-required="true" data-rule-equalTo="#password" tabindex="2" id="rpassword" name="rpassword" /> 
     <label for="rpassword">Re-type Your Password</label>
   </div>
 </div>
 <div class="form-actions">
  <button tabindex="2" type="submit" class="btn btn-primary blue-madison uppercase pull-right">Reset password</button>
</div>
</form> 
<div class="text-center forgot-lock-opacity">
  <span class="fa-stack fa-5x ">
    <i class="fa fa-circle fa-stack-2x font-grey-cascade"></i>
    <i class="fa fa-lock  fa-stack-1x fa-inverse"></i>
  </span>
</div>
</div>
