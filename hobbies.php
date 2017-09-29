<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location:login.php");
}

require 'db.php';


if (isset($_POST["submit"])) {
    $db = new DB();

    mysqli_query($db->conn, "insert into tbhobby(Username,Hobby) values('" . $_SESSION["username"] . "','" . $_POST["hobby"] . "')");

    if (mysqli_affected_rows($db->conn) > 0) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Success","Hobby added successfully.","success");';
        echo '}, 1000);</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Error","Error occured. Please try again...","error");';
        echo '}, 1000);</script>';
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>My Hobbies</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
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
                            <h4>My Hobbies</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="home.php">Home</a>
                                    |
                                    <a href="logout.php">Logout</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    $db = new DB();
                                    $result = mysqli_query($db->conn, "select * from tbhobby where username='" . $_SESSION["username"] . "'");
                                    echo '<ul>';
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<li>' . $row["Hobby"] . '</li>';
                                    }
                                    echo '</ul>';
                                    ?>
                                    <br/>
                                    <h4>Add New Hobby</h4>
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label for="hobby">Hobby : </label>
                                            <input type="text" name="hobby"
                                                   class="form-control"/>
                                        </div>
                                        <input type="submit" name="submit"
                                               class="btn btn-lg btn-block btn-primary"
                                               value="ADD HOBBY"/>
                                    </form>
                                </div>
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