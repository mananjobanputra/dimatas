 <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php if($controller_name == 'dashboard'){ ?> active open <?php } ?>">
                <a href="<?php echo user_url(true); ?>dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>                
            </li>
            <?php if(isset($this->current_login_type) && $this->current_login_type == 'user'){ ?>

            <li class="nav-item start <?php if($controller_name == 'profile'){ ?> active open <?php } ?>">
                <a href="<?php echo base_url(); ?>profile" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Profile</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>                
            </li>

            <li class="nav-item  <?php if($controller_name == SIMPLY_MONITOR_SCAN){ ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-pointer"></i>
                    <span class="title">Simply Monitor</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>settings" class="nav-link ">
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>theme_settings" class="nav-link ">
                            <span class="title">Manage Hosts</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>manage_contents" class="nav-link ">
                            <span class="title">Add Host</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item <?php if($controller_name == SIMPLY_PORT_SCAN){ ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-pointer"></i>
                    <span class="title">Simply Port Scan</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  <?php if($method_name == 'index'){ ?> active <?php } ?>">
                        <a href="<?php echo base_url().SIMPLY_PORT_SCAN."/"; ?>" class="nav-link ">
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php if($method_name == 'hosts'){ ?> active <?php } ?>">
                        <a href="<?php echo base_url().SIMPLY_PORT_SCAN."/hosts"; ?>" class="nav-link ">
                            <span class="title">Manage Hosts</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php if($method_name == 'add'){ ?> active <?php } ?>">
                        <a href="<?php echo base_url().SIMPLY_PORT_SCAN."/add"; ?>" class="nav-link ">
                            <span class="title">Add Host</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item  <?php if($controller_name == SIMPLY_VULNERABILITY_SCAN){ ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-pointer"></i>
                    <span class="title">Simply Vulnerability Scan</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>settings" class="nav-link ">
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>theme_settings" class="nav-link ">
                            <span class="title">Manage Scans</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>manage_contents" class="nav-link ">
                            <span class="title">Completed Scans</span>
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