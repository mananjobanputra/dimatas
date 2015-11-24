 <div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item start <?php if($controller_name == 'dashboard'){ ?> active open <?php } ?>">
                <a href="<?php echo user_url(true); ?>dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>                
            </li>

            <?php 
            if(isset($this->current_login_type) && $this->current_login_type == 'admin'){?> 

            <li class="nav-item  <?php if($controller_name == 'settings'){ ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-pointer"></i>
                    <span class="title">General Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/settings" class="nav-link ">
                            <span class="title">Site Settings</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/theme_settings" class="nav-link ">
                            <span class="title">Theme Settings</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/manage_contents" class="nav-link ">
                            <span class="title">Manage Contents</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/manage_users" class="nav-link ">
                            <span class="title">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo user_url(); ?>profile" class="nav-link ">
                            <span class="title">Profile</span>
                        </a>
                    </li>
                    
                </ul>
            </li>

            <?php } ?>
            

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>