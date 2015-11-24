<div class="login-content content">
   <h1>Login to your account</h1>
   <form class="login-form validate_form" action="<?php echo $action_url; ?>" method="post" autocomplete="off">
    <?php 
    if($this->load->get_section('section_message') != '') { 
        echo $this->load->get_section('section_message');
    }
    ?>
    <div class="form-group form-md-line-input form-md-floating-label">
        <div class="input-group left-addon">
            <span class="input-group-addon">
                <i class="fa fa-envelope-o"></i>
            </span>
            <input class="form-control" type="text" autocomplete="off"  id="email" name="email" data-rule-required="true" tabindex="1" data-rule-email="true" /> 
            <label  for="email">Email</label>
        </div>

    </div>
    <div class="form-group form-md-line-input form-md-floating-label">
        <div class="input-group left-addon">
         <span class="input-group-addon">
             <i class="fa fa-lock"></i>
         </span>
         <input class="form-control preview-password" type="password" autocomplete="off" id="password" name="password" tabindex="2" data-rule-required="true" /> 
         <label for="password">Password</label>
     </div>
 </div>
 <div class="form-actions">       

    <div class="md-checkbox md-checkbox-inline">
        <input type="checkbox" name="remember" tabindex="3" id="remember" class="md-check" value="1" /> 
        <label for="remember">
            <span></span>
            <span class="check"></span>
            <span class="box"></span> Remember me 
        </label>
    </div>

    <button type="submit" tabindex="4" class="btn blue-madison  uppercase pull-right"> Login </button>
</div>
<?php if(isset($type) && $type != 'admin'){?>
<div class="login-options">
    <h4>Or login with</h4>
    <ul class="social-icons">
        <li>
            <a class="facebook " data-window="facebook" data-original-title="facebook" href="<?php echo base_url()."social/facebook"; ?>"> </a>
        </li>
        <li>
            <a class="googleplus " data-window="google" data-original-title="Goole Plus" href="<?php echo base_url()."social/google"; ?>"> </a>
        </li>
    </ul>
</div>
<?php }?>
<div class="forget-password">
    <h4>Forgot your password ?</h4>
    <p> no worries, click
        <a href="<?php echo $this->forgot_url;?>" tabindex="5" id="forget-password"> here </a> to reset your password. 
    </p>
</div>
<?php if(isset($type) && $type != 'admin'){?>    
<div class="create-account">
    <p> Don't have an account yet ?&nbsp;
        <a href="<?php echo  $this->register_url;?>" tabindex="6" class="btn btn-default uppercase red-sunglo" id="register-btn"> Create an account </a>
    </p>
</div>
<?php }?>
</form>
</div>       
