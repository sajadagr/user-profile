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
        <title>Search Users</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            $(function () {
                $("#txtDOB").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            });
        </script>
    </head>
    <body>
        <!--Container starts-->
        <div class="container">
            <!--Row starts-->
            <div class="row">
                <!--Column starts-->
                <div class="col-md-12" style="float:none;margin:auto;margin-top: 20px">
                    <!--Add a bootstrap panel-->
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <h4>Search Users</h4>
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
                                <div class="col-md-4">
                                    <form method="post" action="">
                                        <input type="text" name="name" placeholder="Name"
                                               class="form-control" style="display: inline;float: none;width:200px"/>
                                        <input type="submit" name="nameSubmit" 
                                               style="display: inline;float: none"
                                               value="SEARCH" class="btn btn-primary"/>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form method="post" action="">
                                        <input type="text" name="dob" placeholder="Date Of Birth"
                                               id="txtDOB"
                                               class="form-control" style="display: inline;float: none;width:200px"/>
                                        <input type="submit" name="dobSubmit" 
                                               style="display: inline;float: none"
                                               value="SEARCH" class="btn btn-primary"/>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form method="post" action="">
                                        <input type="text" name="hobby" placeholder="Hobby"
                                               class="form-control" style="display: inline;float: none;width:200px"/>
                                        <input type="submit" name="hobbySubmit" 
                                               style="display: inline;float: none"
                                               value="SEARCH" class="btn btn-primary"/>
                                    </form>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 20px">
                                    <?php
                                    if(isset($_POST["nameSubmit"])){
                                        $db = new DB();
                                        $name = $_POST["name"];
                                        $result = mysqli_query($db->conn, "select * from tbuser where Name like '%$name%'");
                                        echo '<table class="table table-responsive table-bordered">';
                                        echo '<tr>';
                                        echo '<th>Name</th>';
                                        echo '<th>Email</th>';
                                        echo '<th>Mobile</th>';
                                        echo '<th>Bio</th>';
                                        echo '<th>Date Of Birth</th>';
                                        echo '<th>Martial Status</th>';
                                        echo '</tr>';
                                        while ($row = mysqli_fetch_array($result)){
                                            echo '<tr>';
                                            echo '<td>' . $row["Name"] . '</td>';
                                            echo '<td>' . $row["Email"] . '</td>';
                                            echo '<td>' . $row["Mobile"] . '</td>';
                                            echo '<td>' . $row["About"] . '</td>';
                                            $dob = DateTime::createFromFormat("Y-m-d", $row["DOB"]);
                                            echo '<td>' . $dob->format("m/d/Y") . '</td>';
                                            echo '<td>' . $row["MartialStatus"] . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    }
                                    
                                    
                                    ?>
                                    
                                    
                                    <?php
                                    if(isset($_POST["dobSubmit"])){
                                        $db = new DB();
                                        $dob = DateTime::createFromFormat("m/d/Y", $_POST["dob"]);
                                        $dob = $dob->format("Y-m-d");
                                        $result = mysqli_query($db->conn, "select * from tbuser where DOB='$dob'");
                                        echo '<table class="table table-responsive table-bordered">';
                                        echo '<tr>';
                                        echo '<th>Name</th>';
                                        echo '<th>Email</th>';
                                        echo '<th>Mobile</th>';
                                        echo '<th>Bio</th>';
                                        echo '<th>Date Of Birth</th>';
                                        echo '<th>Martial Status</th>';
                                        echo '</tr>';
                                        while ($row = mysqli_fetch_array($result)){
                                            echo '<tr>';
                                            echo '<td>' . $row["Name"] . '</td>';
                                            echo '<td>' . $row["Email"] . '</td>';
                                            echo '<td>' . $row["Mobile"] . '</td>';
                                            echo '<td>' . $row["About"] . '</td>';
                                            $dob = DateTime::createFromFormat("Y-m-d", $row["DOB"]);
                                            echo '<td>' . $dob->format("m/d/Y") . '</td>';
                                            echo '<td>' . $row["MartialStatus"] . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    }
                                    
                                    
                                    ?>
                                    
                                    <?php
                                    if(isset($_POST["hobbySubmit"])){
                                        $db = new DB();
                                        $hobby = $_POST["hobby"];
                                        $result = mysqli_query($db->conn, "select * from tbuser join tbhobby on tbuser.username=tbhobby.username where tbhobby.hobby like '%$hobby%'");
                                        echo '<table class="table table-responsive table-bordered">';
                                        echo '<tr>';
                                        echo '<th>Name</th>';
                                        echo '<th>Email</th>';
                                        echo '<th>Mobile</th>';
                                        echo '<th>Bio</th>';
                                        echo '<th>Date Of Birth</th>';
                                        echo '<th>Martial Status</th>';
                                        echo '</tr>';
                                        while ($row = mysqli_fetch_array($result)){
                                            echo '<tr>';
                                            echo '<td>' . $row["Name"] . '</td>';
                                            echo '<td>' . $row["Email"] . '</td>';
                                            echo '<td>' . $row["Mobile"] . '</td>';
                                            echo '<td>' . $row["About"] . '</td>';
                                            $dob = DateTime::createFromFormat("Y-m-d", $row["DOB"]);
                                            echo '<td>' . $dob->format("m/d/Y") . '</td>';
                                            echo '<td>' . $row["MartialStatus"] . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    }
                                    
                                    
                                    ?>
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