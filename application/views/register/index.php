<div class="login-content content">
 <h1>Sign Up</h1>
 <p> Enter your personal details below: </p>
 <form class="register-form validate_form" action="<?php echo base_url(); ?>register" method="post">
  <?php 
  if($this->load->get_section('section_message') != '') { 
    echo $this->load->get_section('section_message');
  }
  ?>
  <div class="form-group form-md-line-input form-md-floating-label">
    <div class="input-group left-addon">
      <span class="input-group-addon">
        <i class="fa fa-user"></i>
      </span>
      <input class="form-control" data-rule-required="true" type="text" id="fullname" name="fullname" tabindex="1" /> 
      <label for="fullname">Full Name</label>
    </div>
  </div>
  <div class="form-group form-md-line-input form-md-floating-label">
    <div class="input-group left-addon">
      <span class="input-group-addon">
        <i class="fa fa-envelope-o"></i>
      </span>
      <input class="form-control" data-rule-required="true" data-rule-email="true" type="text" name="email" id="email" tabindex="2"/> 
      <label for="email">Email</label>
    </div>
  </div>
  <div class="form-group form-md-line-input form-md-floating-label">
    <div class="input-group left-addon">
      <span class="input-group-addon">
       <i class="fa fa-lock"></i>
     </span>
     <input class="form-control preview-password" type="password" id="password" name="password" data-rule-required="true" tabindex="3"/>
     <label for="register_password">Password</label> 
   </div>
 </div>
 <div class="form-group form-md-line-input form-md-floating-label">
   <div class="input-group left-addon">
    <span class="input-group-addon">
     <i class="fa fa-key"></i>
   </span>
   <input class="form-control preview-password" type="password" data-rule-required="true" data-rule-equalTo="#password" tabindex="4" id="rpassword" name="rpassword" /> 
   <label for="rpassword">Re-type Your Password</label>
 </div>
</div>
<div class="form-group form-md-line-input form-md-floating-label">
 <div class="input-group left-addon">
  <span class="input-group-addon">
   <i class="fa fa-location-arrow"></i>
 </span>
 <input class="form-control" tabindex="5" type="text" id="address" name="address" /> 
 <label for="address">Address</label>
</div>
</div>
<div class="form-group form-md-line-input form-md-floating-label">
  <div class="input-group left-addon">
    <span class="input-group-addon">
     <i class="fa fa-map-pin"></i>
   </span>
   <input class="form-control" tabindex="6"  type="text" id="city" name="city" /> 
   <label for="city">City/Town</label>
 </div>
</div>
<div class="form-group form-md-line-input form-md-floating-label">
  <div class="input-group left-addon">
    <span class="input-group-addon">
     <i class="fa fa-map-pin"></i>
   </span>
   <input class="form-control" tabindex="6"  type="text" id="state" name="state" /> 
   <label for="state">State</label>
 </div>
</div>
<div class="form-group form-md-line-input form-md-floating-label">
  <div class="input-group left-addon">
    <span class="input-group-addon">
      <i class="fa fa-globe"></i>
    </span>
    <select name="country" tabindex="7" id="country" class="form-control " >
     <option value=""></option>
      <?php if(!empty($country)){
        foreach ($country as $key => $value) {
          ?>
          <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
          <?php               
        } 
      }?>
    </select>
    <label for="country">Country</label>
  </div>
</div>
<div class="form-group">
  <div class="md-checkbox md-checkbox-inline">
    <input type="checkbox" name="tnc" id="tnc" data-rule-required="true" class="md-check" value="1" tabindex="8" data-error-target="no"/> 
    <label for="tnc">
      <span></span>
      <span class="inc"></span>
      <span class="check"></span>
      <span class="box"></span> 
      I agree to the
      <a href="javascript:;" tabindex="9">Terms of Service</a>
      and
      <a href="javascript:;" tabindex="10">Privacy Policy </a>
    </label>
  </div>
</div>
<div class="form-actions">
  Already have an account ?&nbsp;
    <a href="<?php print base_url();?>login" tabindex="12" class="btn btn-default uppercase red-sunglo">Login</a>
  
  <button type="submit" tabindex="11" id="register-submit-btn" class="btn blue-madison uppercase pull-right">Create account</button>
</div>
</form>
</div>
