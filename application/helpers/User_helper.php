<?php
/**
* @author Bhushan
* Perfomance basic operations of user
*/

/**
* Checks if user is loged in or not by checking value of id of user
* @return true if user is loged in
* @return false if not loged in
*/
function isLogedin() {

  $CI = &get_instance();

  if($CI->session->userdata('id')) return true;
  else return false;

}

/**
* Redirects user to their respective area/page accordint to their role
* @return void
*/
function logedUserRedirect()
{
     $CI = &get_instance();
     switch ($CI->session->role_id) {
        case 1:
        case 2:
        redirect('admin','refresh');
        break;
        default:
        redirect('user','refresh');
        break;
    }
    exit();
}
