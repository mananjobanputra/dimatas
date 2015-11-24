<h3 class="page-title">My Profile 
    <!-- <small>user account page</small> -->
</h3>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
     <?php if($this->load->get_section('section_profile_left') != '') { 
       echo $this->load->get_section('section_profile_left');
   }?>
   <!-- BEGIN PROFILE CONTENT -->
   <div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase"><?php print $tab_caption;?></span>
                    </div>
                    <?php if($this->load->get_section('section_profile_nav_top') != '') { 
                        echo $this->load->get_section('section_profile_nav_top');
                    }?>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                         <?php if($this->load->get_section('section_profile_content') != '') { 
                                 echo $this->load->get_section('section_profile_content');
                         }?>

                         <?php if($this->load->get_section('section_profile_change_password') != '') { 
                                 echo $this->load->get_section('section_profile_change_password');
                         }?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PROFILE CONTENT -->
</div>
</div>