<?php
require 'db.php';

//function to register by inserting record in database
function login() {
    //check if user clicked on register button. If yes then we save the record in database.
    if (isset($_POST["submit"])) {
        //get form values.
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $db = new DB();

        //check if username and password are correct.
        $result = mysqli_query($db->conn, "select * from tbuser where username='$username' and pass='$password'");
        if (mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION["username"] = $username;
            header("location:home.php");
        } else {
            //show sweetalert popup through sweetalert popup.
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Error","Invalid Username / Password.","error");';
            echo '}, 1000);</script>';
            return;
        }
        
    }
}

login();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/sweetalert.css" rel="stylesheet" type="text/css"/>
        <script src="js/sweetalert.min.js" type="text/javascript"></script>
    </head>
    <body>
        <!--Container starts-->
        <div class="container">
            <!--Row starts-->
            <div class="row">
                <!--Column starts-->
                <div class="col-md-6" style="float:none;margin:auto;margin-top: 20px">
                    <!--Add a bootstrap panel-->
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <h4>Existing User Login</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form method="post" action="">
                                    <div class="col-md-12">
                                        <!-- form group. wrap label and textbox-->
                                        <div class="form-group">
                                            <label for="txtUsername">Username : </label>
                                            <input type="text" name="username" id="txtUsername"
                                                   required class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtPassword">Password : </label>
                                            <input type="password" required name="password" 
                                                   id="txtPassword"
                                                   class="form-control"/>
                                        </div>
                                        <input name="submit" type="submit" class="btn btn-block btn-lg btn-primary"
                                               value="LOGIN" style="border-radius: 0px" />
                                    </div>
                                    <br>
                                    <p style="margin-left: 15px;">
                                     Not yet a member? <a href="register.php">Sign up</a>
                                    </p>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Column ends-->
            </div>
            <!--Row Ends-->
        </div>
        <!--Container ends-->
    </body>
</html>