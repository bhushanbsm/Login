<?php
	/**
	* @author Bhushan
	* 
	*/
	class User extends CI_controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/**
		* Index page loads first i.e. this is landing page
		* If you want to change it to login page you can, still logic will be same.
		* If user is loged in we dont want that user to access this page, it is irrelevant.
		*/
		public function index()
		{
			if (isLogedin()) {
				logedUserRedirect();
			}
			$this->load->view('header');
			$this->load->view('index');
			$this->load->view('footer');
		}

		/**
		* This is where login happens
		* @param username as username or email
		* @param password
		* @return redirects to respective area/page
		*/
		public function login()
		{
			if (isLogedin()) {
				logedUserRedirect();
			}

			/**
			* We dont want XSS to occure hence we are filtering input with xss filter
			*/
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);

			/**
			* If username or password contains spaces or is blank we can not perform check,
			* Hence throw error
			*/
			if (preg_match('/\s/', $username) || !$username || !$password || preg_match('/\s/', $password)) {
				$this->session->set_flashdata('login_error', 'Username and Password is required');
				redirect('user','refresh');
			}

			$this->load->model('User_model');
			if ($this->User_model->login($username,$password)) {
				/**
				* User is successfully logedin, Now redirect them to their respective area/page according to their role
				*/
				logedUserRedirect();
			} else {
				/**
				* Otherwise Who you are
				*/
				$this->session->set_flashdata('login_error', 'Incorrect Username or Password');
				redirect('user','refresh');
			}
		}

		/**
		* Logout user by destroying session and its data, then redirect to login page
		*/
		public function logout()
		{
			session_destroy();
			redirect('user','refresh');
		}
	}