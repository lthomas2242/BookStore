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
            $fname_err = "Please enter your first name.";
        } else {
            $first_name = $mysqli->real_escape_string(trim($_POST['first_name']));
        }
        if (empty($_POST['last_name'])) {
            $lname_err = "Please enter your last name.";
        } else {
            $last_name = $mysqli->real_escape_string(trim($_POST['last_name']));
        }
        if (empty($_POST['email'])) {
            $email_err = "Please enter your last name.";
        }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
             $email_err = "Invalid email format";
        } 
        else {
            $email = $mysqli->real_escape_string(trim($_POST['email']));
        }
        if (empty($_POST['phone_number'])) {
            $phone_err = "Please enter phone number.";
        }else if(!preg_match("/^[0-9]{3}(-| )[0-9]{3}(-| )[0-9]{4}$/", $_POST['phone_number'])) {
            $phone_err = "In valid phone number. Enter in format 000-0000-0000 or 000 000 0000";
        } 
        else {
            $phone_number = $mysqli->real_escape_string(trim($_POST['phone_number']));
        }

        if (empty($_POST['password'])) {
            $password_err = "Please enter password.";
        } 
        // longer than 6 characters including a special character @ or * or $
        else if(strlen($_POST['password']) < 6 ){
            $password_err = 'Password should be longer than 6 characters.';
        }
        else if(strpbrk(trim($_POST['password']), '@*$') == FALSE){
             $password_err ='Password should contain a special character @ or * or $';
        }
        else {
            $password = $mysqli->real_escape_string(trim($_POST['password']));
        }
        
        if(!isset($fname_err) && !isset($lname_err)&&!isset($email_err) && !isset($phone_err)&&!isset($password_err) ){
            //check user exists
            // Retrieve the user for that username/password combination:
            $q = "SELECT * FROM users WHERE email='$email'";
            $r =  $mysqli->query($q);
            // Check the result
            if ($r->num_rows == 1) {
                $email_err = "This email is already registered";
            } 
            if(!isset($email_err)){
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
                    header("Location: login.php");
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
            
        }
    }

?>
<div id="content" >
    <div class="container" >
            <div class="col-md-12" >
                <div class="box" >
                    <div class="box-header" >
                        <center>
                            <h1 style="color:#cf0909">Register</h1>
                        </center>
                    </div>
                    <form action="" method="POST" >
                        <div class="form-group" >
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name"  value="<?php echo (isset($first_name))?$first_name:'';?>">
                            <span class="error"><?php if (isset($fname_err)) echo $fname_err ?></span>
                        </div>
                         <div class="form-group" >
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo (isset($last_name))?$last_name:'';?>">
                             <span class="error"><?php if (isset($lname_err)) echo $lname_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo (isset($email))?$email:'';?>">
                            <span class="error"><?php if (isset($email_err)) echo $email_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone_number"  value="<?php echo (isset($phone_number))?$phone_number:'';?>">
                            <span class="error"><?php if (isset($phone_err)) echo $phone_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"  value="<?php echo (isset($password))?$password:'';?>">
                            <span class="error"><?php if (isset($password_err)) echo $password_err ?></span>
                        </div>
                        <div class="text-center" >
                            <button type="submit" name="register" value="Register" class="btn btn-ebook" >
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