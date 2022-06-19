<?php
    session_start();
    include("includes/header.php");
?>
  <main>
    <div class="nero">
      <div class="nero__heading">
        Make a choice from <span class="nero__bold"> E-BookStore</span> 
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>


<div id="content" >
    <div class="container" >
<!--
        <div class="col-md-12" >
        </div>
-->
<!--
        <div class="col-md-3">
        </div>
-->
        <div class="col-md-12" >
            <?php getProducts(); ?>
        </div>
        <center>
            <ul class="pagination" >
                
            </ul>
        </center>
    </div>
</div>

<?php
    include("includes/footer.php");
   
    function getProducts(){
         


        // Connect to the db.
        require('./mysqli_oop_connect.php'); 
        
        $get_books = "select * from books";

        $r =  $mysqli->query($get_books);
        function addToCart(){
           header("Location: cart.php");
//           header("Location: cart.php?id='.$id.'");
        }
        if(array_key_exists('addToCart', $_POST)) {
            addToCart();
//            addToCart($mysqli->real_escape_string(trim($_POST['id'])));
        }

        while($row_books = $r->fetch_object()){

            $id = $row_books->book_id;
            $title = $row_books->title;
            $description = $row_books->description;
            $language = $row_books->language;
            $publication_date = $row_books->publication_date;
            $publisher = $row_books->publisher;
            $author = $row_books->author;
            $isbn = $row_books->isbn;
            $image_url = $row_books->image_url;
            $price = $row_books->price;
            $format = $row_books->format;
            $rating = $row_books->rating;

            echo "<form method='post'> <div class='col-md-4 col-sm-6 center-responsive' >";
            if($rating !=null || $rating!=""){
                echo "<a class='label sale' href='#' style='color:black;'>
                    <div class='thelabel'>$rating</div>
                    <div class='label-background'> </div>
                </a>";
            }
                echo "
                    <div class='product' >
                        <a href='image_url' >
                            <img src=$image_url class='img-responsive' >
                        </a>
                        <div class='text' >
                            <h3><a href='pro_url' >$title</a></h3>
                            <p class='price' > $publisher </p>
                            <p class='price' > $price </p>
                            <p class='buttons' >
                                <a href='pro_url' class='btn btn-default' >View details</a>
                                <button class='btn btn-danger' name='addToCart' value=$id>
                                    <i class='fa fa-shopping-cart' data-price=$price></i> Add To Cart
                                </button>
                            </p>
                        </div>
                    </div>
                </div></form>";
            }
        $r->free();
        unset($r);
    }
    
    
?>

