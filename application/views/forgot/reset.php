<?php

$url = base_url()."auth/reset_password/".$code;

?>
<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form validate_form" action="<?php echo $url;?>" method="post">
    <div class="form-title">
        <span class="form-title">Reset Password </span>
    </div>
    <input type="hidden" id="code" value="<?php echo $code; ?>" name="code">
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" data-rule-required="true"  />
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
      <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" data-rule-required="true" data-rule-equalto="#register_password" /> 
  </div>
  <div class="form-actions">
    <button type="button" id="back-btn" class="btn btn-default default">cancel</button>
    <button type="submit" class="btn btn-primary red uppercase pull-right">Submit</button>
</div>
</form>
<!-- END FORGOT PASSWORD FORM -->