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
<!--            <img class="logo__img" src="images/logo.png" alt="Avenue fashion logotype" width="237" height="19">-->
          </a>
        </div>
        <nav class="main-nav">
          <ul class="categories">
            <li class="categories__item">
              <a class="categories__link categories__link--active" href="books.php">
                Books
              </a>
            </li>
            <li class="categories__item">
              <?php
                    if(!isset($_SESSION['customer_email'])){
                      echo '<a href="customer_register.php" class="login__link">Register</a>';
                    }else{ 
                          echo '<a href="customer/my_account.php?my_orders" class="categories__link categories__link--active">My Account</a>';
                    }   
                ?> 
            </li>
            <li class="categories__item">
              <?php
                    if(!isset($_SESSION['customer_email'])){
                      echo '<a href="checkout.php" class="categories__link categories__link--active">Sign In</a>';
                    }else{ 
                          echo '<a href="./logout.php" class="categories__link categories__link--active">Logout</a>';
                    }   
                ?>
            </li>
            <li class="categories__item">
                <div class="basket">
                  <a href="cart.php" class="categories__link categories__link--active">
                    <i class="icon-basket"></i>
                    <?php ?> items
                  </a>
                </div>
            </li>

<!--
          <li class="categories__item">
              <a class="categories__link" href="customer/my_account.php?my_orders">
                My Account
                <i class="icon-down-open-1"></i>
              </a>
              <div class="dropdown dropdown--lookbook">
                <div class="clearfix">
                  <div class="dropdown__half">
                    <div class="dropdown__heading">Account Settings</div>
                    <ul class="dropdown__items">
                      <li class="dropdown__item">
                        <a href="#" class="dropdown__link">My Wishlist</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="#" class="dropdown__link">My Orders</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="#" class="dropdown__link">View Shopping Cart</a>
                      </li>
                    </ul>
                  </div>
                  <div class="dropdown__half">
                    <div class="dropdown__heading"></div>
                    <ul class="dropdown__items">
                      <li class="dropdown__item">
                        <a href="#" class="dropdown__link">Edit Your Account</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="#" class="dropdown__link">Change Password</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="#" class="dropdown__link">Delete Account</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
-->
          </ul>
        </nav>
      </div>
    </div>
  </header>

