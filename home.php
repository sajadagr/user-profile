<?php
session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
}
require 'db.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Dashboard</title>
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
                            <h4>User Dashboard</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    
                                    $db = new DB();
                                    $result = mysqli_query($db->conn, "select * from tbuser where username='".$_SESSION["username"] . "'");
                                    $row = mysqli_fetch_array($result);
                                    if($row)
                                    {
                                        echo '<h4>Welcome ' . $row["Name"] . "</h4>";
                                    }
                                    ?>
                                    <br/>
                                    <a href="edit_profile.php">Edit Profile</a>
                                    <br/>
                                    <a href="hobbies.php">My Hobbies</a>
                                    <br/>
                                    <a href="search.php">Search</a>
                                    <br/>
                                    <a href="logout.php">Logout</a>
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