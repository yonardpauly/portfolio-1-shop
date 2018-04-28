<?php

class AccountModel extends Database
{
   function set_register_user ( $user_code, $user_name, $email, $user_password ) {

      return self::query(
         'INSERT INTO users ( user_code, full_name, email, user_password, activeness ) VALUES ( ?, ?, ?, ?, ? )', [
         $user_code, $user_name, $email, $user_password, 0
      ]);
   }

   function set_login_user ( $email ) {

      return self::query(
         'SELECT id, user_code, full_name, email, user_password FROM users WHERE email = ?', [
         $email
      ]);
   }

   function set_find_emails ( $email ) {

      return self::query('SELECT email FROM users WHERE email = ?', [$email]);
   }
}