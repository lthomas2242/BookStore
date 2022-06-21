<?php
    include("includes/header.php");
    $book_id='';
    $total = 0;
    $count = 0;
    $num = 0;
    // If the id is set
    if (isset($_SESSION['book_id']) && ($_SESSION['book_id'])) {
        $book_id = $_SESSION['book_id'];
         // Connect to the db.
         require('./mysqli_oop_connect.php'); 
         $select_book = "select * from books where book_id='$book_id'";
         $run_book = $mysqli->query($select_book);
         $count = $run_book->num_rows;
         $num = $run_book->num_rows;
    }
    function goToCheckout($amount){
        header("Location: checkout.php?amount=$amount");
    }
    if(array_key_exists('checkout', $_POST)) {
        goToCheckout($mysqli->real_escape_string(trim($_POST['total'])));
    }
?>

<main>
    <div class="nero">
      <div class="nero__heading">
          
        <span class="nero__bold">SHOP</span> Cart
      </div>
      <p class="nero__text">
      </p>
    </div>
</main>
<div id="content" >
    <div class="container" >
        <div class="col-md-12" id="cart" >
            <div class="box" >
                <form action="cart.php" method="post" enctype="multipart-form-data" >
                    <h1> Shopping Cart </h1>
                    <p class="text-muted" > You currently have <?php echo $count; ?> item(s) in your cart. </p>
                    <?php 
                        if($num > 0) { ?>
                            <div class="table-responsive" >
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th >Book</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th colspan="1">Delete</th>
                                            <th colspan="2"> Sub Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row_books = $run_book->fetch_object()){
                                                    $id = $row_books->book_id;
                                                    $price = $row_books->price;
                                                    $title = $row_books->title;
                                                    $quantity = 1;
                                                    $sub_total = $price*$quantity;
                                                    $total += $sub_total;

                                        ?>
                                        <tr>
                                            <td>
                                                <label> <?php echo $title; ?> </label>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity" value="<?php echo $quantity; ?>" data-product_id="<?php echo $id; ?>" class="quantity form-control">
                                            </td>
                                            <td>
                                                $<?php echo $price; ?>.00
                                            </td>
                                            <td>
                                                <input type="checkbox" name="remove[]" value="<?php echo $id; ?>">
                                            </td>
                                            <td>
                                                $<?php echo $sub_total; ?>.00
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5"> Total </th>
                                            <th colspan="2"> $<?php echo $total; ?>.00 </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    <?php }  ?>

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="books.php" class="btn btn-default">
                                <i class="fa fa-chevron-left"></i> Continue Shopping
                            </a>
                        </div>
                        <input type='hidden' name='total' value="<?php echo $total; ?>">
                        <?php
                        if($num > 0){?>
                            <div class="pull-right">
                                <button type="submit"  name='checkout' class="btn btn-danger">
                                    Proceed to Checkout
                                </button>
                            </div>
                            <?php }  ?>
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
