<?php
	/**
	* @author Bhushan
	* Handles User database operations
	* Uses md5 hashing to store passwords
	*/
	class User_model extends CI_model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		/**
		* @author Bhushan
		* This function logs in user by accepting credentials
		* @param $username username or email
		* @param #password password
		* @return true on successful login and sets session data [id,role_id,fname,lname]
		* @return false on unsuccessful login
		*/
		public function login($username = '', $password = '')
		{
			if (!$username || !$password) {
				return false;
			}

			/**
			* As we are using MD5 hashing for password storage, we have to compare MD5 hash of $password with db
			* to check if password is same.
			* We can not decrypt MD5 hash :) 
			*/
			$passwordHash = md5($password);
			$condition = "(username = '$username' OR email = '$username')";

			$user = $this->db->where($condition)
							->where('password',$passwordHash)
							->get('users')
							->result_array();

			/**
			* If count of users return is greater than 1 means there is conflict in credentials,
			* So we dont allow that user to login
			* If count is zero means no user so no login
			*/
			if ((count($user) > 1) || empty($user)) {
				return false;
			}

			$user = array_pop($user);
			$array = array(
				'id' => $user['id'],
				'role_id' => $user['role_id'],
				'username' => $user['username'],
				'fname' => $user['fname'],
				'lname' => $user['lname'],
			);

			$this->session->set_userdata( $array );
			return true;
		}
	}
