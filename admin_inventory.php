<?php
    include("includes/header.php");
    if(!isset($_SESSION['isLoggedIn'])){
        header("Location: logout.php");
    }
?>

<main>
    <div class="nero">
      <div class="nero__heading">
          
        <span class="nero__bold">Inventory</span>
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
                    <h1> Inventory Management </h1>
                    <div class="table-responsive" >
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>Book Id</th>
                                    <th>Title</th>
                                    <th>Quantity</th>
                                    <th>Updated Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // Connect to the db.
                                    require('./mysqli_oop_connect.php'); 
                                    $select_inventory = "select * from inventory";
                                    $run_inventory = $mysqli->query($select_inventory);
                                    $num_inv = $run_inventory->num_rows;
                                    if($num_inv > 0){
                                        while($row_inventory = $run_inventory->fetch_object()){
                                            $book_id = $row_inventory->book_id;
                                            $select_book = "select * from books where book_id='$book_id'";
                                            $run_book = $mysqli->query($select_book);
                                            $num_book = $run_book->num_rows;
                                            if($num_book > 0){
                                                 while($row_books = $run_book->fetch_object()){
                                ?>
                                <tr>
                                     <td>
                                        <label><?php echo $row_books->book_id; ?> </label>
                                    </td>
                                    <td>
                                        <label><?php echo $row_books->title; ?> </label>
                                    </td>
                                    <td >
                                        <label> <?php echo $row_inventory->quantity; ?> </label>
                                    </td>
                                    <td>
                                        <label> <?php echo $row_inventory->updated_date; ?> </label>
                                    </td>
                                </tr>
                                <?php } } } }?>
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