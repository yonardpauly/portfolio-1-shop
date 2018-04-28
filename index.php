<?php
   // DB Connection Page Area
   require_once 'config/connect.php';

   // Session Page Area
   require_once 'config/user_session.php';

   // Model Page Area
   require_once 'models/index.model.php';

   // Controller Page Area
   require_once 'controllers/user_session.controller.php';
   require_once 'controllers/index.controller.php';

   // Fetching Area
   $data = $Index->get_show_items()->fetchAll();
   $categories = $Index->get_show_item_categories()->fetchAll();
   $UserSession->if_having_session();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="assets/css/bootstrap-4.1.0.css">
   <title>Shopping Site</title>
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Portfolio 1</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="cart.php">My Cart</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="itemCategory" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Item Category
               </a>
               <div class="dropdown-menu" aria-labelledby="itemCategory">
                  <?php foreach( $categories as $category ): ?>
                  <a class="dropdown-item" href="#<?= $category->category_name; ?>"><?= $category->category_name; ?></a>
                  <?php endforeach; ?>
               </div>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?= $UserSession->sessionAlert; ?>
               </a>
               <div class="dropdown-menu" aria-labelledby="account">
                  <a class="dropdown-item" href="<?= $UserSession->login_logout_href; ?>"><?= $UserSession->login_logout_link; ?></a>
                  <?= $UserSession->registerHref; ?>
               </div>
            </li>
            <form class="form-inline my-2 my-lg-0">
               <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
               <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
         </ul>
      </div>
   </nav>

   <div class="jumbotron">
      <h1 class="display-4">Welcome, Portfolio Shop by JYP!</h1>
      <p class="lead">This is my first portfolio site for my BS-IT course.</p>
      <hr class="my-4">
      <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
   </div>

   <div class="container">
      <div class="row">
         <?php foreach ( $data as $row ): ?>
         <div class="col-md-3">
            <div class="card text-center bg-light mb-3" style="max-width: 18rem;">
               <div class="card-header"><?= $row->item_name; ?></div>
               <div class="card-body">
                  <h5 class="card-title">Image Here</h5>
                  <button class="btn btn-primary mb-2" id="item<?= $row->id; ?>">Add to Cart</button>
                  <h5>Price: <?= $row->item_price; ?></h5>
               </div>
            </div>
         </div>
         <?php endforeach; ?>
      </div>
   </div>

   <script src="assets/js/jquery-3.3.1.js"></script>
   <script src="assets/js/popper.js"></script>
   <script src="assets/js/bootstrap.js"></script>
</body>
</html>
