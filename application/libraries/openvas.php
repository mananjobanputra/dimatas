<?php
class openvas {
	function __construct(){
		include APPPATH . 'third_party/openvas/openvas_plugin_config.php';
		include APPPATH . 'third_party/openvas/openvas_plugin.php';
	}
}

?>
