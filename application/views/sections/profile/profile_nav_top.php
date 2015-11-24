 <ul class="nav nav-tabs">
 <li class="<?php echo (isset($active_tab) && $active_tab == 'personal_info')? 'active' : '' ?>">
 <a href="<?php echo user_url(true);?>profile/edit" >Edit Profile</a>
 </li>

 <li class="<?php echo (isset($active_tab) && $active_tab == 'change_password')? 'active' : '' ?>">
 <a href="<?php echo user_url(true);?>profile/change_password" >Change Password</a>
 </li>

 </ul>