 <div class="home-header">
    <div class="home-logo osLight"><span class="fa fa-home"></span><?php echo site_name();?></div>
    <a href="javascript:void(0)" class="home-navHandler visible-xs"><span class="fa fa-bars"></span></a>
    <div class="home-nav">
        <ul>
        	<?php if(!$this->current_session || $this->current_login_type== 'admin'){ ?>
        	<li><a href="<?php print site_url('signup')?>" data-remote-content="true" data-toggle="modal" data-class="modal-sm" data-class="model-sm" data-target="#RemoteModal"><?php echo lang('Sign Up')?></a></li>
            <li><a href="<?php print site_url('signin')?>" data-remote-content="true" data-toggle="modal" data-class="modal-sm" data-target="#RemoteModal"><?php echo lang('Sign In')?></a></li>
            <?php } ?>	
            <?php if($this->current_login_type != "" && $this->current_login_type != 'admin' && $this->current_login_type != 'n'){ ?>   
            <li> 
                <a href="<?php echo user_url()."dashboard"; ?>" class="">
                    <?php echo lang('Dashboard');?>
                </a>
            </li>
            <li> 
                <a href="<?php echo base_url()."logout"; ?>" class="">
                    <?php echo lang('Logout');?>
                </a>
            </li>
            <?php } ?>
            <li>
                <?php if($this->user_session && $this->user_session["is_owner"] == 'y'){ ?>   
                <a href="<?php echo base_url()."user/property/add"; ?>" class="btn btn-green"><?php echo lang('List a Property');?></a>
                <?php }else if($this->user_session && $this->user_session["is_owner"] == 'n'){
                 ?>
                 <a href="<?php echo base_url()."auth/change_ownership"; ?>" class="btn btn-green"><?php echo lang('List a Property');?></a>
                 <?php
             } ?>
         </li>
     </ul>

 </div>
</div>
<?php  /*echo $this->hhh;
exit;*/
?>
