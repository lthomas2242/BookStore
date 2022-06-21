<?php
    session_start();
    include("includes/header.php");
    
    $error = false;
        require('./mysqli_oop_connect.php');
        //validate values from form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $first_name= $last_name =  $email = $phone_number = $password  = '';
            $profile_type = 'customer';
        
            if (empty($_POST['first_name'])) {
                echo '<p>Please enter first_name.</p>';
            } else {
                $first_name = $mysqli->real_escape_string(trim($_POST['first_name']));
            }
            if (empty($_POST['last_name'])) {
                echo '<p>Please enter last_name.</p>';
            } else {
                $last_name = $mysqli->real_escape_string(trim($_POST['last_name']));
            }
            if (empty($_POST['email'])) {
                echo '<p>Please enter email.</p>';
            } else {
                $email = $mysqli->real_escape_string(trim($_POST['email']));
            }
            if (empty($_POST['phone_number'])) {
                echo '<p>Please enter phone_number.</p>';
            } else {
                $phone_number = $mysqli->real_escape_string(trim($_POST['phone_number']));
            }

            if (empty($_POST['password'])) {
                echo '<p>Please enter your password</p>';
            } else {
                $password = $mysqli->real_escape_string(trim($_POST['password']));
            }

            // Connect to the database:
            $mysqli = new MySQLi('localhost', 'root', '', 'bookstore');
            $mysqli->set_charset('utf8');

            //Insert query
            $q = 'INSERT INTO users (first_name,last_name,email,phone_number,password,profile_type) VALUES (?, ?,?,?,?,?)';

            // Prepare the statement:
            $stmt = $mysqli->prepare($q);
            // Bind the variables:
            $stmt->bind_param('ssssss', $first_name, $last_name,$email,$phone_number,$password,$profile_type);

            // Assign the values to variables:
            $first_name = $first_name;
            $last_name = $last_name;
            $email = $email;
            $phone_number = $phone_number;
            $password = $password;
            $profile_type = $profile_type;

            // Execute the query:
            $stmt->execute();

            // Print a message based upon the result:
            if ($stmt->affected_rows == 1) {
                $message = "Registered successfully";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Some error occured, please try again";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }

            // Close the statement:
            $stmt->close();
            unset($stmt);

            // Close the connection:
            $mysqli->close();
            unset($mysqli);
        }

?>
<div id="content" >
    <div class="container" >
            <div class="col-md-12" >
                <div class="box" >
                    <div class="box-header" >
                        <center>
                            <h1 style="color:#d9534f">Register</h1>
                        </center>
                    </div>
                    <form action="register.php" method="POST" >
                        <div class="form-group" >
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" required >
                        </div>
                         <div class="form-group" >
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" required >
                        </div>
                        <div class="form-group" >
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" required >
                        </div>
                        <div class="form-group" >
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone_number" required >
                        </div>
                        <div class="form-group" >
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required >
                        </div>
                        <?php
                            if($error){
                                echo '<div class="text-center" >
                                        <p style="color:#d9534f">The email and password is invalid</p>
                                    </div>';
                            }
                        ?>
                        <div class="text-center" >
                            <button type="submit" name="register" value="Register" class="btn btn-danger" >
                                Register
                            </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>