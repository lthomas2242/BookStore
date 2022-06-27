<?php
    include("includes/header.php");
    if(!isset($_SESSION['isLoggedIn'])){
        header("Location: logout.php");
    }
?>

<main>
    <div class="nero">
      <div class="nero__heading">
          
        <span class="nero__bold">Books</span>
      </div>
      <p class="nero__text">
      </p>
    </div>
</main>
<div id="content" >
    <div class="container" >
        <div class="col-md-12" id="cart" >
            <div class="box" >
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-11"><h1>Books</h1></div>
                        <div class="col-md-1"><a href="admin_add_book.php?book_id=0"  id="addBook"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                    </div>
                    <div class="table-responsive" >
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>Book Id</th>
                                    <th>Title</th>
                                    <th>Language</th>
                                    <th>Publication Date</th>
                                    <th>Publisher</th>
                                    <th>Author</th>
                                    <th>ISBN</th>
                                    <th>Price</th>
                                    <th>Format</th>
                                    <th>Rating</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // Connect to the db.
                                    require('./mysqli_oop_connect.php'); 
                                    $select_book = "select * from books";
                                    $run_book = $mysqli->query($select_book);
                                    $num_book = $run_book->num_rows;
                                    if($num_book > 0){
                                         while($row_books = $run_book->fetch_object()){
                                             $id = $row_books->book_id;
                                ?>
                                <tr>
                                     <td>
                                        <label><?php echo $row_books->book_id; ?> </label>
                                    </td>
                                    <td>
                                        <a href="admin_add_book.php?book_id=<?php echo $id; ?>"><?php echo $row_books->title; ?></a>
<!--                                        <label><?php echo $row_books->title; ?> </label>-->
                                    </td>
                                   
                                    <td>
                                        <label><?php echo $row_books->language; ?> </label>
                                    </td>
                                     <td>
                                        <label><?php echo $row_books->publication_date; ?> </label>
                                    </td>
                                    <td>
                                        <label><?php echo $row_books->publisher; ?> </label>
                                    </td>
                                    <td>
                                        <label><?php echo $row_books->author; ?> </label>
                                    </td>
                                    <td>
                                        <label><?php echo $row_books->isbn; ?> </label>
                                    </td> 
                                    <td>
                                        <label><?php echo $row_books->price; ?> </label>
                                    </td> 
                                    <td>
                                        <label><?php echo $row_books->format; ?> </label>
                                    </td>
                                    <td>
                                        <label><?php echo $row_books->rating; ?> </label>
                                    </td>
                                     <td>
                                        <label><?php echo $row_books->description; ?> </label>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>