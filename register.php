<?php
require 'db.php';

//function to register by inserting record in database
function register() {
    //check if user clicked on register button. If yes then we save the record in database.
    if (isset($_POST["submit"])) {
        //get form values.
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $db = new DB();

        //check if username is available.
        $result = mysqli_query($db->conn, "select * from tbuser where username='$username'");
        if (mysqli_num_rows($result) > 0) {
            //show sweetalert popup through sweetalert popup.
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Error","Username not available.","error");';
            echo '}, 1000);</script>';
            return;
        }
        
        //register user by inserting record in database.
        mysqli_query($db->conn, "insert into tbuser(Name,Email,Mobile,Username,Pass) values('$name','$email','$mobile','$username','$password')");
        if(mysqli_affected_rows($db->conn) > 0){
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success","Registration done successfully","success");';
            echo '}, 1000);</script>';
        }
    }
}

register();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Registration Page</title>
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
                            <h4>New User Registration</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form method="post" action="">
                                    <div class="col-md-12">
                                        <!-- form group. wrap label and textbox-->
                                        <div class="form-group">
                                            <label for="txtName">Name : </label>
                                            <input type="text" required name="name" id="txtName"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtEmail">Email : </label>
                                            <input type="email" required name="email" id="txtEmail"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtMobile">Mobile : </label>
                                            <input type="tel" required name="mobile" id="txtMobile"
                                                   class="form-control"/>
                                        </div>
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
                                               value="REGISTER"/ style="border-radius: 0px">
                                    </div>
                                    <p style="margin-left: 15px;">
                                     Already a member? <a href="Login.php">Sign in</a>
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