<?php  class Social extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('cookie');
		$this->load->library('session');
		$this->load->library('OAuth2');
		$this->load->library('Template');		
	}

	public function session($provider) { 
		if($provider == 'facebook') {
			$app_id = '1099934946684039';
			$app_secret = '1124e03dec949af36f19509cf31dc30d';
			$provider	= $this->oauth2->provider($provider, array(
				'id' => $app_id,
				'secret' => $app_secret
				));			
		}
		else if($provider == 'google'){
			$app_id         = '150372237293-kodi6tp6dcq1d3jrresl0fd3l5aoef6t.apps.googleusercontent.com';
			$app_secret     ='Uu3hlahsdj6rDVvbz-6Sgklb'; 

			$provider 		= $this->oauth2->provider($provider, array(
				'id' => $app_id,
				'secret' => $app_secret,
				)); 			
		}
		if ( ! $this->input->get('code'))
		{  
			if($this->input->get('error')!=''){
				$err=ucwords(str_replace("_"," ",$this->input->get('error')));
				$this->session->set_flashdata('error',$err);
				redirect(base_url().'login');
				exit();
			}
			else{
				$provider->authorize();
			}
			
			
		}
		else
		{
			
			try
			{
				$success = false;
				$facebook_id="";
				$google_id="";
				$reg_type = "";
				$msg = lang("Something went wrong.Please try again.");

				$uriData = $this->uri->segment_array();
				$token = $provider->access($_GET['code']);
				$user = $provider->get_user_info($token);
				$this->load->model('user_model','',TRUE);
				if($uriData [2] == 'google'){
					$reg_type = "g";
					$google_id = $user["uid"]; 
					$success = true;
				}
				else if($uriData [2] == 'facebook'){
					$reg_type = "f";
					$facebook_id = $user["uid"];
					$success = true;
				}

				if($user["email"]!='' && $success == true){
					$isAlreadyLogedIn = $this->user_model->as_array()->get_by("email",$user["email"]);

					if(!empty($isAlreadyLogedIn) ){
						$array = array(
							'id'=>$isAlreadyLogedIn['id'],
							'session_update'=>true,
							'skip_validation'=>true
							);
						$this->user_model->check_login($array);
						if($userLoginData['status'] == 'success'){
							$social_loged_in = array('name'=>'social_loged_in',
								'value'=>base_url());
							$this->input->set_cookie($social_loged_in);
							$success = true;
						}
					}
					else{

						$password = mt_rand();
						$data = array(
							'full_name'=>$user["first_name"]." ".$user["last_name"],
							'email'=>$user["email"],
							'reg_type'=>$reg_type,
							'fb_id'=>$facebook_id,
							'google_id'=>$google_id,
							'status'=>'a',
							'email_activate'=>'y',
							'created'=>date('Y-m-d H:i:s'),
							'password'=>$password
							);
						$user_id = $this->user_model->insert($data,true);
						$array = array('id'=>$user_id,'session_update'=>true,'skip_validation'=>true);
						$this->user_model->check_login($array);
						$success = true;
					}

				}
				else{
					$success =false;
				}
				if($success == true)
				{
					redirect(base_url()."dashboard");
					exit();
				}else{
					
					$this->session->set_flashdata('error',$msg);
					redirect(base_url().'login');
					exit();
				}

			}
			catch (OAuth2_Exception $e)
			{
				
				$this->session->set_flashdata('error',$e);
				redirect(base_url().'login');
				exit();
			}
		}
	}

	public function success(){
		$this->session->keep_flashdata('success');
		echo "<script type='text/javascript'>
		opener.location = '".base_url()."dashboard';
		window.close();
	</script>";					
	exit;
}

public function error(){
	$this->session->keep_flashdata('error');
	echo "<script type='text/javascript'>
	opener.location = '".base_url()."login';
	window.close();
</script>";					
exit;
}

}?>