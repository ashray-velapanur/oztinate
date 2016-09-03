<?php
require_once 'email/Email.php';
class EmailFunctions{

	private $email;
	public function __construct($id = NULL)
	{
		/*// parent::__construct();
		$this->CI =& get_instance(); 
		$this->CI->load->library('curl'); 
		//$this->CI->load->library('email');
		$this->CI->load->model('user_model');*/

		$config['useragent'] = 'Oztinate';
		$config['protocol'] = 'smtp';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] = 'fitchain@gmail.com';
		$config['smtp_pass'] = 'manage123soft';
		$config['smtp_port'] = 465; 
		$config['smtp_timeout'] = 5;
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 76;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['validate'] = FALSE;
		$config['priority'] = 3;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['bcc_batch_mode'] = FALSE;
		$config['bcc_batch_size'] = 200;

		$email = new CI_Email($config);

	}

	public function emailAdminOnUserRegister()
	{
		//Get admin users
		$adminDetails = $this->CI->user_model->getAllAdmins();

		// Note: no $config param needed
		
		foreach($adminDetails as $record){
			$this->CI->email->from('fitchain@gmail.com', 'fitchain@gmail.com');
			$this->CI->email->subject('Fitchain User Registration Notification');
			$this->CI->email->message('Hi Admin,<br/><br/> A user registered to fitchain, Please login to fitchain and approve user <br/><br/> <a href="'.project_url().'">'.project_url().'</a>');
			$this->CI->email->to($record["email"]);
			$this->CI->email->send();
	       
	        // show_error($this->CI->email->print_debugger());  		       
        }

	}

	public function sendTaskUpdateEmail($data)
	{

	}

	public function emailOnTaskSubmit($userId)
	{
		$userDetails = $this->CI->user_model->getUserById($userId);

		$this->email->from('oztinate@gmail.com', 'oztinate@gmail.com');
		$this->email->subject('Fitchain Account Activation');
		$this->email->message('Hi '.$userDetails["name"].',<br/><br/> Your fitchain account is activated. You can now access your account<br/><br/> <a href="'.project_url().'">'.project_url().'</a>');
		$this->email->to("mufeedk@gmail.com");
		$this->email->send(); 
	}



}

?>