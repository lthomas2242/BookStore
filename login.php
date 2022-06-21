<?php
    session_start();
    include("includes/header.php");
    
    $error = false;
    function login(){
        require('./mysqli_oop_connect.php');
        //validate values from form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $password = '';
            // Check for a username
            if (empty($_POST['email'])) {
                 echo "<p>Please enter your email.</p>";
            } else {
                $email = $mysqli->real_escape_string(trim($_POST['email']));
            }

            // Check for a password
            if (empty($_POST['password'])) {
                echo "<p>Please enter your password.</p>";
            } else {
                $password = $mysqli->real_escape_string(trim($_POST['password']));
            }

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
                }

                // Redirect the user:
                header("Location: index.php");

            } else {
                $error = true;
//                $message = "Scripts are not accepted as comment, Saved after filtering the script tag";
//            echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }
    if(array_key_exists('login', $_POST)) {
        login();
    }
            
?>
<div id="content" >
    <div class="container" >
            <div class="col-md-12" >
                <div class="box" >
                    <div class="box-header" >
                        <center>
                            <h1 style="color:#d9534f">Login</h1>
                            <p class="lead" style="color:#d9534f">Already our Customer?</p>
                        </center>
                    </div>
                    <form action="login.php" method="POST" >
                        <div class="form-group" >
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" required >
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
                            <button name="login" value="Login" class="btn btn-danger" >
                                Log in
                            </button>
                        </div>
                    </form>
                    <center>
                        <a href="register.php" style="color:#d9534f">
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