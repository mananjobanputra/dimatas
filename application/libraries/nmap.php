<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nmap
{
	public $scan_type_arr = array();
	public $udpscan_arr = array();
	public $rpcscan_arr = array();
	public $ping_type_arr = array();
	public $gen_option_arr = array();
	public $timing_options_arr = array();
	public $verbose_options_arr = array();
	public $dns_options_arr = array();


	public function __construct()
	{
		$scan_type_arr[]=array("value"=>'-sS ',"type"=>"radio","name"=>"scantype","text"=>"TCP SYN","extra"=>'',"checked"=>true,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sT ',"type"=>"radio","name"=>"scantype","text"=>"TCP Connect()","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sF ',"type"=>"radio","name"=>"scantype","text"=>"Stealth FIN","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sX ',"type"=>"radio","name"=>"scantype","text"=>"XMAS Tree","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sN ',"type"=>"radio","name"=>"scantype","text"=>"Null","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sP ',"type"=>"radio","name"=>"scantype","text"=>"Ping","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sO ',"type"=>"radio","name"=>"scantype","text"=>"IP","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sO ',"type"=>"radio","name"=>"scantype","text"=>"ACK","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sW ',"type"=>"radio","name"=>"scantype","text"=>"Window","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sL ',"type"=>"radio","name"=>"scantype","text"=>"List","extra"=>'',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'-sI ',"type"=>"radio","name"=>"scantype","text"=>"Idle","extra"=>'idlescan',"checked"=>false,"class"=>"scantype");
		$scan_type_arr[]=array("value"=>'',"type"=>"radio","name"=>"scantype","text"=>"None of the Above","extra"=>'',"checked"=>false,"class"=>"scantype");


		$udpscan_arr[]=array("value"=>'-sU ',"type"=>"checkbox","name"=>"udpscan","text"=>"UDP","extra"=>'',"class"=>"udpscan");
		$rpcscan_arr[]=array("value"=>'-sR ',"type"=>"checkbox","name"=>"rpcscan","text"=>"RPC","extra"=>'',"class"=>"rpcscan");

		$ping_type_arr[]=array("value"=>'-PB ',"type"=>"checkbox","name"=>"pingtype1","text"=>"TCP + ICMP echo request","extra"=>'',"checked"=>true,"class"=>"pingtype");
		$ping_type_arr[]=array("value"=>'-PT ',"type"=>"checkbox","name"=>"pingtype3","text"=>"TCP","extra"=>'',"checked"=>false,"class"=>"pingtype");
		$ping_type_arr[]=array("value"=>'-PS ',"type"=>"checkbox","name"=>"pingtype4","text"=>"SYN","extra"=>'',"checked"=>false,"class"=>"pingtype");
		$ping_type_arr[]=array("value"=>'-PI ',"type"=>"checkbox","name"=>"pingtype5","text"=>"ICMP echo request","extra"=>'',"checked"=>false,"class"=>"pingtype");
		$ping_type_arr[]=array("value"=>'-PP ',"type"=>"checkbox","name"=>"pingtype6","text"=>"ICMP timestamp","extra"=>'',"checked"=>false,"class"=>"pingtype");
		$ping_type_arr[]=array("value"=>'-PM ',"type"=>"checkbox","name"=>"pingtype7","text"=>"ICMP netmask request","extra"=>'',"checked"=>false,"class"=>"pingtype");
		$ping_type_arr[]=array("value"=>'-P0 ',"type"=>"checkbox","name"=>"pingtype2","text"=>"Do NOT ping","extra"=>'',"checked"=>false,"class"=>"pingtype");

		$gen_option_arr[]=array("value"=>'-O ',"type"=>"checkbox","name"=>"option1","text"=>"OS Fingerprint","extra"=>'',"checked"=>true,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-F ',"type"=>"checkbox","name"=>"option5","text"=>"Fast scan","extra"=>'',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-I ',"type"=>"checkbox","name"=>"option2","text"=>"TCP reverse ident (TCP Connect() Only)","extra"=>'',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-f ',"type"=>"checkbox","name"=>"option3","text"=>"Fragmented ip packets (SYN,FIN,XMAS,NULL Only)","extra"=>'',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-p ',"type"=>"checkbox","name"=>"option7","text"=>"Port range","extra"=>'portrange',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-iR ',"type"=>"checkbox","name"=>"option8","text"=>"Scan","extra"=>'randomhosts','text_placeholder'=>'Random hosts.',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-D ',"type"=>"checkbox","name"=>"option9","text"=>"Use decoys","extra"=>'decoys',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'-r ',"type"=>"checkbox","name"=>"option10","text"=>"Do NOT randomize port scan order","extra"=>'',"checked"=>false,"class"=>"option");
		$gen_option_arr[]=array("value"=>'--packet_trace ',"type"=>"checkbox","name"=>"option11","text"=>"Show every packet sent or recieved","extra"=>'',"checked"=>false,"class"=>"option");

		$timing_options_arr[]=array("value"=>'-T Paranoid ',"type"=>"radio","name"=>"timing","text"=>"Paranoid","extra"=>'',"checked"=>false,"class"=>"timing");
		$timing_options_arr[]=array("value"=>'-T Sneaky ',"type"=>"radio","name"=>"timing","text"=>"Sneaky","extra"=>'',"checked"=>false,"class"=>"timing");
		$timing_options_arr[]=array("value"=>'-T Polite ',"type"=>"radio","name"=>"timing","text"=>"Polite","extra"=>'',"checked"=>false,"class"=>"timing");
		$timing_options_arr[]=array("value"=>'-T Normal ',"type"=>"radio","name"=>"timing","text"=>"Normal","extra"=>'',"checked"=>true,"class"=>"timing");
		$timing_options_arr[]=array("value"=>'-T Aggressive ',"type"=>"radio","name"=>"timing","text"=>"Aggressive","extra"=>'',"checked"=>false,"class"=>"timing");
		$timing_options_arr[]=array("value"=>'-T Insane ',"type"=>"radio","name"=>"timing","text"=>"Insane","extra"=>'',"checked"=>false,"class"=>"timing");

		$verbose_options_arr[]=array("value"=>'',"type"=>"radio","name"=>"option4","text"=>"Standard Verbosity","extra"=>'',"checked"=>true,"class"=>"option");
		$verbose_options_arr[]=array("value"=>'-v ',"type"=>"radio","name"=>"option4","text"=>"Verbose Mode","extra"=>'',"checked"=>false,"class"=>"option");
		$verbose_options_arr[]=array("value"=>'-v -v ',"type"=>"radio","name"=>"option4","text"=>"Extra Verbose Mode","extra"=>'',"checked"=>false,"class"=>"option");

		$dns_options_arr[]=array("value"=>'-n ',"type"=>"radio","name"=>"option6","text"=>"Do not resolve DNS","extra"=>'',"checked"=>true,"class"=>"option");
		$dns_options_arr[]=array("value"=>'-R ',"type"=>"radio","name"=>"option6","text"=>"Resolve DNS","extra"=>'',"checked"=>false,"class"=>"option");
		$this->scan_type_arr = $scan_type_arr;	
		$this->udpscan_arr = $udpscan_arr;
		$this->rpcscan_arr = $rpcscan_arr;
		$this->ping_type_arr = $ping_type_arr;
		$this->gen_option_arr = $gen_option_arr;
		$this->timing_options_arr = $timing_options_arr;
		$this->verbose_options_arr = $verbose_options_arr;
		$this->dns_options_arr = $dns_options_arr;


		$this->MULTIPLE_HOSTS = YES;
		$this->NMAP = '/usr/bin/nmap';
		$this->SUDO = '/usr/bin/sudo';
		$this->DEBUG = YES;
		$this->SOURCE_ADDRESS = '';
		$this->INTERFACE = '';
		$this->SOURCE_PORT = '';
	}

	function get_scan_command($post)
	{
		extract($post);
		$commands = array();
		if (isset($ip) OR isset($option8)) 
		{

			if (check_ip($ip,$this->MULTIPLE_HOSTS) OR check_randomhosts($randomhosts)) 
			{

				if($this->SUDO) $run.= $this->SUDO." ";

				$run.= $this->NMAP." ";	

				switch ($scantype) {
					case $scantype=='-sS ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);

					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;	
					case $scantype=='-sT ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sF ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sX ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sN ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sP ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sO ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sA ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sW ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sL ';
					$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$scantype;
					break;
					case $scantype=='-sI ';
					check_idlescan($idlescan,$this->DEBUG);
					if (isset($idlescan)) {
						$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
						$commands_temp['extra_value']=escapeshellarg($idlescan);
						$commands[]=$commands_temp;
						$run.=$scantype.escapeshellarg($idlescan);
					} else {
						$commands_temp=get_element_array($this->scan_type_arr,'value',$scantype);
						$commands_temp['extra_value']='';
						$commands[]=$commands_temp;
						$run.=$scantype;
					}
					break;
				}
				if ($udpscan=='-sU ') {
					$commands_temp=get_element_array($this->udpscan_arr,'value',$udpscan);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$udpscan;
				}
				if ($rpcscan=='-sR ') {
					$commands_temp=get_element_array($this->rpcscan_arr,'value',$rpcscan);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$rpcscan;
				}
				if ($pingtype1=='-PB '){
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype1);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype1;
				}
				if ($pingtype2=='-P0 '){
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype2);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype2;
				}
				if ($pingtype3=='-PT '){
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype3);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype3;
				}
				if ($pingtype4=='-PS ') {
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype4);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype4;
				}
				if ($pingtype5=='-PI '){
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype5);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype5;
				}
				if ($pingtype6=='-PP ') {
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype6);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype6;
				}
				if ($pingtype7=='-PM '){
					$commands_temp=get_element_array($this->ping_type_arr,'value',$pingtype7);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$pingtype7;
				}
				if ($option1 == '-O ') {
					$commands_temp=get_element_array($this->gen_option_arr,'value',$option1);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.= $option1;
				}
				if ($option2 == '-I '){
					$commands_temp=get_element_array($this->gen_option_arr,'value',$option2);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.= $option2;
				}
				if ($option3 == '-f ') {
					$commands_temp=get_element_array($this->gen_option_arr,'value',$option3);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.= $option3;
				}
				switch ($option4) {
					case $option4=='-v ';
					$commands_temp=get_element_array($this->verbose_options_arr,'value',$option4);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$option4;
					break;
					case $option4=='-v -v';
					$commands_temp=get_element_array($this->verbose_options_arr,'value',$option4);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$option4;
					break;
				}
				if ($option5 == '-F ') {
					$commands_temp=get_element_array($this->gen_option_arr,'value',$option5);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.= $option5;
				}
				switch ($option6) {
					case $option6=='-n ';
					$commands_temp=get_element_array($this->dns_options_arr,'value',$option6);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$option6;
					break;
					case $option6=='-R ';
					$commands_temp=get_element_array($this->dns_options_arr,'value',$option6);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$option6;
					break;
				}
				if ($option7 == '-p ') {
					if (check_portrange($portrange)) {
						$commands_temp=get_element_array($this->gen_option_arr,'value',$option7);
						$commands_temp['extra_value']=$portrange;
						$commands[]=$commands_temp;
						$run.=escapeshellarg($option7.$portrange)." ";
					} else {
						echo "<BR><B>Invalid port range.</B>";
						exit();
					}
				}
				if ($option8 == '-iR ') {
					if (check_randomhosts($randomhosts)) {
						$commands_temp=get_element_array($this->gen_option_arr,'value',$option8);
						$commands_temp['extra_value']=$randomhosts;
						$commands[]=$commands_temp;
						$run.=$option8.escapeshellarg($randomhosts)." ";

					} else {
						echo "<BR><B>Invalid number of random hosts.</B>";
						exit();
					}
				}
				if ($option9 == '-D ') {
					if (check_decoys($randomhosts)) {
						$commands_temp=get_element_array($this->gen_option_arr,'value',$option9);
						$commands_temp['extra_value']=$decoys;
						$commands[]=$commands_temp;
						$run.=$option9.escapeshellarg($decoys)." ";
					} else {
						echo "<BR><B>Invalid decoy(s).</B>";
						exit();
					}
				}
				if ($option10 == '-r ') {
					$commands_temp=get_element_array($this->gen_option_arr,'value',$option10);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.= $option10;
				}
				if ($option11 == '--packet_trace ') $run.=$option11; 
				switch ($timing) {
					case $timing=='-T Paranoid ';
					$commands_temp=get_element_array($this->timing_options_arr,'value',$timing);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$timing;
					break;
					case $timing=='-T Sneaky ';
					$commands_temp=get_element_array($this->timing_options_arr,'value',$timing);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$timing;
					break;
					case $timing=='-T Polite ';
					$commands_temp=get_element_array($this->timing_options_arr,'value',$timing);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$timing;
					break;
					case $timing=='-T Normal ';
					$commands_temp=get_element_array($this->timing_options_arr,'value',$timing);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$timing;
					break;
					case $timing=='-T Aggressive ';
					$commands_temp=get_element_array($this->timing_options_arr,'value',$timing);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$timing;
					break;
					case $timing=='-T Insane ';
					$commands_temp=get_element_array($this->timing_options_arr,'value',$timing);
					$commands_temp['extra_value']='';
					$commands[]=$commands_temp;
					$run.=$timing;
					break;
				}
				if ($this->SOURCE_ADDRESS != '') {

					$run.=" -S $SOURCEADDRESS";
				}
				if ($this->INTERFACE != '') {
					$run.=" -e $this->INTERFACE";
				}
				if ($SOUCE_PORT != '') {
					$run.=" -g $this->SOURCE_PORT";
				}

				$run.=escapeshellarg($ip);
				if ($this->DEBUG == YES) {
					$run.=" 2>&1";
					//echo "<BR>Executing: $run <BR>";
				}


				$final_array['command']=$commands;
				$final_array['run']=$run;
				$final_array['result']="success";
			} else { 
				$final_array['command']=NULL;
				$final_array['run']=NULL;
				$final_array['result']="failed";
			}
		} 
		return $final_array;
	}

}
