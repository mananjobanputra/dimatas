<?php
/*
 *    Copyright (C) 2014-2015  Dustin Demuth
 *    Westfälische Wilhelms-Universität Münster
 *    Zentrum für Informationsverarbeitung - CERT
 *    
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 2 of the License, or
 *    (at your option) any later version.
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
/*
 * This function draws a Button.
 * The type of the button can be modified, as well as the buttonvalue
 */

function makeButton($typeOfButton, $buttonvalue, $buttontext = "Openvas_Plugin_Button") {

    switch ($typeOfButton) {
        case "ScanTarget":
            // If no Active Task exists for this IP
        print '<input type="text" class="form-control " name="openvas_targetip" placeholder="Enter Host" value="' . $buttonvalue . '" />';
        print '<input type="hidden" name="openvas_operation" value="scantarget" />';
            //deactivate button if an active scan exists
        $inprogress = openvas_action_chain_task_active_for_ip($buttonvalue);

        if (!$inprogress) {
            print '
            <span class="input-group-btn">
                <button type="submit" class="btn btn-search btn-primary">' . $buttontext . '</button>
            </span>';
        } else {
                //print '<input type="submit" disabled="disabled" value="' . $buttontext . '" />';
            print '<progress value="'.$inprogress.'" max="100" title="Scanne: '.$inprogress.'%" alt="Scanne: '.$inprogress.'%">'.$inprogress.'%</progress>';
        }
        break;
        case "GetReport":
        print '<input type="text" class="form-control " name="openvas_targetip" placeholder="Enter Host" value="' . $buttonvalue . '" />';
        print '<input type="hidden" name="openvas_operation" value="getreport" />';
            $timestamp = true; //initialise a non empty timestamp variable
            $latestreport = openvas_actionchain_getlatestreport_for_ip($buttonvalue, $timestamp);
            if ($latestreport){
                if ($timestamp === TRUE){
                    print '<span class="input-group-btn">
                    <button type="submit" class="btn btn-search btn-primary">' . $buttontext . '</button>
                </span>';
            }else{
                print '<input type="submit" class="btn btn-success" value="' . $buttontext . '" title="Report vom '.$timestamp.' herunterladen"/>';
            }
        }
        break;
    }
    print '</div></form>';
}

/*
 * Initialise the plugin and check if something was posted to it.
 */

function openvas_plugin_init() {
    //cycle through all available Methods, defined in the array above.
    $method = filter_input(INPUT_POST, "openvas_operation");

    switch ($method) {
        case "scantarget":
        $ip = filter_input(INPUT_POST, "openvas_targetip");
        if(!isset($_SESSION['ips'][$ip])){
            $_SESSION['ips'][$ip]=array(); 
        }

        $result=openvas_action_chain_scantarget($ip);
            /*print_r($result);
            print_r($_SESSION);*/
            
            if($result['status']=='error'){
                $_SESSION['error']=$result['msg'];
                unset($_SESSION['ips'][$ip]);
            }
            print '<meta http-equiv=REFRESH CONTENT=1;url=http://54.173.133.74/demo/>';
            //header("Refresh: 3;url:http://54.173.133.74/demo/");
            exit;
            break;
            case "getreport":
            $ip = filter_input(INPUT_POST, "openvas_targetip");
            $reportid = openvas_actionchain_getlatestreport_for_ip($ip);

            $report = openvas_actionchain_getreport_pdf($reportid);

            return_as_file($report, $ip);
            break;
            default:
            //There is nothing to do...
            break;
        }


    }

/*
 * Returns an Array as a File, to make it downloadable
 * @Param an array['data', 'mimetype', 'extension']
 */
function return_as_file($array, $ip){

    $data = base64_decode($array['data']);
    $length=strlen($data);
    header('Content-Description: File Transfer');
    header('Content-Type: '.$array['mimetype']);//<<<<
    header('Content-Disposition: attachment; filename=Report_for_IP_'.$ip.'.'.$array['extension']);
    header('Content-Transfer-Encoding: BASE64');
    header('Content-Length: ' . $length);
    
    print $data;
    exit;
}
function XML2Array ( $xml ) 
{ 
    $array = simplexml_load_string ( $xml ); 
    $newArray = array ( ) ; 
    $array = ( array ) $array ; 
    foreach ( $array as $key => $value ) 
    { 
        $value = ( array ) $value ; 
        $newArray [ $key] = $value [ 0 ] ; 
    } 
    $newArray = array_map("trim", $newArray); 
    return $newArray ; 
} 
function openvas_action_chain_delete_report($report_id){
    $result=array("status"=>'success',"msg"=>"");
    
    $deleteReportresponse=simplexml_load_string(send_Commands(cmd_deleteReport($report_id)));
   
    if($deleteReportresponse->delete_report_response['status']=='200' || $deleteReportresponse->delete_report_response ['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task pause error.';
    }
    return $result;
}
function openvas_action_chain_delete_target($target_id){
    $result=array("status"=>'success',"msg"=>"");
    
    $deleteTargetresponse=simplexml_load_string(send_Commands(cmd_deleteTarget($target_id)));
    if($deleteTargetresponse->delete_target_response['status']=='200' || $deleteTargetresponse->delete_target_response ['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task pause error.';
    }
    return $result;
}
function openvas_action_chain_delete_task($task_id){
    $result=array("status"=>'success',"msg"=>"");
    
    $deleteTaskresponse=simplexml_load_string(send_Commands(cmd_deleteTask($task_id)));
    
    if($deleteTaskresponse->delete_task_response['status']=='200' || $deleteTaskresponse->delete_task_response['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task pause error.';
    }
    return $result;
}
function openvas_action_chain_startresume_scan($targetid,$taskid){
    $result=array("status"=>'success',"msg"=>"","target_id"=>$targetid,"task_id"=>$taskid,"report_id"=>"");

    $resumestarttaskresponse=simplexml_load_string(send_Commands(cmd_resume_or_startTask($taskid)));
    
    if(isset($resumestarttaskresponse->resume_or_start_task_response[0]->report_id) && $resumestarttaskresponse->resume_or_start_task_response[0]->report_id!=''&& ($resumestarttaskresponse->resume_or_start_task_response[0]['status']=='202' || $resumestarttaskresponse->resume_or_start_task_response[0]['status']=='200')){

        $new_report_id=$resumestarttaskresponse->resume_or_start_task_response[0]->report_id;
        $result['report_id']=$new_report_id;

    }
    else{
        $result['status']='error';
        $result['msg']='Task start error.';
    }
    return $result;
}
function openvas_action_chain_resume_paused_scan($taskid){
    $result=array("status"=>'success',"msg"=>"");
    
    $resumepausedtaskresponse=simplexml_load_string(send_Commands(cmd_resumepausedTask($taskid)));
   
    if($resumepausedtaskresponse->resume_paused_task_response['status']=='200' || $resumepausedtaskresponse->resume_paused_task_response['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task pause error.';
    }
    return $result;
}
function openvas_action_chain_start_stopped_scan($taskid){
    $result=array("status"=>'success',"msg"=>"");
    
    $starttaskresponse=simplexml_load_string(send_Commands(cmd_startTask($taskid)));
   
    if($starttaskresponse->start_task_response ['status']=='200' || $starttaskresponse->start_task_response ['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task start error.';
    }
    return $result;
}
function openvas_action_chain_resume_stopped_scan($taskid){
    $result=array("status"=>'success',"msg"=>"");
    
    $resumestoppedtaskresponse=simplexml_load_string(send_Commands(cmd_resumestoppedTask($taskid)));
   
    if($resumestoppedtaskresponse->resume_stopped_task_response['status']=='200' || $resumestoppedtaskresponse->resume_stopped_task_response['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task resume error.';
    }
    return $result;
}
function openvas_action_chain_pause_scan($taskid){
    $result=array("status"=>'success',"msg"=>"");
    
    $pausetaskresponse=simplexml_load_string(send_Commands(cmd_pauseTask($taskid)));
   
    if($pausetaskresponse->pause_task_response['status']=='200' || $pausetaskresponse->pause_task_response['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task pause error.';
    }
    return $result;
}
function openvas_action_chain_stop_scan($taskid){
    $result=array("status"=>'success',"msg"=>"");

    $stoptaskresponse=simplexml_load_string(send_Commands(cmd_stopTask($taskid)));

    if($stoptaskresponse->stop_task_response['status']=='200' || $stoptaskresponse->stop_task_response['status']=='202'){

    }
    else{
        $result['status']='error';
        $result['msg']='Task stop error.';
    }
    return $result;
}
function openvas_action_chain_scantarget($ip,$action="c") {
    $result=array("status"=>'success',"msg"=>"","target_id"=>"","task_id"=>"","report_id"=>"");
    $targetids = openvas_get_targets_for_ip($ip);
    /*create a new TARGET with this IP*/
    $newTargetResponse = simplexml_load_string(send_Commands(cmd_createTarget($ip)));
    
    if(isset($newTargetResponse->create_target_response['id']) && $newTargetResponse->create_target_response['id']!='' && $newTargetResponse->create_target_response['status']=='201'){

        $newtargetid = $newTargetResponse->create_target_response['id'];
        $result['target_id']=$newtargetid;
        /*create a new TASK using this TARGET*/
        $newtaskresponse = simplexml_load_string(send_Commands(cmd_createTask($ip, $newtargetid)));
        
        if(isset($newtaskresponse->create_task_response['id']) && $newtaskresponse->create_task_response['id']!='' && $newtaskresponse->create_task_response['status']=='201'){
            $newtaskid=$newtaskresponse->create_task_response['id'];

            $result['task_id']=$newtaskid;

        }
        else{
            $result['status']='error';
            $result['msg']='Task creation error.';
        }

    }
    else{
        $result['status']='error';
        $result['msg']='Target creation error.';

    }

    return $result;

}

/*
 * Checks if an active task exist for an IP-Address
 * @param IP-Address
 * @return PROGRESS of TASK if an active Task exits, else False
 */

function openvas_action_chain_task_active_for_ip($ip) {
    $targets = openvas_get_targets_for_ip($ip);
    foreach ($targets as $target) {
        $tasks = openvas_get_tasks_for_target($target);
        foreach ($tasks as $task) {
            $p = openvas_task_active($task);
            if ($p) {
                return $p;
            }
        }
    }
    return FALSE;
}


/*
 * Returns the latest ReportID for an IP-Addresses TASK
 * @param $ip IP-Address
 * @param $timestamp this variable will be filled with the timestamp opf the latest report, the variable should be true when it is passed to this function
 * @return ReportID, else False
 */
function openvas_actionchain_getlatestreport_for_ip($ip, &$timestamp=null){
    $targets = openvas_get_targets_for_ip($ip);
    foreach ($targets as $target) {
        $tasks = openvas_get_tasks_for_target($target);
        foreach ($tasks as $task) {
            $r = openvas_get_latestreportid_for_task($task);
            if ($r) {
                if($timestamp){
                    $timestamp=openvas_getlatestreport_timestamp($task);
                }
                return $r;
            }
        }
    }
    return FALSE;
}

/*
 * Returns the latest ReportID for an IP-Addresses TASK
 * @param $reportid The ID of the Report which has to be returned
 * @return Report data as an array['data', 'mimetype', 'extension'], else empty
 */
function openvas_actionchain_getreport_pdf($reportid){

    $r = array();
    
    global $omp_pdf_report_id;
    
    if (!empty($reportid)){
        $reportresponse=simplexml_load_string(send_Commands(cmd_getReports($reportid, $omp_pdf_report_id)));
        $data = $reportresponse->get_reports_response->report;
        $filetype = $reportresponse->get_reports_response->report['content_type'];
        $fileext = $reportresponse->get_reports_response->report['extension'];

        $r['data'] = "$data";
        $r['mimetype'] = "$filetype";
        $r['extension'] = "$fileext";
    }
    return $r;
}
/*
 * Returns the latest ReportID for an IP-Addresses TASK
 * @param $reportid The ID of the Report which has to be returned
 * @return Report data as an array['data', 'mimetype', 'extension'], else empty
 */
function openvas_actionchain_getreport_csv($reportid){

    $r = array();
    
    global $omp_csv_report_id;
    
    if (!empty($reportid)){
        $reportresponse=simplexml_load_string(send_Commands(cmd_getReports($reportid, $omp_csv_report_id)));

        $data = $reportresponse->get_reports_response->report;
        $filetype = $reportresponse->get_reports_response->report['content_type'];
        $fileext = $reportresponse->get_reports_response->report['extension'];

        $r['data'] = "$data";
        $r['mimetype'] = "$filetype";
        $r['extension'] = "$fileext";
    }
    return $r;
}


/*
 * Returns the ID of the latest REPORT of a TASK
 * This is the ID of the last report that was _finished_
 * @param $taskid the ID of a TASK
 * @return the ID of the latest report of a TASK or null on error or report exists
 */
function openvas_get_latestreportid_for_task($taskid){
    $report = null;
    if(!empty($taskid)){
        $taskresponse=simplexml_load_string(send_Commands(cmd_getTasks($taskid)));
        $report = $taskresponse->get_tasks_response->task->last_report->report["id"];
    }
    return $report;
}

/*
 * Returns the timestamp of the latest REPORT of a TASK
 * This is the timestamp of the last report that was _finished_
 * @param $taskid the ID of a TASK
 * @return the timestamp of the latest report of a TASK or null on error or report exists
 */
function openvas_getlatestreport_timestamp($taskid) {
    $timestamp = null;
    if(!empty($taskid)){
        $taskresponse=simplexml_load_string(send_Commands(cmd_getTasks($taskid)));
        $timestamp = $taskresponse->get_tasks_response->task->last_report->report->timestamp;
    }
    return $timestamp;
}


/*
 * Checks if a Task is active
 * @param $taskid the ID of the task
 * @return false if not active or the percentage of completeness
 */
function openvas_task_status($taskid){
    $taskresponse = simplexml_load_string(send_Commands(cmd_getTasks($taskid)));
    
    $status = $taskresponse->get_tasks_response->task->status;
    return $status;
}
function openvas_task_active($taskid,$flag=false) {

    $taskresponse = simplexml_load_string(send_Commands(cmd_getTasks($taskid)));
    
    $status = $taskresponse->get_tasks_response->task->status;
    if (in_array($status, taskstatuses())) {
        $progress = $taskresponse->get_tasks_response->task->progress;
        return "$progress";
    } else {
        return FALSE;
    }
}

/*
 * Checks if a Task exists for a Target
 * @param $targetID the ID of a Target
 * @return an array of IDs of the tasks or null
 */

function openvas_get_tasks_for_target($targetid) {

    $r = array();

    $targetresponse = simplexml_load_string(send_Commands(cmd_getTargets(true, $targetid)));
    $tasks = $targetresponse->get_targets_response->target->tasks;
    foreach ($tasks->children() as $task) {
        $taskid = $task['id'];
        array_push($r, "$taskid");
    }
    return $r;
}

/*
 * Checks if a Target exists for an IP
 * @param $targetID the ID of a Target
 * @return an array of IDs with Targets which are associated to the IP, or empty array
 */

function openvas_get_targets_for_ip($ip) {
    //Get all TARGETS
    $targets = send_Commands(cmd_getTargets(false));
    $response = simplexml_load_string($targets);
    $r = array();

    //Evaluate if the IP is already Target.
    foreach ($response->get_targets_response->target as $target) {
        // The HOSTS field my contain many addresses, 
        // ATTENTION this does not check if an IP address is a member of a Network,
        // e.g. 192.168.0.1 is not found when 192.168.0.0/24 is stored in the HOSTS field
        // @todo
        $hosts = explode(',', $target->hosts);
        $targetid = $target['id'];
        foreach ($hosts as $host) {
            if ($ip == trim($host)) {
                array_push($r, "$targetid");
            }
        }
    }
    return $r;
}
?>