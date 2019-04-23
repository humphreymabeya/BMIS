<?php
    // database inclusion
    include('../database/config.php');
    // variable declaration
    $username = $email = $password = $confirm_password = '';
    $username_err = $email_err = $password_err = $confirm_password_err = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // validating username
        if(empty(trim($_POST['username']))){
            $username_err = "Please enter a username.";
        }else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = $conn->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // store result
                    $stmt->store_result();
                    
                    if($stmt->num_rows == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            $stmt->close();
        }
        
        // Validate password
        if(empty(trim($_POST['password']))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST['password'])) < 8){
            $password_err = "Password must have atleast 8 characters.";
        } else{
            $password = trim($_POST['password']);
        }
        // Validate Email
        if(empty(trim($_POST['email']))){
            $email_err = "Please Provide a valid Email";
        }else{
            $email = trim($_POST['email']);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = 'Please confirm password.';     
        } else{
            $confirm_password = trim($_POST['confirm_password']);
            if($password != $confirm_password){
                $confirm_password_err = 'Passwords did not match.';
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
             
            if($stmt = $conn->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sss", $param_username, $param_email, $param_password);
                
                // Set parameters
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Redirect to login page
                    // header("location: login.php");
                    echo "<script type=\"text/javascript\">".
                        "alert('User Successfully registered!!');".
                        "location.href='login.php'".
                        "</script>";
                } else{
                    echo "Something went wrong. Please try again later.";
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
        <title> Registration | ENA Travels</title>
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
                            <div class="form-group-material  <?php echo (!empty($username_err)) ? 'has-error': '';?>">
                                <input id="register-username" type="text" name="username" value="<?php echo $username;?>" required data-msg="Please provide a valid username" class="input-material">
                                <label for="register-username" class="label-material">Username</label>
                                <span class="help-block" style="color:red;"><?php echo $username_err;?></span>
                            </div>
                            <div class="form-group-material  <?php echo (!empty($email_err)) ? 'has-error': '';?>">
                                <input id="register-email" type="email" name="email" value="<?php echo $email;?>" required data-msg="Please provide a valid Email Address" class="input-material">
                                <label for="register-email" class="label-material">Email Address      </label>
                                <span class="help-block" style="color:red;"><?php echo $email_err;?></span>
                            </div>
                            <div class="form-group-material  <?php echo (!empty($password_err)) ? 'has-error': '';?>">
                                <input id="register-password" type="password" name="password" value="<?php echo $password;?>" required data-msg="Please provide a valid password" class="input-material">
                                <label for="register-password" class="label-material">Password        </label>
                                <span class="help-block" style="color:red;"><?php echo $password_err;?></span>
                            </div>
                            <div class="form-group-material  <?php echo (!empty($confirm_password_err)) ? 'has-error': '';?>">
                                <input id="confirm-password" type="password" name="confirm_password" value="<?php echo $confirm_password;?>" required data-msg="Please confirm the above password" class="input-material">
                                <label for="confirm-password" class="label-material">Confirm Password        </label>
                                <span class="help-block" style="color:red;"><?php echo $confirm_password_err;?></span>
                            </div>
                            <div class="form-group terms-conditions text-center">
                                <input id="register-agree" name="registerAgree" type="checkbox" required value="1" data-msg="Your agreement is required" class="form-control-custom">
                                <label for="register-agree">I agree with the terms and policy</label>
                            </div>
                            <div class="form-group text-center">
                                <!-- <input id="register" type="submit" value="Register" class="btn btn-primary"> -->
                                <input type = "submit" class = "btn btn-primary" value = "Register">
                                <input type = "reset" class = "btn btn-default" value = "Reset">
                            </div>
                        </form><small>Already have an account? </small><a href="login.php" class="signup">Login</a>
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