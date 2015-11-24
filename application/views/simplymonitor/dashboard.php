<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="col-md-12">
           <h3 class="page-title">
            Simply Monitor Dashboard <small>statistics and more</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url(); ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Simply Monitor Dashboard</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="row-fluid search-forms search-default">
        <form class="form-search" action="<?php print base_url();?>SimplyMonitor/hosts/add" id="add_host" name="add_host">
            <div class="chat-form">
                <div class="input-cont">   
                    <input type="text" placeholder="Hey..!! Give me Address of site which you want to manage..!" class="m-wrap" id="h" name="h">
                </div>
                <button type="submit" class="btn green">GO &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="row-fluid">
   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" data-tablet="span6" data-desktop="span3">
    <div class="dashboard-stat blue">
        <div class="visual">
            <i class="icon-cloud"></i>
        </div>
        <div class="details">
            <div class="number">
                <?php print  $total_hosts;?>
            </div>
            <div class="desc">                           
                Total <?php print ($total_hosts>1)?"Hosts":"Host";?> 
            </div>
        </div>  

    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" data-tablet="span6" data-desktop="span3">
    <div class="dashboard-stat red" id="<?php print  $cookie_final_class[0];?>">
        <div class="visual">
            <i class="icon-arrow-down"></i>
        </div>
        <div class="details">
            <div class="number">
                <?php print  $hosts_full_down_count;?>
            </div>
            <div class="desc">                           
                <?php print ($hosts_full_down_count>1)?"Hosts":"Host";?> Down
            </div>
        </div>                              
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" data-tablet="span6" data-desktop="span3">
    <div class="dashboard-stat yellow" id="<?php print  $cookie_final_class[1];?>">
        <div class="visual">
            <i class="icon-warning-sign"></i>
        </div>
        <div class="details">
            <div class="number">
                <span data-counter="counterup" data-value="<?php print $hosts_partial_down_count;?>"><?php print $hosts_partial_down_count;?></span>
            </div>
            <div class="desc">                           
                <?php print ($hosts_partial_down_count>1)?"Hosts":"Host";?>  Partial Down
            </div>
        </div>                                             
    </div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" data-tablet="span6" data-desktop="span3">
    <div class="dashboard-stat grey" >
        <div class="visual">
            <i class=" icon-minus-sign"></i>
        </div>
        <div class="details">
            <div class="number">
                <span data-counter="counterup" data-value="<?php print $hosts_pending_count;?>"><?php print $hosts_pending_count;?></span>
            </div>
            <div class="desc">                           
                <?php print ($hosts_pending_count>1)?"Hosts":"Host";?> Pending
            </div>
        </div>                                         
    </div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" data-tablet="span6" data-desktop="span3">
    <div class="dashboard-stat green">
        <div class="visual">
            <i class="icon-arrow-up"></i>
        </div>
        <div class="details">
            <div class="number">
                <span data-counter="counterup" data-value="<?php print $hosts_up_count;?>"><?php print $hosts_up_count;?></span>
            </div>
            <div class="desc">                           
                <?php print ($hosts_up_count>1)?"Hosts":"Host";?> Up
            </div>
        </div>                                 
    </div>
</div>



</div>
<div class="col-md-3 pull-right text-right">
    <div class="margin-bottom-10" id="">
        <button type="button" class="btn" data-action="expand-all">Expand All</button>
        <button type="button" class="btn" data-action="collapse-all">Collapse All</button>
    </div>
</div>
<?php 

if(!empty($host_2)){
    $content='';

    $array=array("host_full_down","host_partial_down","host_up","host_pending");
    for($i=0;$i<count($array);$i++)
    {
        if($array[$i]=="host_full_down")
        {
            $cls="red";
            $icon="icon-arrow-down";
            $status_cls="important";
            $status="Host Down";

        }
        else if($array[$i]=="host_partial_down")
        {
            $cls="yellow";
            $icon="icon-warning-sign";
            $status_cls="warning";
            $status="Host Partially Down";
        } 
        else if($array[$i]=="host_up")
        {
            $cls="green";
            $icon="icon-arrow-up";
            $status_cls="success";
            $status="Host Up";  
        }
        else if($array[$i]=="host_pending")
        {
            $cls="grey";
            $icon="icon-minus-sign";
            $status_cls="default";
            $status="Host Pending";
        }
                    //  print_r($host_2[$array[$i]]);
        foreach($host_2[$array[$i]] as $hh=>$vv)
        {
                        //  print_r($hh);
                        //  print "<pre>";                      
                        //  print_r($vv);
                            //print "</pre>";

            $content.='<div class="row-fluid">
            <div class="col-md-12">
                <div class="row-fluid">
                    <div class="portlet box '.$cls.'">
                        <div class="portlet-title">
                            <div class="caption"><i class="'.$icon.'"></i>'.$vv["alias"].'</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>

                            </div>
                        </div>
                        <div class="portlet-body">
                            <h2>'.$vv["alias"].' <span class="label label-'.$status_cls.' label-mini">'.$status.'</span></h2>
                            <p>IP : '.$vv["ip"].'<p>

                                <div class="margin-top-10 margin-bottom-10 clearfix">
                                    <table class="table table-bordered table-striped">
                                        <tbody>';

                                            $array1=array("service_detail","services_pending");
                                            for($j=0;$j<count($j);$j++)
                                            {
                                                $flag=false;
                                                if(!empty($vv[$array1[$j]]))
                                                {
                                                    if($flag==false)
                                                    {
                                                        $flag=true;
                                                        $content.='<tr>

                                                        <th>
                                                            Service
                                                        </th>

                                                        <th>
                                                            Output
                                                        </th>
                                                        <th>
                                                            Status
                                                        </th>
                                                        <th>
                                                            Last Change
                                                        </th>

                                                        <th>
                                                            Last Check
                                                        </th>

                                                    </tr>                               


                                                    ';
                                                }
                                                foreach($vv[$array1[$j]] as $ss)
                                                {
                                                    if(isset($ss["class"])){

                                                        if($ss["class"]=="critical")
                                                        {
                                                            $cls1="important";
                                                            $status_ss="Critical";
                                                        }
                                                        else if($ss["class"]=="warning")
                                                        {
                                                            $cls1="warning";
                                                            $status_ss="Warning";
                                                        }
                                                        else if($ss["class"]=="unhandled service problem")
                                                        {
                                                            $cls1="inverse";
                                                            $status_ss="Unhandled Service Problem";
                                                        }
                                                        else {
                                                            $cls1="success";        
                                                            $status_ss="OK";                                                    
                                                        }
                                                    }
                                                    else{
                                                        $cls1="default";
                                                        $status_ss="Pending";
                                                    }

                                                    $content .=  '<tr>
                                                    <td>
                                                        '.$ss["service_alias"].'
                                                    </td>
                                                    <td>
                                                        '.((isset($ss['output']))?$ss['output']:'-').'

                                                    </td>
                                                    <td>
                                                        <span class="label label-'.$cls1.'">'.$status_ss.'</span>

                                                    </td>
                                                    <td>
                                                        '.((isset($ss['last_hard_state_change']))?$ss['last_hard_state_change']:'-').'

                                                    </td>
                                                    <td>
                                                        '.((isset($ss['last_check']))?$ss['last_check']:'-').'                                      
                                                    </td>


                                                </tr>';
                                            }


                                        }   
                                        $content.="</tbody></table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>";
                }



            }   
        }

    }

    print $content;
    ?>



</div>
