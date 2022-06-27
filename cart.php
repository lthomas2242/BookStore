<?php
    include("includes/header.php");
    if(!isset($_SESSION['isLoggedIn'])){
        header("Location: logout.php");
    }
    
    $book_id='';
    $total = 0;
    $count = 0;
    $num = 0;
    $book_array = array();
    // If the id is set
    if (isset($_SESSION["book_array"])) {
        $count = count($_SESSION["book_array"]);    
        $book_array = $_SESSION["book_array"];
    }
    
    function goToCheckout($amount){
        header("Location: checkout.php?amount=$amount");
    }
    if(array_key_exists('checkout', $_POST)) {
        goToCheckout(trim($_POST['total']));
    }

    if(array_key_exists('delete', $_POST)) {
        removeFromSession($_POST['removeid']);
    }

    function removeFromSession($id){
        unset($_SESSION["book_array"][$id]); 
        $count = count($_SESSION["book_array"]);  
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
                <form action="" method="post">
                    <h1> Shopping Cart </h1>
                     <p class="text-muted" > You currently have <?php echo $count; ?> item(s) in your cart. </p>
                    <?php 
                        if($count > 0) { ?>
                            <div class="table-responsive" >
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th >Book</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th> Sub Total </th>
                                            <th>Delete</th>
                                            <th colspan="3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            // Connect to the db.
                                            require('./mysqli_oop_connect.php'); 
                                            if(isset($_SESSION["book_array"]) && count($_SESSION["book_array"]) >0){
                                                foreach($_SESSION["book_array"] as $book_id => $quantity) {
//                                                    $count += 1;
                                                    $select_book = "select * from books where book_id='$book_id'";
                                                    $run_book = $mysqli->query($select_book);
                                                    $count = $run_book->num_rows;
                                                    $num = $run_book->num_rows;
                                                    while($row_books = $run_book->fetch_object()){
                                                            $id = $row_books->book_id;
                                                            $price = $row_books->price;
                                                            $title = $row_books->title;
                                                            $sub_total = $price*$quantity;
                                                            $total += $sub_total;

                                        ?>
                                        <tr>
                                            <td>
                                                <label> <?php echo $title; ?> </label>
                                            </td>
                                            <td >
                                                <label> <?php echo $quantity; ?> </label>
<!--                                                <input type="text" name="quantity" value="<?php echo $quantity; ?>" data-product_id="<?php echo $id; ?>" class="quantity form-control">-->
                                            </td>
                                            <td>
                                                $<?php echo $price; ?>.00
                                            </td>
                                            
                                            <td>
                                                $<?php echo $sub_total; ?>.00
                                            </td>
                                            <td id="delete">
                                                <button name="delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                
                                                <input  type='hidden' name="removeid" value="<?php echo $book_id; ?>">
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <?php } } }?>
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
                        if( $count > 0){?>
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