<?php 
require_once('gapi/vendor/autoload.php');

class Google {
	protected $CI;

	public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->config->load('google_config');
        $this->client = new Google_Client();
		$this->client->setClientId($this->CI->config->item('google_client_id'));
		$this->client->setClientSecret($this->CI->config->item('google_client_secret'));
		$this->client->setRedirectUri($this->CI->config->item('google_redirect_url'));
		$this->client->addScope('email');
		$this->client->addScope('profile');
        $this->client->addScope(Google_Service_Drive::DRIVE);
	}

	public function get_login_url(){
		return  $this->client->createAuthUrl();
	}

	public function validate(){		
		if (isset($_GET['code'])) {
		  $this->client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $this->client->getAccessToken();
		}
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		  $this->client->setAccessToken($_SESSION['access_token']);
		  $plus = new Google_Service_Oauth2($this->client);
		   return $plus->userinfo->get();
		}
	}

	public function upload_gdrive($url,$name){
        $service = new Google_Service_Drive($this->client);
        $file = new Google_Service_Drive_DriveFile();
        $file->setName($name.rand(5,250).'.mp4');
        $file->setDescription($name.rand(250,500));
        $file->setMimeType('video/mp4');

        $data = file_get_contents($url);

        $createdFile = $service->files->create($file, array(
            'data' => $data,
            'mimeType' => 'video/mp4',
            'uploadType' => 'multipart'
        ));

        print_r($createdFile);

    }

}