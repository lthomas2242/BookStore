<?php
    include("includes/header.php");
    require('./mysqli_oop_connect.php'); 

    $total = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $total = $_GET["amount"];
    }
     $book_id='';
     $user_id='';
     if (isset($_SESSION['book_id'])) {
        $book_id = $_SESSION['book_id'];
     }
     if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
     }

//     $fname_err = $lname_err = $addr_err = $city_err = $zip_err = $c_num_err = $cvv_err = $expiry_err = '';
     $first_name = $last_name = $address_line = $city = $zipcode = $card_number = $cvv = $expiry = '';
     //get logged in user's details from users table
     $get_user = "select * from users where user_id='$user_id'";
     $run_user = $mysqli->query($get_user);
     while ($row = $run_user->fetch_object()) {
        $first_name =  $row->first_name;
        $last_name =  $row->last_name;
        $address_line =  $row->address;
        $city =  $row->city;
        $zipcode =  $row->zipcode;
     }
//    if(array_key_exists('order', $_POST)) {
//        placeOrder();
//    }

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         placeOrder();
        }
     
    function placeOrder(){
        $isValidated = formValidation();
        if($isValidated){
            // Connect to the database:
            $mysqli = new MySQLi('localhost', 'root', '', 'bookstore');
            $mysqli->set_charset('utf8');

            //Insert query
            $q = 'INSERT INTO orders (order_date,quantity,status,user_id,book_id) VALUES (?, ?,?,?,?)';

            // Prepare the statement:
            $stmt = $mysqli->prepare($q);

            $order_date = $quantity=$status=$user_id=$book_id='';
            // Bind the variables:
            $stmt->bind_param('sisii', $order_date, $quantity,$status,$user_id,$book_id);

            // Assign the values to variables:
            $order_date = date("Y-m-d");
            $quantity = $_SESSION['quantity'];
            $status = "completed";
            $user_id = $_SESSION['user_id'];
            $book_id = $_SESSION['book_id'];
            
            // Execute the query:
            $stmt->execute();

            // Print a message based upon the result:
            if ($stmt->affected_rows == 1) {
                
                $quantity_from_db = 0;
                $get_quantity = "select quantity from inventory where book_id='$book_id'";
                $run = $mysqli->query($get_quantity);
                 while ($row = $run->fetch_object()) {
                     $quantity_from_db = $row->quantity;
                 }
                $quantity_to_save = $quantity_from_db - $quantity;
                $current_date = date("Y-m-d");
                $update_query = "UPDATE inventory SET quantity='$quantity_to_save',updated_date='$current_date' WHERE book_id=$book_id";
                $run_update = $mysqli->query($update_query);
                unset($_SESSION['book_id']);
                unset($_SESSION['quantity']);
                header("Location: complete.php");
//                echo '<h3>Success</h3>';
            } else {
//                echo '<h3>Failure</h3>';
//                echo '<p>' . $mysqli->error . '<br><br>Query: ' . $q . '</p>';
            }

            // Close the statement:
            $stmt->close();
            unset($stmt);

            // Close the connection:
            $mysqli->close();
            unset($mysqli);
        }else{
//            echo '<h3>validation failed</h3>';
        }
    }

    function formValidation(){
        $isValidated = true;
        
        if (empty($_POST['first_name'])) {
            $fname_err = "Please enter your first name";
            $isValidated = false;
            
        } else {
            $first_name = trim($_POST['first_name']);
        }
        if (empty($_POST['last_name'])) {
             $lname_err = "Please enter your last name";
            $isValidated = false;
        } else {
            $last_name = trim($_POST['last_name']);
        }
        if (empty($_POST['address_line'])) {
            $addr_err = "Please enter your address";
            $isValidated = false;
        } else {
            $address_line = trim($_POST['address_line']);
        }
        if (empty($_POST['city'])) {
            $city_err = "Please enter the city";
            $isValidated = false;
        } else {
            $city = trim($_POST['city']);
        }
        if (empty($_POST['zipcode'])) {
            $zip_err = "Please enter the zipcode";
            $isValidated = false;
        } else {
            $zipcode = trim($_POST['zipcode']);
        }
        if (empty($_POST['card_number'])) {
            $c_num_err = "Please enter your card number";
            $isValidated = false;
        }
//        else if(strlen($_POST['card_number']) < 16){
//            $c_num_err = "Invalid card number";
//            $isValidated = false;
//        }
//        else if(preg_match("/^[0-9]$/",$_POST['card_number'])){
//            $c_num_err = "Card number should contain only numbers";
//            $isValidated = false;
//        }
        else {
            $card_number = trim($_POST['card_number']);
        }
         
        if (empty($_POST['cvv'])) {
            $cvv_err = "Please enter cvv";
            $isValidated = false;
        }
//        else if(strlen($_POST['cvv']) <= 0 || strlen($_POST['cvv']) > 3){
//            $cvv_err = "Invalid cvv";
//            $isValidated = false;
//        }
//        else if(preg_match("/^[0-9]{3,4}$/",$_POST['cvv'])){
//            $cvv_err = "Cvv should contain only numbers";
//            $isValidated = false;
//        }
        else{
            $cvv = trim($_POST['cvv']);
        }
        
        if(empty($_POST['expiry'])) {
            $expiry_err = "Please enter expiry";
            $isValidated = false;
        }
//        else if(preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/",$_POST['expiry'])){
//            $expiry_err = "Invalid Expiry format";
//            $isValidated = false;
//        } 
        else {
            $expiry = trim($_POST['expiry']);
        }
        return $isValidated;
    }
   
?>

<main>
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">Checkout</span>
      </div>
      <p class="nero__text">
      </p>
    </div>
</main>
<div id="content" >
    <div class="container" >
        <div class="col-md-9" id="cart" >
            <div class="box" >
                <form action="checkout.php" method="POST">
                    <center>
                        <h1>Checkout</h1>
                    </center>
                    <div>
                        <div class="form-group" >
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo (isset($first_name))?$first_name:'';?>" required>
                            <span class="error"><?php if (isset($fname_err)) echo $fname_err ?></span>
                        </div>
                         <div class="form-group" >
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo (isset($last_name))?$last_name:'';?>" required>
                            <span class="error"><?php if (isset($lname_err)) echo $lname_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>Address line</label>
                            <input type="text" class="form-control" name="address_line" value="<?php echo (isset($address_line))?$address_line:'';?>" required>
                            <span class="error"><?php if (isset($addr_err)) echo $addr_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo (isset($city))?$city:'';?>">
                            <span class="error"><?php if (isset($city_err)) echo $city_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>Zipcode</label>
                            <input type="text" class="form-control" name="zipcode" value="<?php echo (isset($zipcode))?$zipcode:'';?>" required>
                            <span class="error"><?php if (isset($zip_err)) echo $zip_err ?></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="form-group" >
                            <label>CardNumber</label>
                            <input type="text" class="form-control" name="card_number" required>
                            <span class="error"><?php if (isset($c_num_err)) echo $c_num_err ?></span>
                        </div>
                        <div class="form-group" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Cvv</label>
                                    <input type="text" class="form-control" name="cvv" required>
                                    <span class="error"><?php if (isset($cvv_err)) echo $cvv_err ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Expiry</label>
                                    <input type="text" class="form-control" name="expiry" required>
                                    <span class="error"><?php if (isset($expiry_err)) echo $expiry_err ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button  name='order' class="btn btn-danger">
                                Place Your Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box" id="order-summary">
                <div class="box-header">
                    <h3>Order Summary</h3>
                </div>
                <p class="text-muted">
                    Shipping and additional costs are added.
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td> Subtotal </td>
                            <th> $<?php echo $total; ?>.00 </th>
                        </tr>
                        <tr>
                            <td> Shipping </td>
                            <th>$10.00</th>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <th>$10.00</th>
                        </tr>
                        <tr class="total">
                            <td>Total</td>
                            <th>$<?php echo $total; ?>.00</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>

