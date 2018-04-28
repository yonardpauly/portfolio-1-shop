<?php

echo 'CART';

// DB Connection Page Area
require_once 'config/connect.php';

// Session Page Area
require_once 'config/user_session.php';

// Controller Page Area
require_once 'controllers/user_session.controller.php';
$UserSession->if_not_having_session();