
<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet ">

        <div class="profile-usertitle">
            <div class="profile-usertitle-name">  <?php echo $this->current_session["full_name"]; ?> </div>

        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <li class="<?php echo ($main_tab == 'overview')? 'active' : ''?>">
                    <a href="<?php echo user_url(true)?>profile">
                        <i class="icon-home"></i> Overview </a>
                    </li>
                    <li class="<?php echo ($main_tab == 'account_setting')? 'active' : ''?>">
                        <a href="<?php echo user_url(true);?>profile/edit">
                            <i class="icon-settings"></i> Account Settings </a>
                        </li>
                        
                    </ul>
                </div>

            </div>

        </div>
