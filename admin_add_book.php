<?php
    include("includes/header.php");
    if(!isset($_SESSION['isLoggedIn'])){
        header("Location: logout.php");
    }
    require('./mysqli_oop_connect.php'); 
    $bookId = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bookId = $_GET["book_id"];
    }
    $title = $description = $language = $publication_date = $publisher = $author = $isbn = $image_url = $price = $format = $rating =$quantity=$book_id= '';
    if($bookId != 0){
         $get_book = "select * from books where book_id='$bookId'";
         $run_book = $mysqli->query($get_book);
         
         while ($row_books = $run_book->fetch_object()) {
            $book_id = $row_books->book_id;
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
            $get_inventory = "select * from inventory where book_id='$bookId'";
            $run_inventory = $mysqli->query($get_inventory);
             while ($run_inv = $run_inventory->fetch_object()) {
                  $quantity = $run_inv->quantity;
             }
         }

    }
    
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Connect to the database:
            $mysqli = new MySQLi('localhost', 'root', '', 'bookstore');
            $mysqli->set_charset('utf8');
            if($_GET["book_id"] == 0){
                //Insert query
                 $q = 'INSERT INTO books(title,description,language,publication_date,publisher,author,isbn,image_url,price,format,rating) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
                 // Prepare the statement:
                $stmt = $mysqli->prepare($q);

                // Bind the variables:
                $stmt->bind_param('sssssssssss', $title, $description,$language,$publication_date,$publisher,$author,$isbn,$image_url,$price,$format,$rating);
            }else{
                 $q = 'UPDATE books SET title = ?, description = ?, language = ?, publication_date = ?, publisher = ?, author = ?, isbn = ?, image_url = ?, price = ?, format = ?, rating = ? WHERE book_id = ?';
                 // Prepare the statement:
                $stmt = $mysqli->prepare($q);
                $book_id = trim($_POST['book_id']);
                // Bind the variables:
                $stmt->bind_param('sssssssssssi', $title, $description,$language,$publication_date,$publisher,$author,$isbn,$image_url,$price,$format,$rating,$book_id);
            }

            // Assign the values to variables:
            $title =trim($_POST['title']);
            $description =trim($_POST['description']);
            $language =trim($_POST['language']);
            $publication_date =trim($_POST['publication_date']);
            $publisher =trim($_POST['publisher']);
            $author =trim($_POST['author']);
            $isbn =trim($_POST['isbn']);
            $image_url =trim($_POST['image_url']);
            $price =trim($_POST['price']);
            $format =trim($_POST['format']);
            $rating =trim($_POST['rating']);
            $book_id = trim($_POST['book_id']);

            // Execute the query:
            $stmt->execute();
            
            // Print a message based upon the result:
            if ($stmt->execute()) {
                $new_id = $mysqli->insert_id;
                $updated_date = $book_id = '';
                $current_date = date("Y-m-d");
                if($_GET["book_id"] == 0){
                    
                    $q = 'INSERT INTO inventory(quantity,updated_date,book_id) VALUES (?,?,?)';
                     // Prepare the statement:
                    $stmt_inv = $mysqli->prepare($q);
                    $stmt_inv->bind_param('isi', $quantity, $updated_date,$book_id);
                
                    $quantity =trim($_POST['quantity']);
                    $updated_date =$current_date;
                    $book_id = $new_id;
                    // Execute the query:
                    $stmt_inv->execute();
                    // Close the statement:
                    $stmt_inv->close();
                    unset($stmt_inv);
                }
//                else{
//                        $q = 'UPDATE inventory SET quantity=?, updated_date=? WHERE book_id=?';
//                        $stmt_inv = $mysqli->prepare($q);
//                        $stmt_inv->bind_param('isi', $quantity, $updated_date,$book_id);
//
//                        $quantity =trim($_POST['quantity']);
//                        $updated_date =$current_date;
//                        $book_id =$bookId;
//                        // Execute the query:
//                        $stmt_inv->execute();
//                        // Close the statement:
//                        $stmt_inv->close();
//                        unset($stmt_inv);
//                }

                // Bind the variables:
               
                header("Location: admin_books.php");
            } else {
                echo '<h3>Failure</h3>';
                echo '<p>' . $mysqli->error . '<br><br>Query: ' . $q . '</p>';
            }

            // Close the statement:
            $stmt->close();
            unset($stmt);

            // Close the connection:
            $mysqli->close();
            unset($mysqli);
           
        }   
?>

<main>
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">Book</span>
      </div>
      <p class="nero__text">
      </p>
    </div>
</main>
<div id="content" >
    <div class="container" >
        <div class="col-md-12" id="cart" >
            <div class="box" >
                <form action="" method="POST">
                    <center>
                        <h1>Book</h1>
                    </center>
                    <div>
                        <div class="form-group" >
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo (isset($title))?$title:'';?>" required>
                            <input type="hidden" class="form-control" name="book_id" value="<?php echo (isset($book_id))?$book_id:'';?>">
                        </div>
                         <div class="form-group" >
                            <label>Description</label>
                             <textarea type="text" class="form-control" name="description" value="<?php echo (isset($description))?$description:'';?>">
                                 <?php echo (isset($description))?$description:'';?>
                             </textarea>
                        </div>
                        <div class="form-group" >
                            <label>Language</label>
                            <input type="text" class="form-control" name="language" value="<?php echo (isset($language))?$language:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Publication Date</label>
                            <input type="text" class="form-control" name="publication_date" value="<?php echo (isset($publication_date))?$publication_date:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Publisher</label>
                            <input type="text" class="form-control" name="publisher" value="<?php echo (isset($publisher))?$publisher:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Author</label>
                            <input type="text" class="form-control" name="author" value="<?php echo (isset($author))?$author:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>ISBN</label>
                            <input type="text" class="form-control" name="isbn"  value="<?php echo (isset($isbn))?$isbn:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Image Url</label>
                            <input type="text" class="form-control" name="image_url"  value="<?php echo (isset($image_url))?$image_url:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="<?php echo (isset($price))?$price:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Format</label>
                            <input type="text" class="form-control" name="format" value="<?php echo (isset($format))?$format:'';?>">
                        </div>
                        <div class="form-group" >
                            <label>Rating</label>
                            <input type="text" class="form-control" name="rating" value="<?php echo (isset($rating))?$rating:'';?>">
                        </div>
                        <?php 
                            $disabled = $_GET["book_id"] != 0 ? "disabled='disabled'" : "";
                        ?>
                         <div class="form-group" >
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" value="<?php echo (isset($quantity))?$quantity:'';?>" <?php echo $disabled; ?> >
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit"  name='order' class="btn btn-danger">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>

