<?php

   // DB Connection Page Area
   require_once '../config/connect.php';

   // Session Page Area
   require_once '../config/user_session.php';

   // Model Page Area
   require_once '../models/account.model.php';

   // Controller Page Area
   require_once '../controllers/user_session.controller.php';
   $UserSession->if_having_session( '../home.php' );

   require_once '../controllers/account.controller.php';
   $Account->get_login_user();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../assets/css/bootstrap-4.1.0.css">
	<title>Login</title>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
         <a class="navbar-brand" href="/portfolio-1">JYP</a>   
      </div>
   </nav>

   <div class="container form">
      <div class="row">
         <div class="col-md-6 offset-md-3">
            <div class="card text-center">
               <div class="card-header">
                  <h3>Please login first</h3>
               </div>
               <div class="card-body">
                  <form method="POST" action="">
                     <div class="form-group">
                        <label for="id-email-address">Email Address</label>
                        <input type="text" class="form-control" name="email" id="id-email-address" placeholder="Enter Email Address" value="<?= $Account->login_email; ?>">
                     </div>
                     <div class="form-group">
                        <label for="id-password">Password</label>
                        <input type="password" class="form-control" name="password" id="id-password" placeholder="Enter Password" value="<?= $Account->login_password; ?>">
                     </div>
                     <a class="btn btn-danger" href="../">Cancel</a>
                     <button class="btn btn-primary" type="submit" name="login" id="id-login">Login</button>
                  </form>
               </div>
               <div class="card-footer text-muted">
                  Don't have account? <a href="register.php">Register here</a><br>
						<div class="text-danger"><?= $Account->loginErr; ?></div>
               </div>
            </div>
         </div>
      </div>
   </div>

</body>
</html>