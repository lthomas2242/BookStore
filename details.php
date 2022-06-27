<?php
    include("includes/header.php");
    $book_id='';
    $total = 0;
    $count = 0;
    $num = 0;
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $book_id = $_GET['book_id'];
         // Connect to the db.
         require('./mysqli_oop_connect.php'); 
         $select_book = "select * from books where book_id='$book_id'";
         $run_book = $mysqli->query($select_book);
         $count = $run_book->num_rows;
         $num = $run_book->num_rows;
    }
//    // If the id is set
//    if (isset($_SESSION['book_id']) && ($_SESSION['book_id'])) {
//        
//    }
//    function goToCheckout($amount){
//        header("Location: checkout.php?amount=$amount");
//    }
    function back(){
        if(isset($_SESSION['isLoggedIn'])){
            header("Location:books.php");
        }else{
            header("Location:index.php");
        }
    }
    if(array_key_exists('back', $_POST)) {
        back();
    }
?>

<main>
    <div class="nero">
      <div class="nero__heading">
          
        <span class="nero__bold">details</span>
      </div>
      <p class="nero__text">
      </p>
    </div>
</main>
<div id="content" >
    <div class="container" >
        <div class="col-md-12" id="cart" >
            <div class="box" >
                <form action="details.php" method="post">
                    
                    <?php 
                            while($row_books = $run_book->fetch_object()){
                                    $id = $row_books->book_id;
                                    $price = $row_books->price;
                                    $title = $row_books->title;
                                    $image_url = $row_books->image_url;
                                    $quantity = 1;
                                    $sub_total = $price*$quantity;
                                    $total += $sub_total;
                                    $publisher = $row_books->publisher;
                                    $description = $row_books->description;
                                    $author = $row_books->author;
                                    $language = $row_books->language;
                                    $publication_date = $row_books->publication_date;
                                    $isbn = $row_books->isbn;
                                    $format = $row_books->format;
                                    $rating = $row_books->rating;

                        ?>
                        <div id="content" >
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="row" id="productMain">
                                        <div class="col-sm-6">
                                            <div id="mainImage"><!-- mainImage Starts -->
                                                <div class="item active">
                                                    <center>
                                                    <img src="<?php echo $image_url; ?>" class="img-responsive">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 details" >
                                            <h1 class="text-center" > <?php echo $title; ?> </h1>
                                            <h3 class="text-center" > Author : <?php echo $author; ?></h3>
                                            <h3 class="text-center" >Publisher : <?php echo $publisher; ?></h3>
                                            <p class="text-center" >Published On : <?php echo $publication_date; ?></p>
                                            <p class="text-center" >ISBN : <?php echo $isbn; ?></p>
                                            <p class="text-center" >Format : <?php echo $format; ?></p>
                                            <h3 class="text-center" >$ <?php echo $price; ?></h3>
                                            <p class="text-center" > <?php echo $description; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     </div>
                <?php }  ?>
                    

                    <div class="box-footer">
                        <div class="pull-left">
                            <button type="submit" class="btn btn-default" name='back' >
                                <i class="fa fa-chevron-left"></i> Back
                            </button>
                        </div>
<!--
                        <input type='hidden' name='total' value="<?php echo $total; ?>">
                        <?php
                            if($num > 0){?>
                                <div class="pull-right">
                                    <button type="submit"  name='checkout' class="btn btn-danger">
                                        Proceed to Checkout
                                    </button>
                                </div>
                        <?php }  ?>
-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>
</body>
</html>
