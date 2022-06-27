<?php
    include("includes/header.php");
?>

<main>
    <div class="hero">
      
    </div>
    <div class="wrapper">
        <h1 style="color:#cf0909;font-weight:bold;">Featured Collections</h1>
    </div>
    
    <div id="content" >
        <div class="container" >
            <div class="col-md-12 books" >
                <?php getBooks(); ?>
            </div>
            <div class="view-more">
                <?php
                    if(isset($_SESSION['isLoggedIn'])){
                      echo '<a href="books.php" class="btn btn-ebook">View more</a>';
                    }else{ 
                      echo '<a href="login.php" class="btn btn-ebook">View more</a>';
                    }   
                ?>
            </div>
        </div>
    </div>

    <?php
        function getBooks(){

            // Connect to the db.
            require('./mysqli_oop_connect.php'); 

            $get_books = "select * from books left join inventory on books.book_id = inventory.book_id  where inventory.quantity>0  order by books.book_id desc LIMIT 4";

            $r =  $mysqli->query($get_books);

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
                        <div class='thelabel'>$rating<i class='fa fa-star' aria-hidden='true'></i></div>
                        <div class='label-background'> </div>
                    </a>";
                }
                    echo "
                        <div class='product' >
                            <a href='image_url' >
                                <img src=$image_url class='img-responsive' >
                            </a>
                            <div class='text' >
                                <h4><a href='details.php?book_id=$id' >$title</a></h4>
                                <p class='author'> $author </p>
                                <p class='price' >$ $price </p>
                            </div>
                        </div>
                    </div></form>";
                }
            $r->free();
            unset($r);
        }
?>
</main>
<?php
    include("includes/footer.php");
?>
