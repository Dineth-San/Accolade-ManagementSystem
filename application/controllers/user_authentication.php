<?php


//session_start(); //we need to start session in order to access it through CI

Class User_Authentication extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_database');
	}

	// Show login page
	public function index() {
		
		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('dashboard');
		}
		else{
			$this->load->view('login_form');
		}
	
	}

	// Show registration page
	public function user_registration_show() {
	$this->load->view('registration_form');
	}

	// Validate and store registration data in database
	public function new_user_registration() {

		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('registration_form');
		} 
		else {
			$data = array(
			'user_name' => $this->input->post('username'),
			'user_email' => $this->input->post('email_value'),
			'user_password' => $this->input->post('password'),
			'role' => $this->input->post('role')
			);
			$result = $this->login_database->registration_insert($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Registration Successfully Done!';
				$this->load->view('login_form', $data);
			} 
			else {
				$data['message_display'] = 'Username already exist!';
				$this->load->view('registration_form', $data);
			}
		}
	}

	public function user_login_process() {


		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				$this->load->view('dashboard');
				include_once "application/models/student_model.php";
			}
			else{
				$this->load->view('login_form');
			}
		} 
		else {
			$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
			$result = $this->login_database->login($data);
			if ($result == TRUE) {

				$username = $this->input->post('username');
				$result = $this->login_database->read_user_information($username);
				if ($result != false) {

					$session_data = array(
					'username' => $result[0]->user_name,
					'email' => $result[0]->user_email,
					'role' => $result[0]->role,
					);
					$this->session->set_userdata('logged_in', $session_data);
					 $this->load->view('dashboard');
				}
			} 
			else {
				$data = array(
				'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('login_form', $data);
			}
		}
	}

	public function logout() {

		$this->session->sess_destroy();
		$data['message_display'] = 'Successfully Logged-out';
		$this->load->view('login_form', $data);
		}

}

?>