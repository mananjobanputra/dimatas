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
 * Config
 */

include_once 'openvas_plugin_omp50_commands.php';

include_once 'openvas_plugin_helper.php';

include_once 'openvas_plugin_communicator.php';


$omp_host       ='54.173.133.74';
$omp_port       ='9390';

$omp_new_task_default_comment = "Task generated by http://dimatas.com/";
$omp_new_target_default_comment = "Target generated by http://dimatas.com/";

/*
 *  To be Configured in GreenboneSecurityAssistant
 */

$omp_username   = 'admin';
$omp_password   = '3cd36d3a-1c39-40f3-92af-a1260c770bb9';

// The ID of the scanconfig which has to be used
$omp_scanconfig ='daba56c8-73ec-11df-a475-002264764cea';
//The ID of the alert which has to receive an e-Mail when a task has finished
$omp_alertid = 'ae6715fa-c2f0-4bb1-b788-b22af0d251e4';
//The ID of the Portlist which should be used when a new Target is created
$omp_portlistid = 'c7e03b6c-3bbe-11e1-a057-406186ea4fc5';
$omp_alivetest = 'Scan Config Default';

//The ID of the PDF Format for Reports
$omp_pdf_report_id = 'c402cc3e-b531-11e1-9163-406186ea4fc5';
$omp_csv_report_id = '9087b18c-626c-11e3-8892-406186ea4fc5';

?>