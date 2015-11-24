<h3 class="page-title"><?php echo  $this->page_name?></h3>
<div class="page-bar">
 <ul class="page-breadcrumb">
  <li>
   <i class="icon-home"></i>
   <a href="index.html">Home</a>
   <i class="fa fa-angle-right"></i>
 </li>
 <li>
   <span>Form Stuff</span>
 </li>
</ul>
</div>
<!-- END PAGE HEADER-->
<div class="portlet light portlet-fit ">
 <div class="portlet-title">
  <div class="caption">
   <i class="icon-settings font-dark"></i>
   <span class="caption-subject font-dark sbold uppercase"><?php echo $this->page_name;?></span>
 </div>
</div>
<div class="portlet-body">
  <div class="row">
   <div class="col-md-12">
   <form role="form" action="<?php echo $this->from_url; ?>" method="post" class='add_edit_validate_form'>
      <div class="form-group form-md-line-input form-md-floating-label">
        <input type="text" name="full_name" id="full_name"  class="form-control <?php echo isset($profile_data["full_name"]) ? "edited" : ""; ?>" value="<?php echo isset($profile_data["full_name"]) ? $profile_data["full_name"] : ""; ?>" data-rule-required="true"/> 
        <label class="control-label">Full Name</label>
      </div>
      <div class="form-group form-md-line-input form-md-floating-label">
        <input type="text" <?php echo  (isset($this->page_type) && $this->page_type == 'edit')? 'readonly' : ''; ?> id="email" name="email" class="form-control <?php echo isset($profile_data["email"]) ? "edited" : ""; ?>" value="<?php echo isset($profile_data["email"]) ? $profile_data["email"] : ""; ?>" data-rule-required="true" /> 
        <label class="control-label">Email</label>
      </div>
     
      <?php if(isset($this->page_type) && $this->page_type == 'add'){?>
       <!-- password -->
       <div class="form-group form-md-line-input form-md-floating-label">
        <input type="password" id="register_password" name="password" class="form-control" autocomplete="off" data-rule-required="true" /> 
        <label class="control-label">Password</label>
      </div>
      <!-- end of password -->
      <!-- re-enter password -->
       <div class="form-group form-md-line-input form-md-floating-label">
        <input type="password" autocomplete="off"  name="rpassword" class="form-control" data-rule-required="true" data-rule-equalto="#register_password" /> 
        <label class="control-label">Re-type Password</label>
      </div>
      <!-- end of the re-enter password -->
      <?php } ?>
      <div class="form-group form-md-line-input form-md-floating-label">
        <textarea class="form-control <?php echo isset($profile_data["address"]) ? "edited" : ""; ?>" rows="3" id="address" name="address" data-rule-required="true"><?php echo isset($profile_data["address"]) ? $profile_data["address"] : ""; ?></textarea>
        <label class="control-label">Address</label>
      </div>
      <div class="form-group form-md-line-input form-md-floating-label">
      <input type="text" id="city" name="city" class="form-control <?php echo isset($profile_data["city"]) ? "edited" : ""; ?>"  data-rule-required="true" value="<?php echo isset($profile_data["city"]) ? $profile_data["city"] : ""; ?>"/> 
        <label class="control-label">City</label>
      </div>
      <div class="form-group form-md-line-input form-md-floating-label">
        <select name="country" id="country" class="form-control edited" data-rule-required="true">
          <option value=''>Please select country</option>  
          <?php if(!empty($country)){

            foreach ($country as $key => $value) {
              ?>
              <option <?php if($profile_data["country"] == $value["id"]){ ?> selected="selected" <?php } ?> value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
              <?php       
            } 
          }?>
        </select>
        <label class="control-label">Country</label>
      </div>
      <div class="margiv-top-10">
        <!-- <a href="javascript:;" class="btn green"> Save Changes </a> -->
        <button type="submit" class="btn green" value="" id="add_edit_user" name="">Save Changes</button>
        <a href="<?php echo user_url().'manage_users'; ?>" class="btn default"> Cancel </a>
      </div>
    </form>

   </div>
 </div>

</div>
</div>