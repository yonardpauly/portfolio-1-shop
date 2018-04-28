<?php

$Account = new class extends AccountModel
{
   public $fname = '';
   public $lname = '';
   public $email = '';
   public $password = '';
   public $cpassword = '';

   public $fnameErr = '';
   public $lnameErr = '';
   public $emailErr = '';
   public $passwordErr = '';
   public $cpasswordErr = '';

   private function validate ($data) {

      $data = trim($data);
      $data = stripslashes($data);
      return $data;
   }

   function get_register_user () {

      if ( isset($_POST['register']) ) {

         $this->fname = $this->validate( $_POST['fname'] );
         $this->lname = $this->validate( $_POST['lname'] );
         $this->email = $this->validate( $_POST['email'] );
         $this->password = $this->validate( $_POST['password'] );
         $this->cpassword = $_POST['cpassword'];

         if ( empty($this->fname) ) {

            $this->fnameErr = 'First name field is required';

         } elseif ( strlen($this->fname) > 190 ) {

            $this->fnameErr = 'First name must be 190 characters and below only.';
            $this->fname = '';

         } elseif ( !preg_match('/^[a-zA-Z ]*$/', $this->fname) ) {

            $this->fnameErr = 'First name must contain letters and a space only.';
            $this->fname = '';

         } else { $this->fnameErr = ''; }

         if ( empty($this->lname) ) {

            $this->lnameErr = 'Last name field is required';
            
         } elseif ( strlen($this->lname) > 190 ) {

            $this->lnameErr = 'Last name must be 190 characters and below only.';
            $this->lname = '';

         } elseif ( !preg_match('/^[a-zA-Z ]*$/', $this->lname) ) {

            $this->lnameErr = 'Last name must contain letters and a space only.';
            $this->lname = '';

         } else { $this->lnameErr = ''; }

         if ( empty($this->email) ) {

            $this->emailErr = 'Email field is required';
            
         } elseif ( strlen($this->email) > 190 ) {

            $this->emailErr = 'Email must be 190 characters and below only.';
            $this->email = '';

         } elseif ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {

            $this->emailErr = 'Invalid email format, please try again.';
            $this->email = '';

         } else {

            $email = $this->set_find_emails( $this->email );
            if ( $email->rowCount() > 0 ) {

               $this->emailErr = 'Email is already taken, please input a new email address.';
               $this->email = '';

            } else { $this->emailErr = ''; }

         }

         if ( empty($this->password) ) {

            $this->passwordErr = 'Password field is required';
            
         } elseif ( strlen($this->password) < 8 || strlen($this->password) > 190 ) {

            $this->passwordErr = 'Password must contain 8 - 190 characters only.';
            $this->password = '';

         } elseif ( !preg_match('/^[a-zA-Z0-9,.?!@#$%^&*_+= ]*$/', $this->password) ) {

            $this->passwordErr = 'Illegal characters ARE NOT ALLOWED.';
            $this->password = '';

         } else { $this->passwordErr = ''; }

         if ( !empty($this->password) && empty($this->cpassword) ) {

            $this->cpasswordErr = 'Please confirm your password';

         } elseif ( $this->password !== $this->cpassword ) {

            $this->cpasswordErr = 'Password does not matched';
            $this->password = '';
            $this->cpassword = '';

         } else { $this->cpasswordErr = ''; }

         if ( empty($this->fnameErr) && empty($this->lnameErr) && empty($this->emailErr) && empty($this->passwordErr) && empty($this->cpasswordErr) ) {
            if ( !empty($this->fname) && !empty($this->lname) && !empty($this->email) && !empty($this->password) && !empty($this->cpassword) ) {

               date_default_timezone_set("Asia/Taipei");
               $date = date( 'm.y' );
               $time = date( 'h:i:s' );
               $exploded_date = explode('.', $date);
               $exploded_time = explode(':', $time);
               $imploded_date = implode( $exploded_date );
               $imploded_time = implode( $exploded_time );
               $new_user_code_array = [ $imploded_date, $imploded_time ];
               $new_user_code = implode( $new_user_code_array );
               var_dump($new_user_code . '<br>');

               $combined_names = [ $this->fname, $this->lname ];
               $full_name = implode( ' ', $combined_names );
               var_dump($full_name . '<br>');

               $hashed_password = password_hash( $this->password, PASSWORD_DEFAULT );               

               try {

                  $status = $this->set_register_user( $new_user_code, $full_name, $this->email, $hashed_password );
                  if ( $status ) {

                     $_SESSION['alert']['success'] = 'You are successfully registered!';
                     header( 'location: login.php' );
                     exit;

                  } else {

                     echo 'ERROR';
                  }


               } catch ( PDOException $e ) { echo $e->getMessage(); }
            }
         }
      } // End isset register
   } // End register method

   public $loginErr = '';
   public $login_email = '';
   public $login_password = '';   

   function get_login_user () {

      if ( isset($_POST['login']) ) {

         $this->login_email = $_POST['email'];
         $this->login_password = $_POST['password'];

         if ( empty($this->login_email) || empty($this->login_password) ) {

            $this->loginErr = 'Incorrect Email or Password, please try again';
            $this->login_email = '';
            $this->login_password = '';

         } else {

            $login_credentials = $this->set_login_user( $this->login_email );

            if ( $login_credentials->rowCount() > 0 ) {

               $login_data = $login_credentials->fetchAll();
               $hashed_pw = $login_data->user_password;
               password_verify( $this->password, $hashed_password );

               $_SESSION['user']['id'] = $login_data->id;
               $_SESSION['user']['code'] = $login_data->user_code;
               $_SESSION['user']['fname'] = $login_data->full_name;
               $_SESSION['user']['email'] = $login_data->email;
               header( 'location: ../home.php' );
               exit;
            }
         }
      }
   }
};