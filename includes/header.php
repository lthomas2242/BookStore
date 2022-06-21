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
<!--
            <li class="categories__item">
                <?php
                    if(isset($_SESSION['isLoggedIn'])){ 
                      echo '<div class="basket">
                              <a href="cart.php" class="categories__link categories__link--active">
                                <?php ?> Cart
                              </a>
                            </div>';
                    }   
                ?>
                
            </li>
-->
            <li class="categories__item">
              <?php
                    if(!isset($_SESSION['isLoggedIn'])){
                      echo '<a href="login.php" class="categories__link categories__link--active">Sign In</a>';
                    }else{ 
                          echo '<a href="./logout.php" class="categories__link categories__link--active">Logout</a>';
                    }   
                ?>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

