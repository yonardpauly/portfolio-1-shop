<?php

$UserSession = new class
{
	public $sessionAlert = 'Account';
	public $login_logout_href = 'accounts/login.php';
	public $login_logout_link = 'Login';
	public $registerHref = '<a class="dropdown-item" href="accounts/register.php">Register</a>';

   function if_having_session ( $redirect_location = 'home.php' ) {

      if ( isset($_SESSION['user']['id']) ) {
         if ( $_SESSION['user']['id'] ) {

            header ( 'location: '. $redirect_location );
            $this->sessionAlert = 'Welcome '. $_SESSION['user']['fname'];

            $this->login_logout_href = 'logout.php';
            $this->login_logout_link = 'Logout';
            $this->registerHref = '';
         }
      }
   }

   function if_not_having_session ( $redirect_location = 'accounts/login.php' ) {

      if ( !$_SESSION['user']['id'] ) {

         header ( 'location: '. $redirect_location );
      }
   }
};