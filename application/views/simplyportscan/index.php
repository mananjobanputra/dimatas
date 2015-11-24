 <div class="container-fluid">
   <div class="row-fluid">
    <div class="span12">

        <h3 class="page-title">
            Add  Simply Port Scan Host
        </h3>
                <!-- <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php print SITE_SIMPLYSCAN;?>dashboard">Simply Port Scan Dashboard</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>

                        <a href="<?php print SITE_SIMPLYSCAN;?>manage_hosts">Manage hosts</a>
                        <i class="icon-angle-right"></i>
                    </li>

                    <li>Add</li>
                </ul> -->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <div class="portlet box blue" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            Add host for Scanning
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <div class="row-fluid">
                            <div class="col-md-12">

                                <?php if(isset($_SESSION["emsg"])){?>
                                <div class="alert alert-danger"><?php print $_SESSION["emsg"];?></div>
                                <?php unset($_SESSION["emsg"]);} ?>
                                <?php if(isset($_SESSION["smsg"])){?>
                                <div class="alert alert-success"><?php print $_SESSION["smsg"];?></div>
                                <?php unset($_SESSION["smsg"]);} ?>

                                <div class="alert alert-error hide">
                                    <button class="close" data-dismiss="alert"></button>
                                    You have some form errors. Please check below.
                                </div>
                                <div class="alert alert-success hide">
                                    <button class="close" data-dismiss="alert"></button>
                                    Your form validation is successful!
                                </div>

                                <form action="<?php print base_url();?>simplyportscan/hosts/add" class="form-horizontal" id="scan_add_form" method="post">
                                    <h3 class="block">Provide your host details</h3>
                                    <div class="control-group">
                                        <label class="control-label">Host<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span6 m-wrap" name="h" data-h="<?php print $host_h;?>" id="h" value="<?php print $host_h;?>"/>
                                            <span class="help-inline">Give me Address of site which you want to manage..!</span>
                                        </div>

                                    </div>
                                    <?php if($h==""){?>
                                    <div class="form-actions clearfix">
                                        <input type="button" name="Continue" class="btn blue button-go" value="Go" />
                                    </div>
                                    <?php } ?>
                                    <?php if($h!=''){?>
                                    <div class="control-group">
                                        <label class="control-label">Host Name<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span6 m-wrap" name="hostname"  id="hostname" value="<?php print $host_name;?>"/>
                                            <span class="help-inline">Provide your Host name</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Alias<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span6 m-wrap" name="alias" id="alias" value="<?php print $host_alias;?>"/>
                                            <span class="help-inline">Alias or FQDN</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Address<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="address" class="span6 m-wrap" name="address" value="<?php print $host_ip;?>"/>
                                            <span class="help-inline">IP-address / DNS name</span>
                                        </div>
                                    </div>
                                    <div class="form-actions clearfix">
                                        <input type="submit" name="Continue" class="btn blue button-next" value="Submit" />
                                    </div>
                                    <?php } ?>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->         
    </div>
