<?php
    // database inclusion
    include('../database/config.php');
    // define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
    // processing form data on submission
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // check if username is empty
        if(empty(trim($_POST['username']))){
            $username_err = "Please enter username.";
        }else{
            $username = trim($_POST['username']);
        }
        // check if password is empty
        if(empty(trim($_POST['password']))){
            $password_err = "Please enter your password";
        }else{
            $password = trim($_POST['password']);
        }
        // validating credentials
        if(empty($username_err) && empty($password_err)){
            // generating a SELECT statement
            $sql = "SELECT username, password FROM users WHERE username = ?";
            if($stmt = $conn->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Store result
                    $stmt->store_result();
                    
                    // Check if username exists, if yes then verify password
                    if($stmt->num_rows == 1){                    
                        // Bind result variables
                        $stmt->bind_result($username, $hashed_password);
                        if($stmt->fetch()){
                            if(password_verify($password, $hashed_password)){
                                /* Password is correct, so start a new session and
                                save the username to the session */
                                // session_start();
                                $_SESSION['username'] = $username;      
                                header("location: index.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = 'The password you entered was not valid.';
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = 'No account found with that username.';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            $stmt->close();
        }
        
        // Close connection
        $conn->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Login | ENA Travels</title>
        <?php include('admin-sections/header.php'); ?>
        <style type="text/css">
            .page{
                background:url(../assets/img/scania3.jpg) no-repeat center fixed;
                -webkit-background-size:cover;
                -moz-background-size:cover;
                -o-background-size:cover;
                background-size:cover;
            }
        </style>
    </head>
    <body>
        <div class="page login-page">
            <div class="container">
                <div class="form-outer text-center d-flex align-items-center">
                    <div class="form-inner">
                        <div class="logo text-uppercase"><strong class="text-primary">Ena Travels Company</strong></div>
                        <form class="text-left form-validate" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                            <div class="form-group-material <?php echo (!empty($username_err)) ? 'has-error': '';?>">
                                <input id="login-username" type="text" name="username" value="<?php echo $username;?>" required data-msg="Please enter your username" class="input-material">
                                <label for="login-username" class="label-material">Username</label>
                                <span class = "help-block" style="color:red;"><?php echo $username_err;?></span>
                            </div>
                            <div class="form-group-material <?php echo (!empty($password_err)) ? 'has-error': '';?>">
                                <input id="login-password" type="password" name="password" value="<?php echo $password;?>" required data-msg="Please enter your password" class="input-material">
                                <label for="login-password" class="label-material">Password</label>
                                <span class = "help-block" style="color:red;"><?php echo $password_err;?></span>
                            </div>
                            <div class="form-group text-center">
                                <input type = "submit" class = "btn btn-primary" value = "Login">
                            </div>
                        </form><a href="#" class="forgot-pass">Forgot Password?</a><small>Do not have an account? </small><a href="register.php" class="signup">Signup</a>
                    </div>
                    <div class="copyrights text-center">
                        <p>Design by <a href="">CodeSoft Technologies</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- JavaScript files-->
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/popper.js/umd/popper.min.js"> </script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
        <script src="../assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
        <script src="../assets/vendor/chart.js/Chart.min.js"></script>
        <script src="../assets/vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- Main File-->
        <script src="../assets/js/front.js"></script>
    </body>
</html>