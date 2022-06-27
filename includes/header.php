<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CRoboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!--<link rel="shortcut
icon" href="//cdn.shopify.com/s/files/1/2484/9148/files/SDQSDSQ_32x32.png?v=1511436147" type="image/png">-->
  <title>E-BookStore</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <header class="page-header">
    <div class="page-header__bottomline">
      <div class="container clearfix">

        <div class="logo">
          <a class="logo__link" href="index.php">
              <h1>E-BookStore</h1>
          </a>
        </div>
        <nav class="main-nav">
          <ul class="categories">
            <li class="categories__item">
              <?php
                    if(!isset($_SESSION['isLoggedIn'])){
                      echo '<a href="register.php" class="categories__link categories__link--active">Sign Up</a>';
                    }else{ 
                      echo '<div class="basket">
                              <a href="books.php" class="categories__link categories__link--active">
                                <?php ?> Books
                              </a>
                            </div>';
                    }   
                ?> 
            </li>
            <li class="categories__item">
                <?php
                    if(isset($_SESSION['isLoggedIn'])){ 
                      echo '<div class="basket">
                              <a href="cart.php" class="categories__link categories__link--active">
                                Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              </a>
                            </div>';
                    }   
                ?>
                
            </li>
            <li class="categories__item">
              <?php
                    if(!isset($_SESSION['isLoggedIn'])){
                      echo '<a href="login.php" class="categories__link categories__link--active">SIGN IN</a>';
                    }   
                ?>
            </li>
            <?php
                if(isset($_SESSION['isLoggedIn'])){
                    echo '<li class="categories__item">
                      <a class="categories__link categories__link--active" href="#">'; 
                    echo (isset($_SESSION['first_name']))? $_SESSION['first_name']:'';
                    echo '<i class="fa fa-user-circle" aria-hidden="true"></i></a>
                      <div class="dropdown dropdown--lookbook">
                        <div class="clearfix">
                          <div class="dropdown__half">
                            <div class="dropdown__heading"></div>
                            <ul class="dropdown__items">';
                    if(isset($_SESSION['profile_type']) && $_SESSION['profile_type']== "admin"){
                        echo '
                              <li class="dropdown__item">
                                <a href="admin_books.php" class="dropdown__link">Books</a>
                              </li>
                              <li class="dropdown__item">
                                <a href="admin_inventory.php" class="dropdown__link">Inventory</a>
                              </li>';
                    }
                       echo '<li class="dropdown__item">
                                <a href="logout.php" class="dropdown__link">Logout</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>';
                }
          ?>
          </ul>
        </nav>
      </div>
    </div>
  </header>

