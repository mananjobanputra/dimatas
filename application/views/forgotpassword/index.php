 <div class="login-content content">
     <h1 class="form-title">Forget your Password ?</h1>
     <p>
         Enter your e-mail address and we'll send you a link to reset your password.
     </p>
     <form class="forget-form validate_form" action="<?php echo $action_url; ?>" method="post">
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
                <input class="form-control" type="text" autocomplete="off" id="email" name="email" data-rule-required="true" data-rule-email="true" tabindex="1" /> 
                <label  for="email">Email</label>
            </div>
        </div>
        <div class="form-actions">
            <a tabindex="3" href="<?php print $login_url;?>" class="btn red-sunglo uppercase btn-default">Return to Login</a>
            <button tabindex="2" type="submit" class="btn btn-primary blue-madison uppercase pull-right">Send Link</button>
        </div>
    </form> 
    <div class="text-center forgot-lock-opacity">
        <span class="fa-stack fa-5x ">
          <i class="fa fa-circle fa-stack-2x font-grey-cascade"></i>
          <i class="fa fa-lock  fa-stack-1x fa-inverse"></i>
      </span>
  </div>
</div>
