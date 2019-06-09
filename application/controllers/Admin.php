<?php
	/**
	* @author Bhushan
	* Handles all admin related operations
	*/
	class Admin extends CI_controller
	{
		
		function __construct()
		{
			parent::__construct();
			if (!isLogedin()) {
				logedUserRedirect();
			}
		}

		/**
		* Index/home page for admin
		*/
		public function index()
		{
			$this->load->view('header');
			$this->load->view('admin/index');
			$this->load->view('footer');
		}
	}