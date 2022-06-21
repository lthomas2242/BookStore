<?php
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
        <div class="col-md-12 books" >
            <?php getBooks(); ?>
        </div>
    </div>
</div>

<?php
    class Book
    {
        public $book_id;
        public $quantity;
    }
    include("includes/footer.php");
    
    $book_array =[];
    function addToCart($book_id){
        //set session variable
        $_SESSION["book_id"] = $book_id;
        $_SESSION["quantity"] = 1;
        header("Location: details.php");
    }
    function getBooks(){
         
        // Connect to the db.
        require('./mysqli_oop_connect.php'); 
        
        $get_books = "select * from books";

        $r =  $mysqli->query($get_books);
        
        if(array_key_exists('addToCart', $_POST)) {
            addToCart($mysqli->real_escape_string(trim($_POST['book_id'])));
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

            echo "<form method='post' action=''> <div class='col-md-3 col-sm-6 center-responsive' >";
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
                            <p class='price' >$ $price </p>
                            <p class='buttons' >
                                
                                <input type='hidden' name='book_id' value=".($id).">
                                <input type='submit' class='btn btn-danger' name='addToCart' value='Details'/>
                                    
                            </p>
                        </div>
                    </div>
                </div></form>";
            }
        $r->free();
        unset($r);
    }
    
    
?>

