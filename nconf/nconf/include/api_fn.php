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
		$errors[]='This host name &quot;'.$post_array[$id_naming_attr].'&quot; is already exists! Please use different host name.';
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
function edit_host($config_class='host',$extra_para_array=array(),$post_array=array())
{
	$errors=array();
	$final_array=array();
	 $id = $post_array["HIDDEN_modify_id"]; 
 	 if(  ( isset($post_array["exploded"]) ) AND ( is_array($post_array["exploded"]) )  ){
        foreach ($post_array["exploded"] as $field_key => $value_array) {
            # string starts with a "!"
            $imploded = "!";
            # implode the other arguments
            $imploded .= implode("!", $value_array);
            # Save it to the POST-var, so the var will be added later in this script
            $post_array[$field_key] = $imploded;
        }
    	}
    
    $query_old_linked_data = 'SELECT id_attr,attr_value,fk_item_linked2
                    FROM ConfigValues,ItemLinks,ConfigAttrs
                    WHERE fk_item_linked2=ConfigValues.fk_id_item
                    AND id_attr=ItemLinks.fk_id_attr
                    AND (SELECT naming_attr FROM ConfigAttrs WHERE id_attr=ConfigValues.fk_id_attr)="yes"
                    AND ItemLinks.fk_id_item='.$id.'
                    ORDER BY
                    ConfigAttrs.friendly_name DESC,
                    ItemLinks.cust_order
                    ';

    $result_old_linked_data = db_handler($query_old_linked_data, "result", "get linked entries");

    $old_linked_data = array();
    while($entry2 = mysql_fetch_assoc($result_old_linked_data)){
        $old_linked_data[$entry2["id_attr"]][] = $entry2["fk_item_linked2"];
    }

    # get entries linked as child (ItemLinks) for passed id   (without the childs saved in the parents!)
    $query_old_linked_child_data = 'SELECT id_attr,attr_value,ItemLinks.fk_id_item
                FROM ConfigValues,ItemLinks,ConfigAttrs
                WHERE ItemLinks.fk_id_item=ConfigValues.fk_id_item
                AND id_attr=ItemLinks.fk_id_attr
                AND ConfigAttrs.visible="yes"
                AND (SELECT naming_attr FROM ConfigAttrs WHERE id_attr=ConfigValues.fk_id_attr)="yes"
                AND ItemLinks.fk_item_linked2='.$id.'
                AND ConfigAttrs.attr_name <> "parents"
                ORDER BY ConfigAttrs.friendly_name DESC';

    $result_old_linked_child_data = db_handler($query_old_linked_child_data, "result", "get linked as child entries");
    while($entry3 = mysql_fetch_assoc($result_old_linked_child_data)){
        $old_linked_data[$entry3["id_attr"]][] = $entry3["fk_id_item"];
    }

    # Get old variables finished
    ########
	 # Check for existing entry
    $query = 'SELECT id_attr
                FROM ConfigAttrs,ConfigClasses
                WHERE naming_attr="yes"
                    AND id_class=fk_id_class
                    AND config_class="'.$config_class.'"
             ';

    $id_naming_attr = db_handler($query, "getOne", "naming_attr ID:");

    $query = 'SELECT attr_value, fk_id_item
                FROM ConfigValues
                WHERE fk_id_attr='.$id_naming_attr.'
                AND attr_value = "'.escape_string($post_array[$id_naming_attr]).'"
                AND fk_id_item <>'.$id.'
            ';
    $result = db_handler($query, "result", "does entry already exist");
	# Entry exists ?
    if ( (mysql_num_rows($result)) AND ($config_class != "service") ){
		$errors=array();
		$row_res=mysql_fetch_assoc($result);    	
    	$data=array('id'=>$row_res['fk_id_item']);
		$errors[]='Entry with name &quot;'.$post_array[$id_naming_attr].'&quot; already exists!';
		$final_array['result']='failed';
		$final_array['msg']=$errors;
		$final_array['short_reason']='EXISTS';
		$final_array['data']=$data;
        /*echo 'Entry with name &quot;'.$post_array[$id_naming_attr].'&quot; already exists!';
        echo '<br><br>Click for details: ';
        while($entry = mysql_fetch_assoc($result)){
            echo '<a href="detail.php?id='.$entry["fk_id_item"].'">'.$entry["attr_value"].'</a>';
        }
        echo '<br><br>or go <a href="javascript:history.go(-1)">back</a>';*/
   } else {
        #entry not existing, lets try to modify:

        /*if ($config_class == "host") {
            # Vererben ?
            $vererben1_result = db_templates("vererben", $id);
            while($row = mysql_fetch_assoc($vererben1_result)){
                $vererben1[$row["item_id"]] = $row["attr_name"];
            }
        }*/


        # Check mandatory fields
        $m_array = db_templates("mandatory", $config_class);
        $write2db = check_mandatory($m_array,$post_array);


        # check oncall groups when class is host or service
       /*if ($config_class == "host" OR $config_class == "service") {
            # if failed do not allow write2db
            if ( oncall_check() == FALSE ){
                $write2db = 'no';
            }
        }*/



        if ($write2db == "yes"){
            ################
            #### write to db
            ################

            while ( $attr = each($post_array) ){
                if ( is_int($attr["key"]) ){
                    // Get name of attribute:
                    $attr_name = db_templates("friendly_attr_name", $attr["key"]);
                    if ( $attr_name ){
                       // message ($debug, $attr_name, 'grouptitle' );
                    }

                    if ( is_array($attr["value"]) ){
                        # modify assign_one/assign_many/assign_cust_order in ItemLinks
                        # get datatype for handling assign_cust_order
                        $attr_datatype = db_templates("attr_datatype", $attr["key"]);

                        # Check if the values are modifyied, only save changed values
                        if ( !isset($old_linked_data[$attr["key"]]) ){
                            $old_linked_data[$attr["key"]] = array("0" => "");
                        }

                        /*
                        echo "<br><br>saved array:";
                        var_dump($old_linked_data[$attr["key"]]);
                        echo '<br><b>new array '.$attr["key"].':</b>';
                        var_dump($attr["value"]);
                        */

                        # Assigned items
                        if ($attr_datatype == "assign_cust_order"){
                            # compare arrays with additional index check
                            $diff_array = array_diff_assoc($attr["value"] ,$old_linked_data[$attr["key"]]);
                        }else{
                            # normal compare of arrays
                            $diff_array = array_diff($attr["value"] ,$old_linked_data[$attr["key"]]);
                        }
                        if ( !empty($diff_array) ){
                            while ( $attr_added = each($diff_array) ){
                                history_add("assigned", $attr_name, $attr_added["value"], $id, "resolve_assignment");
                            }
                        }

                        # Unassigned items
                        if ($attr_datatype == "assign_cust_order"){
                            # compare arrays with additional index check
                            $diff_array2 = array_diff_assoc($old_linked_data[$attr["key"]], $attr["value"]);
                        }else{
                            # normal compare of arrays
                            $diff_array2 = array_diff($old_linked_data[$attr["key"]], $attr["value"]);
                        }
                        if ( !empty($diff_array2) ){
                            while ( $attr_removed = each($diff_array2) ){
                                history_add("unassigned", $attr_name, $attr_removed["value"], $id, "resolve_assignment");
                            }
                        }

                        /*
                        echo "<pre>";
                        var_dump($diff_array);
                        var_dump($diff_array2);
                        echo "</pre>";
                        */

                        if ( (count($diff_array) OR count($diff_array2) ) != 0 ){
                           // message ($info, "Attribute '$attr_name' has changed.");
                        }else{
									//message ($debug, 'no changes in this attribute');
                            ########## CONTINUE IF ATTRIBUTE WAS NOT CHANGED   ############
                            continue;
                        }



                        ###########################
                        ### Delete old links

                        $lac_query = 'SELECT link_as_child
                                        FROM ConfigAttrs
                                        WHERE id_attr = "'.$attr["key"].'"
                                        ';
                        $lac_result = db_handler($lac_query, "getOne", "delete: link as child?");



                        // is actual id the "servicegroup"?
                        // Attention, very special hack!
                        $servicegroup_select = 0;
                        $servicegroup_id = db_templates("servicegroup_id");
                        if ( $servicegroup_id == $attr["key"] ){
                            $servicegroup_select = 1;
                           // message($debug, "delete: servicegroup matched");
                        }
                        
                        //Querys
                        $delete_query_lac = 'DELETE FROM ItemLinks
                                    WHERE fk_id_attr="'.$attr["key"].'"
                                    AND fk_item_linked2="'.$id.'"
                                    ';

                        $delete_query = 'DELETE FROM ItemLinks
                                    WHERE fk_id_attr="'.$attr["key"].'"
                                    AND fk_id_item="'.$id.'"
                                    ';

                        if ( (($lac_result == "yes") AND ($servicegroup_select != 1)) OR (($lac_result == "yes") AND ($servicegroup_select == 1) AND ($config_class == "servicegroup")) ){
                            db_handler($delete_query_lac, "delete", "Delete link as child");
                        }else{
                            db_handler($delete_query, "delete", "Delete (not link as child)");
                        }

                        #########
                        ### Insert new links

                        # counter for assign_cust_order
                        $cust_order = 0;
                        # save assign_one/assign_many/assign_cust_order in ItemLinks
                        while ( $many_attr = each($attr["value"]) ){
                            # if value is empty go to next one
                            if (!$many_attr["value"]){
                                continue;
                            }else{
                                # check link_as_child option
                                $lac_query = 'SELECT link_as_child
                                                FROM ConfigAttrs
                                                WHERE id_attr = "'.$attr["key"].'"
                                                ';
                                $lac_result = db_handler($lac_query, "getOne", "get link as child");

                                $servicegroup_select = 0;
                                $servicegroup_id = db_templates("servicegroup_id");
                                if ( $servicegroup_id == $attr["key"] ){
                                    $servicegroup_select = 1;
												//message($debug, "servicegroup matched");
                                }

                                # if the circumstances are correct, link as child
                                if ( (($lac_result == "yes") AND ($servicegroup_select != 1)) OR (($lac_result == "yes") AND ($servicegroup_select == 1) AND ($config_class == "servicegroup")) ){
                                    $query = 'INSERT INTO ItemLinks
                                    (fk_id_item, fk_item_linked2, fk_id_attr, cust_order)
                                    VALUES
                                    ('.$many_attr["value"].', '.$id.', '.$attr["key"].', '.$cust_order.')';
                                # otherwise link items normally
                                }else{
                                    $query = 'INSERT INTO ItemLinks
                                        (fk_id_item, fk_item_linked2, fk_id_attr, cust_order)
                                        VALUES
                                        ('.$id.', '.$many_attr["value"].', '.$attr["key"].', '.$cust_order.')';
                                }    
                               // message ($debug, $query);

                                if (DB_NO_WRITES != 1) {
                                    if ( mysql_query($query) ){
                                       // message ($debug, 'Successfully linked "'.$many_attr["value"].'" with '.$attr["key"]);
                                    }else{
                                       // message ($error, 'Error while linking '.$many_attr["value"].' with '.$attr["key"].':'.$query);
                                    }
                                }

                            }

                            # increase assign_cust_order if needed
                            if ($attr_datatype == "assign_cust_order") $cust_order++;

                        }

                    }else{
                        # Lookup datatype
                        $query = 'SELECT ConfigValues.attr_value, ConfigAttrs.datatype FROM `ConfigAttrs`, ConfigValues
                                    WHERE ConfigAttrs.id_attr = "'.$attr["key"].'"
                                    AND ConfigValues.fk_id_attr = ConfigAttrs.id_attr
                                    AND ConfigValues.fk_id_item = "'.$id.'"';

                        $check = db_handler($query, "assoc", "Lookup value and datatype");
                        if ($check == FALSE){
                            $check["datatype"] = db_templates("attr_datatype", $attr["key"]);
                        }
                        
                        // Check if the value has changed
                        if ( !isset($check["attr_value"]) OR ($check["attr_value"] != $attr["value"]) ){
                            if ($check["datatype"] == "password"){
                                // IF Password field is a encrypted, do not save
                                if ( preg_match( '/^{.*}/', $attr["value"]) ){
                                   // message ($info, "encrypted field will not be saved");
                                    continue;
                                }elseif ( (PASSWD_DISPLAY == 0) AND  ( strpos($attr["value"], PASSWD_HIDDEN_STRING) !== false) ){
                                    // Passwort was displayed as "hidden" like "********", do not save
                                    //message ($info, "passwd was hidden and not modified");
                                    continue;
                                }else{
                                    $insert_attr_value = encrypt_password($attr["value"]);
                                }
                            }else{
                                // modify text/select
                                $insert_attr_value = escape_string($attr["value"]);
                            }

                            $query =   'INSERT INTO ConfigValues
                                            (attr_value, fk_id_attr, fk_id_item)
                                        VALUES
                                            ("'.$insert_attr_value.'", "'.$attr["key"].'", '.$id.' )
                                        ON DUPLICATE KEY UPDATE
                                            attr_value="'.$insert_attr_value.'"
                                        ';

                            $insert = db_handler($query, "insert", 'Insert entry');
                            if ($insert){
                               // message ($debug, 'Successfully added ('.stripslashes($insert_attr_value).')');
                                history_add("modified", $attr["key"], $insert_attr_value, $id);
                            }else{
                             //   message ($error, 'Error while adding '.stripslashes($insert_attr_value).':'.$query);
                            }
                        }{
                            // The data value has not changed, so no saving is needed
                        }
                    }
                }else{
                    continue;
                }
            }
            if (DB_NO_WRITES != 1) {
            	 $info= '<b>Adding '.$config_class.' was successful</b>';
               // message ($info, '<br><b>Successfully modified '.$config_class.'.</b>');

               /* if ($config_class == "host") {
                    # Vererben ?
                    $vererben2_result = db_templates("vererben", $id);
                    while($row = mysql_fetch_assoc($vererben2_result)){
                        $vererben2[$row["item_id"]] = $row["attr_name"];
                    }
         
                    # Ask for make the changes also to the linked services
                    if ($vererben1 !== $vererben2) {
                        $update_button  = '<form name="vererben" action="'.$_SERVER["PHP_SELF"].'" method="post">';
                        $update_button .= '<input name="HIDDEN_modify_id" type="hidden" value="'.$_POST["HIDDEN_modify_id"].'">';
                        $update_button .= '<br><div id=buttons>';
                        $update_button .= '<input type="Submit" value="yes" name="vererben" align="middle">';
                        $update_button .= '&nbsp;<input type=button name="no" onClick="window.location.href=\''.$_SESSION["go_back_page_ok"].'\'" value="no">';
                        $update_button .= '</div>';
                        $update_button .= '</form>';
                        message ($info, TXT_UPDATE_SERVICES.'<br>'.$update_button);
                    }
                }

                echo "<br>$info<br>";*/

            }else{
               // message ($info, '<b>Modify '.$config_class.' should work fine...</b>');
            }
            
            # Delete session
            if (isset($_SESSION["cache"]["modify"])) unset($_SESSION["cache"]["modify"]);

            if ( isset($_SESSION["go_back_page_ok"]) AND !isset($update_button) ){
                // Go to next page without pressing the button
              //  echo '<meta http-equiv="refresh" content="'.REDIRECTING_DELAY.'; url='.$_SESSION["go_back_page_ok"].'">';
               // message($info, '...redirecting to <a href="'.$_SESSION["go_back_page_ok"].'">page</a> in '.REDIRECTING_DELAY.' seconds...');
            }
        }
        # end of write2db
        if ($error) {
            $errors[]='Error in adding entry to ConfigItems:'.$error;
           /* echo "<b>Error:</b><br><br>";
            echo $error;
            echo "<br><br>";
            echo '<form name="modify" action="'.$_SESSION["go_back_page"].'" method="post">';
                echo '<div id=buttons>';
                echo '<input type="Submit" value="Back" name="back" align="middle">';
                echo '</div>';
            echo '</form>';*/
            foreach ($_POST as $key => $value) {
                $_SESSION["cache"]["modify"][$key] = $value;
            }
        }else{
            if (isset($_SESSION["cache"]["modify"])) unset($_SESSION["cache"]["modify"]);
        }        
    } # END Entry exists ?
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
}

        
         
      
function add_service_process($host_ID,$post_array)
{
	extract($post_array);
	$errors=array();
	$final_array=array();
	$data=array();
	$test_array=array();
	/* if ( isset($_POST["add_service"]) ){
    	unset($post_array["checkcommands"]);
   		$post_array["checkcommands"][$post_array["add_checkcommand"]] = $post_array["HIDDEN_checkcommands"][$post_array["add_checkcommand"]];
	} */
	
	
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
			$test_array[$checkcommand["key"]]['id']=$new_service_ID;
			$test_array[$checkcommand["key"]]['name']=$checkcommand["value"];
		}// END while
	
	} // END is_array($_POST["checkcommands"])
	if(empty($errors))
			{
				$data=array();
				$data['id']=$id;
				$final_array['results']='success';
				$final_array['msg']=$info;
				$final_array['data']=$data;
				$final_array['ids']=$test_array;
				$final_array['short_reason']='';
			}
			else
			{
				$data=array();
				$final_array['results']='failed';
				$final_array['msg']=$errors;
				$final_array['ids']=$test_array;
				$final_array['data']=$data;
				$final_array['short_reason']='';
			}
			return $final_array;
}
function add_extra_attr_service($post,$service_id,$config_class='service')
{
	# Modify = from modify, write to db
	# vererben = assign changes to linked services
	$id = $service_id; 
	$errors=array();
	$final_array=array();
			
	

		# Implode the splitet fields (exploded in modify_item.php)
		if(  ( isset($post["exploded"]) ) AND ( is_array($post["exploded"]) )  ){
			foreach ($post["exploded"] as $field_key => $value_array) {
				# string starts with a "!"
				$imploded = "!";
				# implode the other arguments
				$imploded .= implode("!", $value_array);
				# Save it to the POST-var, so the var will be added later in this script
				$post[$field_key] = $imploded;
			}
		}

		########
		# Get variables for check which one has changed (for history entries)

		# GET linked data for checking if they has changed (array entries)
		# get linked entries (ItemLinks) for passed id
		$query_old_linked_data = 'SELECT id_attr,attr_value,fk_item_linked2
						FROM ConfigValues,ItemLinks,ConfigAttrs
						WHERE fk_item_linked2=ConfigValues.fk_id_item
						AND id_attr=ItemLinks.fk_id_attr
						AND (SELECT naming_attr FROM ConfigAttrs WHERE id_attr=ConfigValues.fk_id_attr)="yes"
						AND ItemLinks.fk_id_item='.$id.'
						ORDER BY
						ConfigAttrs.friendly_name DESC,
						ItemLinks.cust_order
						';

		$result_old_linked_data = db_handler($query_old_linked_data, "result", "get linked entries");

		$old_linked_data = array();
		while($entry2 = mysql_fetch_assoc($result_old_linked_data)){
			$old_linked_data[$entry2["id_attr"]][] = $entry2["fk_item_linked2"];
		}

		# get entries linked as child (ItemLinks) for passed id   (without the childs saved in the parents!)
		$query_old_linked_child_data = 'SELECT id_attr,attr_value,ItemLinks.fk_id_item
					FROM ConfigValues,ItemLinks,ConfigAttrs
					WHERE ItemLinks.fk_id_item=ConfigValues.fk_id_item
					AND id_attr=ItemLinks.fk_id_attr
					AND ConfigAttrs.visible="yes"
					AND (SELECT naming_attr FROM ConfigAttrs WHERE id_attr=ConfigValues.fk_id_attr)="yes"
					AND ItemLinks.fk_item_linked2='.$id.'
					AND ConfigAttrs.attr_name <> "parents"
					ORDER BY ConfigAttrs.friendly_name DESC';

		$result_old_linked_child_data = db_handler($query_old_linked_child_data, "result", "get linked as child entries");
		while($entry3 = mysql_fetch_assoc($result_old_linked_child_data)){
			$old_linked_data[$entry3["id_attr"]][] = $entry3["fk_id_item"];
		}

		# Get old variables finished
		########

		# Check for existing entry
		$query = 'SELECT id_attr
					FROM ConfigAttrs,ConfigClasses
					WHERE naming_attr="yes"
						AND id_class=fk_id_class
						AND config_class="'.$config_class.'"
				 ';

		$id_naming_attr = db_handler($query, "getOne", "naming_attr ID:");

		$query = 'SELECT attr_value, fk_id_item
					FROM ConfigValues
					WHERE fk_id_attr='.$id_naming_attr.'
					AND attr_value = "'.escape_string($post[$id_naming_attr]).'"
					AND fk_id_item <>'.$id.'
				';
		$result = db_handler($query, "result", "does entry already exist");
				
		# Entry exists ?
		if ( (mysql_num_rows($result)) AND ($config_class != "service") ){
		   // echo 'Entry with name &quot;'.$post[$id_naming_attr].'&quot; already exists!';
			//echo '<br><br>Click for details: ';
			while($entry = mysql_fetch_assoc($result)){
			 //echo '<a href="detail.php?id='.$entry["fk_id_item"].'">'.$entry["attr_value"].'</a>';
			}
			//echo '<br><br>or go <a href="javascript:history.go(-1)">back</a>';
		}else{
			#entry not existing, lets try to modify:

			if ($config_class == "host") {
				# Vererben ?
				$vererben1_result = db_templates("vererben", $id);
				while($row = mysql_fetch_assoc($vererben1_result)){
					$vererben1[$row["item_id"]] = $row["attr_name"];
				}
			}

			# Check mandatory fields
			$m_array = db_templates("mandatory", $config_class);
			//$write2db = check_mandatory($m_array,$post);
$write2db='yes';

			# check oncall groups when class is host or service
			if ($config_class == "host" OR $config_class == "service") {
				# if failed do not allow write2db
				
				if ( oncall_check() == FALSE ){
					$write2db = 'no';
				}
			}

			if ($write2db == "yes"){
				################
				#### write to db
				################

				while ( $attr = each($post) ){
				
					if ( is_int($attr["key"]) ){
					
						// Get name of attribute:
						$attr_name = db_templates("friendly_attr_name", $attr["key"]);
						if ( $attr_name ){
							message ($debug, $attr_name, 'grouptitle' );
						}

						if ( is_array($attr["value"]) )
						{
						
							# modify assign_one/assign_many/assign_cust_order in ItemLinks
							# get datatype for handling assign_cust_order
							$attr_datatype = db_templates("attr_datatype", $attr["key"]);

							# Check if the values are modifyied, only save changed values
							if ( !isset($old_linked_data[$attr["key"]]) ){
								$old_linked_data[$attr["key"]] = array("0" => "");
							}

							/*
							echo "<br><br>saved array:";
							var_dump($old_linked_data[$attr["key"]]);
							echo '<br><b>new array '.$attr["key"].':</b>';
							var_dump($attr["value"]);
							*/

							# Assigned items
							if ($attr_datatype == "assign_cust_order"){
								# compare arrays with additional index check
								$diff_array = array_diff_assoc($attr["value"] ,$old_linked_data[$attr["key"]]);
							}else{
								# normal compare of arrays
								$diff_array = array_diff($attr["value"] ,$old_linked_data[$attr["key"]]);
							}
							if ( !empty($diff_array) ){
								while ( $attr_added = each($diff_array) ){
									history_add("assigned", $attr_name, $attr_added["value"], $id, "resolve_assignment");
								}
							}

							# Unassigned items
							if ($attr_datatype == "assign_cust_order"){
								# compare arrays with additional index check
								$diff_array2 = array_diff_assoc($old_linked_data[$attr["key"]], $attr["value"]);
							}else{
								# normal compare of arrays
								$diff_array2 = array_diff($old_linked_data[$attr["key"]], $attr["value"]);
							}
							if ( !empty($diff_array2) ){
								while ( $attr_removed = each($diff_array2) ){
									history_add("unassigned", $attr_name, $attr_removed["value"], $id, "resolve_assignment");
								}
							}

							/*
							echo "<pre>";
							var_dump($diff_array);
							var_dump($diff_array2);
							echo "</pre>";
							*/

							if ( (count($diff_array) OR count($diff_array2) ) != 0 ){
								//message ($info, "Attribute '$attr_name' has changed.");
							}else{
							   // message ($debug, 'no changes in this attribute');
								########## CONTINUE IF ATTRIBUTE WAS NOT CHANGED   ############
								continue;
							}



							###########################
							### Delete old links

							$lac_query = 'SELECT link_as_child
											FROM ConfigAttrs
											WHERE id_attr = "'.$attr["key"].'"
											';
							$lac_result = db_handler($lac_query, "getOne", "delete: link as child?");



							// is actual id the "servicegroup"?
							// Attention, very special hack!
							$servicegroup_select = 0;
							$servicegroup_id = db_templates("servicegroup_id");
							if ( $servicegroup_id == $attr["key"] ){
								$servicegroup_select = 1;
							   // message($debug, "delete: servicegroup matched");
							}
							
							//Querys
							$delete_query_lac = 'DELETE FROM ItemLinks
										WHERE fk_id_attr="'.$attr["key"].'"
										AND fk_item_linked2="'.$id.'"
										';

							$delete_query = 'DELETE FROM ItemLinks
										WHERE fk_id_attr="'.$attr["key"].'"
										AND fk_id_item="'.$id.'"
										';

							if ( (($lac_result == "yes") AND ($servicegroup_select != 1)) OR (($lac_result == "yes") AND ($servicegroup_select == 1) AND ($config_class == "servicegroup")) ){
								db_handler($delete_query_lac, "delete", "Delete link as child");
							}else{
								db_handler($delete_query, "delete", "Delete (not link as child)");
							}

							#########
							### Insert new links

							# counter for assign_cust_order
							$cust_order = 0;
							# save assign_one/assign_many/assign_cust_order in ItemLinks
							while ( $many_attr = each($attr["value"]) ){
								# if value is empty go to next one
								if (!$many_attr["value"]){
									continue;
								}else{
									# check link_as_child option
									$lac_query = 'SELECT link_as_child
													FROM ConfigAttrs
													WHERE id_attr = "'.$attr["key"].'"
													';
									$lac_result = db_handler($lac_query, "getOne", "get link as child");

									$servicegroup_select = 0;
									$servicegroup_id = db_templates("servicegroup_id");
									if ( $servicegroup_id == $attr["key"] ){
										$servicegroup_select = 1;
									  //  message($debug, "servicegroup matched");
									}

									# if the circumstances are correct, link as child
									if ( (($lac_result == "yes") AND ($servicegroup_select != 1)) OR (($lac_result == "yes") AND ($servicegroup_select == 1) AND ($config_class == "servicegroup")) ){
										$query = 'INSERT INTO ItemLinks
										(fk_id_item, fk_item_linked2, fk_id_attr, cust_order)
										VALUES
										('.$many_attr["value"].', '.$id.', '.$attr["key"].', '.$cust_order.')';
									# otherwise link items normally
									}else{
										$query = 'INSERT INTO ItemLinks
											(fk_id_item, fk_item_linked2, fk_id_attr, cust_order)
											VALUES
											('.$id.', '.$many_attr["value"].', '.$attr["key"].', '.$cust_order.')';
									}    
									message ($debug, $query);

									if (DB_NO_WRITES != 1) {
										if ( mysql_query($query) ){
										   // message ($debug, 'Successfully linked "'.$many_attr["value"].'" with '.$attr["key"]);
										}else{
										  //  message ($error, 'Error while linking '.$many_attr["value"].' with '.$attr["key"].':'.$query);
											 $errors[]='Error while linking '.$many_attr["value"].' with '.$attr["key"].':'.$query;
										}
									}

								}

								# increase assign_cust_order if needed
								if ($attr_datatype == "assign_cust_order") $cust_order++;

							}

						}else
						{
							# Lookup datatype
							$query = 'SELECT ConfigValues.attr_value, ConfigAttrs.datatype FROM `ConfigAttrs`, ConfigValues
										WHERE ConfigAttrs.id_attr = "'.$attr["key"].'"
										AND ConfigValues.fk_id_attr = ConfigAttrs.id_attr
										AND ConfigValues.fk_id_item = "'.$id.'"';

							$check = db_handler($query, "assoc", "Lookup value and datatype");
							if ($check == FALSE){
								$check["datatype"] = db_templates("attr_datatype", $attr["key"]);
							}
							
							// Check if the value has changed
							if ( !isset($check["attr_value"]) OR ($check["attr_value"] != $attr["value"]) ){
								if ($check["datatype"] == "password"){
									// IF Password field is a encrypted, do not save
									if ( preg_match( '/^{.*}/', $attr["value"]) ){
										//message ($info, "encrypted field will not be saved");
										continue;
									}elseif ( (PASSWD_DISPLAY == 0) AND  ( strpos($attr["value"], PASSWD_HIDDEN_STRING) !== false) ){
										// Passwort was displayed as "hidden" like "********", do not save
									  //  message ($info, "passwd was hidden and not modified");
										continue;
									}else{
										$insert_attr_value = encrypt_password($attr["value"]);
									}
								}else{
									// modify text/select
									$insert_attr_value = escape_string($attr["value"]);
								}

								$query =   'INSERT INTO ConfigValues
												(attr_value, fk_id_attr, fk_id_item)
											VALUES
												("'.$insert_attr_value.'", "'.$attr["key"].'", '.$id.' )
											ON DUPLICATE KEY UPDATE
												attr_value="'.$insert_attr_value.'"
											';

								$insert = db_handler($query, "insert", 'Insert entry');
								if ($insert){
									//message ($debug, 'Successfully added ('.stripslashes($insert_attr_value).')');
									history_add("modified", $attr["key"], $insert_attr_value, $id);
								}else{
								   // message ($error, 'Error while adding '.stripslashes($insert_attr_value).':'.$query);
								   $errors[]='Error while adding '.stripslashes($insert_attr_value).':'.$query;
								}
							}{
								// The data value has not changed, so no saving is needed
							}
						}
					}else{
						continue;
					}
				}
				
				
				
			}
			# end of write2db
			if (!empty($error)) {
				$final_array['results']='failed';
				$final_array['msg']=$errors;
			}
			else{
				$data[]="Updated successfully";
				$final_array['results']='success';
				$final_array['msg']=$data;	
			}

		} # END Entry exists ?
	
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
				if(preg_match("/Total/",$line)){
					$lines[]=$line;
					$count++;
					if(preg_match("/Errors/",$line) && !preg_match('/Total Errors:\s+0/',$line)){
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
       // shell_exec("sh /var/www/nconf/ADD-ONS/deploy_local.sh");
	 		//shell_exec('sh /var/www/nconf/ADD-ONS/deploy_local.sh');	
	 		/*echo "<span style='display:none;'>";
		  system("/etc/init.d/nagios3 reload");
 echo "</span>";	*/
		
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
function delete_host_service($ids,$class)
{

	$errors=array();
	$final_array=array();
    # make ids as array
    if ( $ids!='' ){
		$ids=$ids.",";
        $ids = explode(",", $ids);
		$ids=array_filter($ids);
    }
	

    foreach ($ids as $id){

        $item_name  = db_templates("naming_attr", $id);
       $item_class = db_templates("class_name", $id);
		if($item_class=="host" || $item_class=="service"){
        # Delete Services if item = host
        if ($item_class == "host"){

            // Select all linked services
            $query = 'SELECT id_item
                        FROM ConfigItems, ConfigClasses, ItemLinks
                        WHERE fk_id_class = id_class
                        AND config_class = "service"
                        AND fk_id_item = id_item
                        AND fk_item_linked2='.$id
                     ;
            $result = db_handler($query, "result", "Select all linked services");
            if ($result){
               // message ($debug, 'selected: '.mysql_num_rows($result), "ok" );
                if ( mysql_num_rows($result) > 0 ){
                    while ($item_ID = mysql_fetch_row($result)){
                        $query = 'DELETE FROM ConfigItems
                                    WHERE id_item='.$item_ID[0]
                                 ;
                       // message ($debug, $query, "query");
                        if (DB_NO_WRITES != 1) {
                            if ( mysql_query($query) ){
                                //message ($debug, '', "ok");
                            }else{
                                //message ($debug, '', "failed");
								$errors[]="failed";
                            }
                        }
                    } // END while
                }


            }else{
                //message ($debug, '', "failed");
				$errors[]="failed";
            }    

        } //END $item_class == "host"


        # Services: Bevore deleting the entry, check the host ID, for later history entry
        if ($class == "service"){
            $Host_ID = db_templates("hostID_of_service", $id);
        }

        // Delete entry
        $query = 'DELETE FROM ConfigItems
                    WHERE id_item='.$id;

        $result = db_handler($query, "result", "Delete entry");
        if ( $result ){
            # increase deleted items
            if (mysql_affected_rows() > 0){
                $deleted_items++;
            }

           // message ($debug, '', "ok");

            # Special service handling
            if ( ($class == "service") AND !empty($Host_ID) ){
                # Enter also the Host_ID of the deleted service into the History table
                history_add("removed", $class, $item_name, $Host_ID);
            }else{
                # Enter normal deletion, which object is deleted, without a "parent / linked" id
                history_add("removed", $class, $item_name );
            }
		
            // Go to next page without pressing the button (also have a look if delete comes from detailview
                
        }elseif (DB_NO_WRITES != 1){
            //message($error, 'Error when deleting '.$id.':'.$query);
			$errors[]='Error when deleting '.$id.':'.$query;
        }
	}

    } // foreach


   
	if(empty($errors))
	{
		$data=array();
		$data[]="Deleted successfully";
		$final_array['results']='success';
		$final_array['msg']=$data;
	}
	else
	{
		$data=array();
		$final_array['results']='failed';
		$final_array['msg']=$errors;
	}


return $final_array;

}
?>
