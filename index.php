<?php
    session_start();
    include("includes/header.php");
?>

<main>
    <div class="hero">
      <a href="shop.php" class="btn1">View all products</a>
    </div>
    <div class="wrapper">
        <h1>Featured Collection</h1>
    </div>
    <div id="content" class="container">


    </div>
    <footer class="page-footer">
      <div class="footer-nav">
        <div class="container clearfix">
          <div class="footer-nav__col footer-nav__col--about">
            <div class="footer-nav__heading">About us</div>
            <p>We’re one of the fastest growing online bookshops and our mission is to provide you with an alternative haven to buy the books you love for the lowest prices. We offer over 10 million books and provide free delivery to over 100 countries.At E-BookStore you will find the Best Children's Books to read from our bookstore. We are proud to continue to offer you competitively low prices since our opening. E-BookStore’s journey started by selling educational books. We grew our business and expanded our range and have since grown into being a specialist in children’s book sets. We offer affordable and quality collection series.We are one of the biggest independent bookstores in the CANADA and provide services such as offering wholesale buying options to schools all over the world.</p>
          </div>
          <div class="footer-nav__col footer-nav__col--contacts">
            <div class="footer-nav__heading">Contact details</div>
            <address class="address">
            Head Office: BookStore.<br>
            180-182 Next Street, Canada.
          </address>
            <div class="phone">
              Telephone:
              <a class="phone__number" href="tel:0123456789">0123-456-789</a>
            </div>
            <div class="email">
              Email:
              <a href="mailto:support@yourwebsite.com" class="email__addr">support@ebookstore.com</a>
            </div>
          </div>
        </div>
      </div>
      <div class="page-footer__subline">
        <div class="container clearfix">

          <div class="copyright">
            &copy; <?php echo date("Y");?> E-BookStore
          </div>
        </div>
      </div>
    </footer>
</body>
</html>
