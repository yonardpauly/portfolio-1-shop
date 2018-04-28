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
   $Account->get_register_user();
   
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
                  <h3>Please register first</h3>
               </div>
               <div class="card-body">
                  <form method="POST" action="">
                     <div class="form-group">
                        <label for="id-fname">First Name</label>
                        <input type="text" class="form-control" name="fname" id="id-fname" placeholder="Enter First Name" value="<?= $Account->fname; ?>">
                        <div class="text-danger"><?= $Account->fnameErr; ?></div>
                     </div>
                     <div class="form-group">
                        <label for="id-lname">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="id-lname" placeholder="Enter Last Name" value="<?= $Account->lname; ?>">
                        <div class="text-danger"><?= $Account->lnameErr; ?></div>
                     </div>
                     <div class="form-group">
                        <label for="id-email">Email address</label>
                        <input type="text" class="form-control"name="email" id="id-email" placeholder="Enter Email Address" value="<?= $Account->email; ?>">
                        <div class="text-danger"><?= $Account->emailErr; ?></div>
                     </div>
                     <div class="form-group">
                        <label for="id-password">Password</label>
                        <input type="password" class="form-control"name="password" id="id-password" placeholder="Enter Password" value="<?= $Account->password; ?>">
                        <div class="text-danger"><?= $Account->passwordErr; ?></div>
                     </div>
                     <div class="form-group">
                        <label for="id-confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" id="id-confirm-password" placeholder="Confirm your Password" value="<?= $Account->cpassword; ?>">
                        <div class="text-danger"><?= $Account->cpasswordErr; ?></div>
                     </div>
                     <a class="btn btn-danger" href="../">Cancel</a>
                     <button class="btn btn-primary" type="submit" name="register" id="id-register">Register</button>
                  </form>
               </div>
               <div class="card-footer text-muted">
                  Already have account? <a href="login.php">Login here</a>
               </div>
            </div>
         </div>
      </div>
   </div>

</body>
</html>