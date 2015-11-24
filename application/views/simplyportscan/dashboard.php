

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
           <h3 class="page-title">
            Simply Port Scan Dashboard <small>statistics and more</small>
        </h3>

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url(); ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Simply Port Scan Dashboard</span>
                </li>
            </ul>

        </div>




    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i>
                    <span class="hidden-480">Simply Port Scan Dashboard </span>
                </div>
            </div>
            <div class="portlet-body form">

                <form class="form-horizontal" action="<?php print SITE_URL?>SimplyPortScan/hosts/add" id="add_scan_host" name="add_scan_host">
                    <br/>
                    <div class="control-group">
                        <label class="control-label">Select Host</label>
                        <div class="controls">
                            <input id="h" type="hidden" name='h' >
                            <input id="ht" type="text" name='ht' class="span6 m-wrap">

                        </div>
                    </div>
                    <div class="custom_scan" style="display:none">
                        <div class="control-group">
                            <label class="control-label">Scan Type</label>
                            <div class="controls">

                                <?php foreach($scan_type_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                                <?php foreach($udpscan_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                                <?php foreach($rpcscan_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>"name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Ping Type</label>
                            <div class="controls">
                                <?php foreach($ping_type_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">General Options</label>
                            <div class="controls">
                                <?php foreach($gen_option_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="<?php print (isset($sc['text_placeholder']) && $sc['text_placeholder']!='')?$sc['text_placeholder']:"";?>" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Timing Options</label>
                            <div class="controls">
                                <?php foreach($timing_options_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="<?php print (isset($sc['text_placeholder']) && $sc['text_placeholder']!='')?$sc['text_placeholder']:"";?>" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Verbose Options</label>
                            <div class="controls">
                                <?php foreach($verbose_options_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="<?php print (isset($sc['text_placeholder']) && $sc['text_placeholder']!='')?$sc['text_placeholder']:"";?>" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">DNS Options</label>
                            <div class="controls">
                                <?php foreach($dns_options_arr as $sc){?>
                                <label class="<?php print $sc['type'];?> line">
                                    <input type="<?php print $sc['type'];?>" name="<?php print $sc['name'];?>" value="<?php print $sc['value']?>" <?php print ($sc['checked']==true)?"checked='checked'":"";?> class="<?php print $sc['class'];?>">
                                    <?php print $sc['text'];?> <?php
                                    if($sc['extra']!='')
                                        {?>
                                    - <input type="text" placeholder="<?php print (isset($sc['text_placeholder']) && $sc['text_placeholder']!='')?$sc['text_placeholder']:"";?>" name="<?php print $sc['extra'];?>" class="m-wrap large extra_text">
                                    <?php } ?> 
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn green btn_scan" value='n'>Normal Scan &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
                        <button type="button" class="btn green btn_scan" value='f'>Fast Scan &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
                        <button type="button" class="btn green btn_scan" value='v'>Verbose Scan &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
                        <button type="button" class="btn green btn_scan" value='c'>Custom Scan &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>



                    </div>
                </form>
                <!-- END FORM-->  
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

<div class="scans">
    <div class="row">
        <div class="col-md-3 col-xs-12 col-sm-6 pull-right text-right">
            <div class="margin-bottom-10" id="">
                <button type="button" class="btn" data-action="expand-all">Expand All</button>
                <button type="button" class="btn" data-action="collapse-all">Collapse All</button>
            </div>
        </div>
    </div>

    <?php if($count>0){

        foreach ($res as $key => $row)                   
            {?>
        <div class="row scan pending_scan" id='scan_<?php print $row['host_id'];?>' data-id="<?php print $row['id'];?>">
            <div class="col-md-12">
                <div class="row">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption font-<?php print $row['class'];?>"><i class="<?php print $row['icon'];?> font-<?php print $row['class'];?>"></i>
                                <span class="caption-subject bold ">
                                    <?php print $row['host_alias'];?>
                                </span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse "></a>

                            </div>
                        </div>
                        <div class="portlet-body" >
                            <h2><?php print $row['host_ip'];?> <span class="label label-<?php print $row['status_cls'];?> label-mini"><?php print $row["status"];?></span></h2>
                            <?php print $row["command_text"];?>

                            <div class="margin-top-10 margin-bottom-10 clearfix"></div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            Output
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="width_set">
                                                <pre class="break_word">
                                                    <?php print $row["output"];?>
                                                </pre>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php }
    } ?>                            
</div>

