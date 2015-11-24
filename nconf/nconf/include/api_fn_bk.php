<?php 
function add_host_nconf($config_class='host',$extra_para_array=array(),$post_array=array())
{
	
	extract($extra_para_array);
	extract($post_array);
	$check_entry_exists=check_entry_existence($config_class,$extra_para_array,$post_array);
//	print_r($check_entry_exists);
	if($check_entry_exists['result']=='success')
	{
	//	print_r($post_array);
		$m_array = db_templates("mandatory", $config_class);
    	$write2db = check_mandatory($m_array,$post_array);
		# check oncall groups when class is host or service
		/*if ($config_class == "host" OR $config_class == "service"){
			#if failed do not allow write2db
			print 'z';
			if ( oncall_check() == FALSE ){
				$write2db = 'no';
			}
		}*/
	//	print $write2db;
		if ($write2db == "yes"){
		//	print 'g';
			return insert_host_process($config_class,$extra_para_array,$post_array);
		}

	}
	else
	{
		return $check_entry_exists;
	}
	
}
function check_entry_existence($config_class,$extra_para_array,$post_array)
{
	extract($extra_para_array);
	extract($post_array);
	$final_array=array();
	/*$id_naming_attr,*/
	
	$query = 'SELECT id_attr
            FROM ConfigAttrs,ConfigClasses
            WHERE naming_attr="yes"
                AND id_class=fk_id_class
                AND config_class="'.$config_class.'"
         ';
	$id_naming_attr = db_handler($query, "getOne", "get naming_attr ID");
	
	$query = 'SELECT attr_value, fk_id_item
				FROM ConfigValues
				WHERE fk_id_attr='.$id_naming_attr.'
				AND attr_value = "'.escape_string($post_array[$id_naming_attr]).'"
			';
	$result = db_handler($query, "result", "Check if entry already exists");        
	
	# Entry exists ?
	if ( (mysql_num_rows($result)) AND ($config_class != "service") ){
		$errors=array();
		$row_res=mysql_fetch_assoc($result);
		$data=array('id'=>$row_res['fk_id_item']);
		$errors[]='Entry with name &quot;'.$post_array[$id_naming_attr].'&quot; already exists! Click for details or go back:';
		$final_array['result']='failed';
		$final_array['msg']=$errors;
		$final_array['short_reason']='EXISTS';
		$final_array['data']=$data;
	}
	else
	{
		$data=array();
		$final_array['result']='success';
		$final_array['msg']='';
		$final_array['short_reason']='';
		$final_array['data']=$data;
	}
	return $final_array;
}
function insert_host_process($config_class,$extra_para_array,$post_array)
{
	extract($extra_para_array);
	extract($post_array);
	$errors=array();
	$final_array=array();
        ################
        #### write to db
        ################
//print 'abc';
        $query = 'INSERT INTO ConfigItems
                    (id_item, fk_id_class)
                    VALUES
                    (NULL, (SELECT id_class FROM ConfigClasses WHERE config_class = "'.$config_class.'") )
                    ';

     //   message ($debug, $query);

        if (DB_NO_WRITES != 1) {
      //  	print 'e';
            $insert = mysql_query($query);
        }else{
      //  	print 'd';
            $insert = TRUE;
        }

        if ( $insert ){
            # Get ID of insert:
            $id = mysql_insert_id();

            # add object CREATED to history
            history_add("created", $config_class, $post_array[$id_naming_attr], $id);            
            
            while ( $attr = each($post_array) ){
                if ( is_int($attr["key"]) ){
                    if ( is_array($attr["value"]) ){
                        # add assigns to history
                        foreach ($attr["value"] as $attr_added){
                            history_add("assigned", $attr["key"], $attr_added, $id, "resolve_assignment");
                        }
                        # Reset array pointer !!!
                        reset($attr["value"]);

                        # counter for assign_cust_order
                        $cust_order = 0.0;
                        $attr_datatype = db_templates("attr_datatype", $attr["key"]);
                        # save assign_one/assign_many/assign_cust_order in ItemLinks
                        while ( $many_attr = each($attr["value"]) ){
                            # if value is empty go to next one
                            if (!$many_attr["value"]){
                                continue;
                            }else{
                                # check link_as_child option
                                $lac_query = mysql_query('SELECT link_as_child
                                                FROM ConfigAttrs
                                                WHERE id_attr = "'.$attr["key"].'"
                                ');

                                $result = mysql_query($lac_query);
                                if ( mysql_result($lac_query, 0) == "yes"){
                                    $query = 'INSERT INTO ItemLinks
                                        (fk_id_item, fk_item_linked2, fk_id_attr, cust_order)
                                        VALUES
                                        ('.$many_attr["value"].', '.$id.', '.$attr["key"].', '.$cust_order.')
                                        ';
                                }else{
                                    $query = 'INSERT INTO ItemLinks
                                        (fk_id_item, fk_item_linked2, fk_id_attr, cust_order)
                                        VALUES
                                        ('.$id.', '.$many_attr["value"].', '.$attr["key"].', '.$cust_order.')
                                        ';
                                }    
                               // message ($debug, $query, "query");

                                if (DB_NO_WRITES != 1) {
                                    if ( mysql_query($query) ){
                                       // message ($debug, '', "ok");
                                        //message ($debug, 'Successfully linked "'.$many_attr["value"].'" with '.$attr["key"]);
                                    }else{
										$errors[]='Error when linking '.$many_attr["value"].' with '.$attr["key"].':'.$query;
                                    }
                                }

                                # increase assign_cust_order if needed
                                if ($attr_datatype == "assign_cust_order") $cust_order++;

                            }
                        }
                    }else{

                        # Lookup datatype
                        # Password field is a encrypted, do not save
                        $query =    'SELECT datatype FROM ConfigAttrs WHERE id_attr = '.$attr["key"];
                        $datatype = db_handler($query, "getOne", "Lookup datatype");
                        if ($datatype == "password"){
                            $insert_attr_value = encrypt_password($attr["value"]);
                        }else{
                            # normal text/select
                            $insert_attr_value = escape_string($attr["value"]);
                        }

                        $query = 'INSERT INTO ConfigValues
                            (attr_value, fk_id_attr, fk_id_item)
                            VALUES
                            ("'.$insert_attr_value.'", "'.$attr["key"].'", '.$id.' )
                            ';
                       // message ($debug, $query, "query");

                        if (DB_NO_WRITES != 1) {
                            if ( mysql_query($query) ){
                              //  message ($debug, 'Added '.$insert_attr_value, "ok");
                                # add value ADDED to history
                                history_add("added", $attr["key"], $insert_attr_value, $id, "get_attr_name");
                            }else{
								$errors[]='Error when adding '.$attr["value"];

                            }
                        }
                    }
                }else{
                    continue;
                }
            }
            if (DB_NO_WRITES != 1) {
                $info= '<b>Adding '.$config_class.' was successful</b>';
				
            }else{
                $info='<b>Adding '.$config_class.' should work fine...</b>';
            }
            
      

        }else{
            # insert not ok
            
			$errors[]='Error in adding entry to ConfigItems:'.$query." - ". mysql_error();
        }
      //  print_r($errors);
		if(empty($errors))
			{
				$data=array();
				$data['id']=$id;
				$final_array['results']='success';
				$final_array['msg']=$info;
				$final_array['data']=$data;
				$final_array['short_reason']='';
			}
			else
			{
				$data=array();
				$final_array['results']='failed';
				$final_array['msg']=$errors;
				$final_array['data']=$data;
				$final_array['short_reason']='';
			}
		//	print_r($final_array);
return $final_array;
    
}
function add_service_process($host_ID,$post_array)
{
	extract($post_array);
	$errors=array();
	$final_array=array();
	$data=array();
	if ( isset($_POST["add_service"]) ){
    	unset($post_array["checkcommands"]);
   		$post_array["checkcommands"][$post_array["add_checkcommand"]] = $post_array["HIDDEN_checkcommands"][$post_array["add_checkcommand"]];
	}
	
	
	if (  ( isset($post_array["checkcommands"]) ) AND ( is_array($post_array["checkcommands"]) )  ){
	
		# each checkcommand
		while ( $checkcommand = each($post_array["checkcommands"]) ){
	
			// Generate new item_id for service
			$query = 'INSERT INTO ConfigItems (fk_id_class) 
						VALUES ((SELECT id_class
									FROM ConfigClasses
									WHERE config_class="service"))
					 ';
	
			$insert = db_handler($query, "insert", "Generate new item_id for service");
			if ( $insert ){
	
				// Get generated ID
				$new_service_ID = mysql_insert_id();
	
				// Link new service with host        
				$query = 'INSERT INTO ItemLinks (fk_id_item,fk_item_linked2,fk_id_attr) 
							VALUES ('.$new_service_ID.','.$host_ID.',
								(SELECT id_attr FROM ConfigAttrs,ConfigClasses 
								WHERE id_class=fk_id_class 
								AND config_class="service" 
								AND attr_name="host_name"))
						 ';
				db_handler($query, "insert", "Link new service with host");
	
	
				#
				# additional name handling for existing service names
				#
	
				# get all service names of destination server
				$existing_service_names = db_templates("get_services_from_host_id", $host_ID);
	
				if ( in_array($checkcommand["value"], $existing_service_names) ){
					$new_service_name = $checkcommand["value"].'_';
					$i = 1;
					do{
						$i++;
						$try_service_name = $new_service_name.$i;
					}while( in_array($try_service_name, $existing_service_names) );
					# found a services name, which does not exist
					$new_service_name = $try_service_name;
					// move value back
					$checkcommand["value"] = $new_service_name;
				}
	
				// Set name of service
				$query = 'INSERT INTO ConfigValues (attr_value,fk_id_item,fk_id_attr) 
						   VALUES ("'.$checkcommand["value"].'",'.$new_service_ID.',
							(SELECT id_attr FROM ConfigAttrs,ConfigClasses 
								WHERE id_class=fk_id_class 
								AND config_class="service" 
								AND naming_attr="yes"))
						 ';
				db_handler($query, "insert", "Set name of service");
				history_add("added", "service", $checkcommand["value"], $host_ID);
	
				// Link service with checkcommand
				$query = 'INSERT INTO ItemLinks (fk_id_item,fk_item_linked2,fk_id_attr) 
							VALUES ('.$new_service_ID.','.$checkcommand["key"].',
								(SELECT id_attr FROM ConfigAttrs,ConfigClasses 
								WHERE id_class=fk_id_class 
								AND config_class="service" 
								AND attr_name="check_command"))
						 ';
				db_handler($query, "insert", "Link service with checkcommand");
	
				// Read default checkcommand params
				$query = 'SELECT attr_value FROM ConfigValues,ConfigAttrs,ConfigClasses
									  WHERE id_attr=fk_id_attr
									  AND attr_name="default_params"
									  AND id_class=fk_id_class
									  AND config_class="checkcommand"
									  AND fk_id_item='.$checkcommand["key"];
	
				$default_params = db_handler($query, "getOne", "Read default checkcommand params");
	
				if($default_params == ""){
					$default_params="!";
				}else{
					# escape the string for mysql (field contains: " ' \ etc. )
					$default_params = escape_string($default_params);
				}
	
				// Set default checkcommand params
				$query = 'INSERT INTO ConfigValues (fk_id_item,attr_value,fk_id_attr)
						   VALUES('.$new_service_ID.',"'.$default_params.'",
								(SELECT id_attr FROM ConfigAttrs,ConfigClasses                             
									  WHERE id_class=fk_id_class                             
									  AND config_class="service"                             
									  AND attr_name="check_params"))
						 ';
	
				db_handler($query, "insert", "set default checkcommand params");
	
	
				$query = 'SELECT fk_item_linked2 AS item_id,attr_name
							FROM ItemLinks,ConfigAttrs,ConfigClasses
							WHERE id_attr=fk_id_attr
								AND id_class=fk_id_class
								AND fk_id_item="'.$host_ID.'"
								HAVING (SELECT config_class FROM ConfigItems,ConfigClasses 
										WHERE id_class=fk_id_class 
											AND id_item=item_id) = "timeperiod"';
	
				$result = db_handler($query, "result", "select timeperiods");
				if ($result){
					$data[]= '[ OK ] --> selected: '.mysql_num_rows($result) ;
					//message ($debug, '[ OK ] --> selected: '.mysql_num_rows($result) );
					if ( mysql_num_rows($result) > 0 ){
	#                   $timeperiod_ID = mysql_result($result, 0);
						while ($timeperiod = mysql_fetch_assoc($result)){
	
							$query = 'INSERT INTO ItemLinks (fk_id_item,fk_item_linked2,fk_id_attr) 
										VALUES ('.$new_service_ID.','.$timeperiod["item_id"].',
											(SELECT id_attr FROM ConfigAttrs,ConfigClasses 
											WHERE id_class=fk_id_class 
											AND config_class="service"
											AND attr_name="'.$timeperiod["attr_name"].'"))';
	
							db_handler($query, "insert", "insert timeperiod");
						}
					}
	
	
				}else{
					$errors[]='[ FAILED ]';
					//message ($debug, '[ FAILED ]');
				}    
	
	
				// Link service with same contactgroups as host
				$query = 'SELECT fk_item_linked2
							FROM ItemLinks,ConfigAttrs 
							WHERE id_attr=fk_id_attr
							AND attr_name="contact_groups"
							AND fk_id_item="'.$host_ID.'"
						 ';
	
				$result = db_handler($query, "result", "Link service with same contactgroups as host (select)");
				if ($result){
					$data[]= '[ OK ] --> selected: '.mysql_num_rows($result) ;
					//message ($debug, '[ OK ] --> selected: '.mysql_num_rows($result) );
					if ( mysql_num_rows($result) > 0 ){
						while ($contactgroup_ID = mysql_fetch_row($result)){
							$query = 'INSERT INTO ItemLinks (fk_id_item,fk_item_linked2,fk_id_attr) 
										VALUES ('.$new_service_ID.','.$contactgroup_ID[0].',
											(SELECT id_attr FROM ConfigAttrs,ConfigClasses 
											WHERE id_class=fk_id_class 
											AND config_class="service"
											AND attr_name="contact_groups"))
				 
									 ';
	
							db_handler($query, "insert", "Link service with same contactgroups as host (insert)");
						} // END while
					}
	
	
				}else{
					$errors[]='[ FAILED ]';
					//message ($debug, '[ FAILED ]');
				}    
			
	
			}// END if ( $insert ){
	
		}// END while
	
	} // END is_array($_POST["checkcommands"])
	if(empty($errors))
			{
				$data=array();
				$data['id']=$id;
				$final_array['results']='success';
				$final_array['msg']=$info;
				$final_array['data']=$data;
				$final_array['short_reason']='';
			}
			else
			{
				$data=array();
				$final_array['results']='failed';
				$final_array['msg']=$errors;
				$final_array['data']=$data;
				$final_array['short_reason']='';
			}
			return $final_array;
}
function generate_config()
{
	
//    require_once 'include/head.php';
    $status = "OK";
	$final_array=array();
	$data=array();
	$errors=array();
    // check if "temp" dir is writable
    if(!is_writable(NCONFDIR."/temp/")){
		$errors[]="Could not write to 'temp' folder. Cannot generate config.";
        //$status = "error";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		return $final_array; 
        exit;
    }

    // check if "output" dir is writable
    if(!is_writable(NCONFDIR."/output/")){
		$errors[]="Could not write to 'output' folder. Cannot store generated config.";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		return $final_array;
        exit;
    }

    // check if generate_config script is executable
    if(!is_executable(NCONFDIR."/bin/generate_config.pl")){
		$errors[]="Could not execute generate_config script. <br>The file '".NCONFDIR."/bin/generate_config.pl' is not executable.";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		return $final_array;
        exit;
    }

    // check if the Nagios / Icinga binary is executable
    exec(NAGIOS_BIN,$bin_out);
    if(!preg_match('/Nagios|Icinga/',implode(' ',$bin_out))){
		
		$errors[]="Error accessing or executing Nagios / Icinga binary '".NAGIOS_BIN."'. <br>Cannot run the mandatory syntax check.";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		return $final_array;
        exit;
	}

    // check if existing "output/NagiosConfig.tgz" is writable
    if(file_exists(NCONFDIR."/output/NagiosConfig.tgz" and !is_writable(NCONFDIR."/output/NagiosConfig.tgz"))){
			
		$errors[]="Cannot rename ".NCONFDIR."/output/NagiosConfig.tgz. Access denied.";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		return $final_array;
        exit;
    }

    // check if static config folder(s) are readable
    foreach ($STATIC_CONFIG as $static_folder){
        if(!is_readable($static_folder)){
		$errors[]="Cannot rename ".NCONFDIR."/output/NagiosConfig.tgz. Access denied.";
		$errors[]="Check your \$STATIC_CONFIG array in 'config/nconf.php'.";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		return $final_array;
        exit;
        }
    }

    // fetch all monitor and collector servers from DB
    $servers = array();
    $query = "SELECT fk_id_item AS item_id,attr_value,config_class
                  FROM ConfigValues,ConfigAttrs,ConfigClasses
                  WHERE id_attr=fk_id_attr
                      AND naming_attr='yes'
                      AND id_class=fk_id_class
                      AND (config_class = 'nagios-collector' OR config_class = 'nagios-monitor') 
                  ORDER BY attr_value";

    $result = db_handler($query, "result", "fetch all monitor and collector servers from DB");

    while ($entry = mysql_fetch_assoc($result) ){
        $renamed = preg_replace('/-|\s/','_',$entry["attr_value"]);

        if($entry["config_class"] == 'nagios-collector'){
            $renamed = preg_replace('/Nagios|Icinga/i','collector',$renamed);
        }
        array_push($servers, $renamed);
    }

    // Log to history
  	 history_add("general", "config", "generated");
  	 echo "<span style='display:none;'>";
		system(NCONFDIR."/bin/generate_config.pl");
 echo "</span>";
        
	   // create tar file
	   system("cd ".NCONFDIR."/temp; tar -cf NagiosConfig.tar global ".implode(" ", $servers));

	   // add folders with static config to tar file           
	   foreach ($STATIC_CONFIG as $static_folder){
		   if(!is_empty_folder($static_folder) and is_empty_folder($static_folder) != "error"){
			   $last_folder = basename($static_folder);
			   system("cd ".$static_folder."; cd ../; tar -rf ".NCONFDIR."/temp/NagiosConfig.tar ".$last_folder);
		   }
	   }
	   
	   // compress tar file
	   system("cd ".NCONFDIR."/temp; gzip NagiosConfig.tar; mv NagiosConfig.tar.gz NagiosConfig.tgz");

		$final_text=array();
		$i=0;
	   // now run tests on all generated files
	   foreach ($servers as $server){
	   
		   exec(NAGIOS_BIN." -v ".NCONFDIR."/temp/test/".$server.".cfg",$srv_summary[$server]);

		   $server_str = preg_replace("/\./", "_", $server);
		   $final_text[$i]['server']=$server;
		   $lines=array();
		   $count=0;
		   foreach($srv_summary[$server] as $line){
				if(ereg("Total",$line)){
					$lines[]=$line;
					$count++;
					if(ereg("Errors",$line) && !preg_match('/Total Errors:\s+0/',$line)){
						$errors[]="";
						$status = "error";
						
					}
				}
			}
			if($count==0){
				$errors[]="Error generating config";
				$status = "error";
			}

			
		   $final_text[$i]['log_detail']=$lines;
		   $i++;
		   
	   }
		

         

    if($status == "OK"){

        // Move generated config to "output" dir
        if(file_exists(NCONFDIR."/output/NagiosConfig.tgz")){
            system("mv ".NCONFDIR."/output/NagiosConfig.tgz ".NCONFDIR."/output/NagiosConfig.tgz.".time());
        }
        system("mv ".NCONFDIR."/temp/NagiosConfig.tgz ".NCONFDIR."/output/");
        system("rm -rf ".NCONFDIR."/temp/*");
	 shell_exec('sh /var/www/nconf/ADD-ONS/deploy_local.sh');		
		$final_array['results']='success';
		$final_array['msg']=$errors;
		$final_array['data']=$final_text;
		$final_array['short_reason']='';
		mysql_close($dbh);
		return $final_array;	
    }else{
        // Remove generated config - syntax check has failed
        system("rm -rf ".NCONFDIR."/temp/*");
		$errors[]="Deployment not possible due to errors in configuration.";
		$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
		mysql_close($dbh);
		return $final_array;	
        
    }

    mysql_close($dbh);
	
  
}
function get_all_services($config_class="host",$id)
{
	$final_array=array();
	$data=array();
	$errors=array();
	if ( $config_class == "host" ){        
        # Show step 2 :
        $query = 'SELECT fk_item_linked2 
                    FROM ItemLinks,ConfigAttrs,ConfigClasses
                    WHERE id_attr=fk_id_attr 
                    AND attr_name="host-preset"
                    AND id_class=fk_id_class 
                    AND config_class="host"
                    AND fk_id_item="'.$id.'"
                    ';
        $result = mysql_query($query);
        message ($debug, "host-preset : ".$query);
        if ( $result ){
            if ( mysql_num_rows($result) > 0 ){
                $hosttemplate = mysql_result($result, 0);
            }
            $step2 = "yes";
        }else{
            //message($error, mysql_error() );
            $error[]=mysql_error();
        }
	

    } // END $config_class == "host"
    if ( isset($hosttemplate) ){
        // Get all checked commands
        $query = 'SELECT ItemLinks.fk_id_item,attr_value
            FROM ConfigValues,ConfigAttrs,ItemLinks,ConfigClasses 
            WHERE ItemLinks.fk_id_item=ConfigValues.fk_id_item 
            AND id_attr=ConfigValues.fk_id_attr 
            AND naming_attr="yes"
            AND id_class=fk_id_class 
            AND config_class="checkcommand"
            AND fk_item_linked2='.$hosttemplate;

        $result = mysql_query($query);
        while ($entry = mysql_fetch_assoc($result) ){
            $checkcommands_checked[] = $entry["fk_id_item"];
        }
   
    }else{
        $checkcommands_checked = array();
    }  // END isset(hosttemplate)
	$query = 'SELECT fk_id_item,attr_value 
        FROM ConfigValues,ConfigAttrs,ConfigClasses 
        WHERE id_attr=fk_id_attr 
        AND id_class=fk_id_class 
        AND config_class="checkcommand"
        AND naming_attr="yes" 
        ORDER BY attr_value';

  

    $counter = 1;
    $result = mysql_query($query);
    $main_services=array();
    while($checkcommands = mysql_fetch_assoc($result)){
       // echo '<td valign=left>';
      //  echo '<input style="border:none !important; width:12px" type="checkbox" name="checkcommands['.$checkcommands["fk_id_item"].']" value="'.$checkcommands["attr_value"].'"';
      //  if ( in_array($checkcommands["fk_id_item"], $checkcommands_checked) ) echo ' CHECKED';
     //   echo '>&nbsp;&nbsp;'.$checkcommands["attr_value"];
      //  echo '</td><td width=10></td>';
        $main_services[]=array("id"=>$checkcommands["fk_id_item"],"value"=>$checkcommands["attr_value"]);
        
        
    }
    if(empty($errors))
	{
				$data=array();
				$data['main_services']=$main_services;
        $data['host_services']=$checkcommands_checked;
        $data['host_template']=$hosttemplate;
        $data['host_id']=$id;
        $data['config_class']=$config_class;
				$final_array['results']='success';
				$final_array['msg']=$info;
				$final_array['data']=$data;
				$final_array['short_reason']='';
	}
	else
	{	
    	$final_array['results']='failed';
		$final_array['msg']=$errors;
		$final_array['data']=$data;
		$final_array['short_reason']='';
    }
    return $final_array;
}
?>
