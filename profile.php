<?php
    session_start();
    include("includes/header.php");
    
    $error = false;
    require('./mysqli_oop_connect.php');
    //validate values from form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $password = '';
        // Check for a username
        if (empty($_POST['email'])) {
            $email_err = "Please enter your email.";
        } else {
            $email = $mysqli->real_escape_string(trim($_POST['email']));
        }

        // Check for a password
        if (empty($_POST['password'])) {
            $password_err = "Please enter your password.";
        } else {
            $password = $mysqli->real_escape_string(trim($_POST['password']));
        }

        
        if(!isset($email_err) && !isset($password_err)){
            // Retrieve the user for that username/password combination:
            $q = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $r =  $mysqli->query($q);
            // Check the result
            if ($r->num_rows == 1) {
                session_start(); // Start the session.
                //set session variable
                $_SESSION["isLoggedIn"] = true;
                while ($row = $r->fetch_object()) {
                    $_SESSION["user_id"] = $row->user_id;
                    $_SESSION["first_name"] = strtoupper($row->first_name);
                }

                // Redirect the user:
                header("Location: index.php");

            } else {
                $error = true;
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
                            <h1 style="color:#cf0909">Profile</h1>
                        </center>
                    </div>
                    <form action="" method="POST" >
                        <div class="form-group" >
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo (isset($email))?$email:'';?>">
                            <span class="error"><?php if (isset($email_err)) echo $email_err ?></span>
                        </div>
                        <div class="form-group" >
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" >
                            <span class="error"><?php if (isset($password_err)) echo $password_err ?></span>
                        </div>
                        <?php
                            if($error==true){
                                echo '<div class="text-center" >
                                        <p style="color:#cf0909">The email and password is invalid</p>
                                    </div>';
                            }
                        ?>
                        <div class="text-center" >
                            <button name="login" value="Login" class="btn btn-ebook" >
                                Log in
                            </button>
                        </div>
                    </form>
                    <center>
                        <a href="register.php" style="color:#cf0909">
                            <h3>New ? Register Here</h3>
                        </a>
                    </center>
                </div>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>