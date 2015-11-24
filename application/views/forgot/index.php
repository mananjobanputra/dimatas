 <!-- BEGIN FORGOT PASSWORD FORM -->

 <?php
 $temp = admin_url();
 if($temp == "true")
 {
    $url = base_url()."auth/admin_forgot_password";
}
else{
    $url = base_url()."auth/forgot";
}
?>



<form class="forget-form validate_form" action="<?php echo $url; ?>" method="post">
    <div class="form-title">
        <span class="form-title">Forget Password ?</span>
        <span class="form-subtitle">Enter your e-mail to reset it.</span>
    </div>
    <div class="form-group">
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" data-rule-required="true" data-rule-email="true" /> 
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn btn-default default">Back</button>
        <button type="submit" class="btn btn-primary red uppercase pull-right">Submit</button>
    </div>
</form>
            <!-- END FORGOT PASSWORD FORM -->