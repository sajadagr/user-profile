<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location:login.php");
}

require 'db.php';

if (isset($_POST["submit"])) {


    if ($_FILES["profilePicture"]["name"] !== "") {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check !== false) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Error","File is an image - ' . $check["mime"] . '.","error");';
            echo '}, 1000);</script>';
            $uploadOk = 1;
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Error","File is not an image.","error");';
            echo '}, 1000);</script>';
            $uploadOk = 0;
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["profilePicture"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
                $db = new DB();
                $name = $_POST["name"];
                $email = $_POST["email"];
                $mobile = $_POST["mobile"];
                $about = $_POST["about"];
                $dob = DateTime::createFromFormat("m/d/Y", $_POST["dob"]);
                $dob = $dob->format("Y-m-d");
                $martialStatus = $_POST["martialStatus"];
                $imagepath = $target_dir . basename($target_file);
                
                mysqli_query($db->conn, "update tbuser set Name='$name',Email='$email',Mobile='$mobile',About='$about',DOB='$dob',MartialStatus='$martialStatus',ImagePath='$imagepath' where username='" . $_SESSION["username"] . "'");
                if (mysqli_affected_rows($db->conn) > 0) {
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("Success","Profile Updated successfully.","success");';
                    echo '}, 1000);</script>';
                } else {
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("Error","Error occured. Please change value(s) and try again...","error");';
                    echo '}, 1000);</script>';
                }
            } else {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Error","Error occured. Image was not uploaded. Please try again...","error");';
                echo '}, 1000);</script>';
            }
        }
    } else {
        $db = new DB();
                $name = $_POST["name"];
                $email = $_POST["email"];
                $mobile = $_POST["mobile"];
                $about = $_POST["about"];
                $dob = DateTime::createFromFormat("m/d/Y", $_POST["dob"]);
                $dob = $dob->format("Y-m-d");
                $martialStatus = $_POST["martialStatus"];
                
                mysqli_query($db->conn, "update tbuser set Name='$name',Email='$email',Mobile='$mobile',About='$about',DOB='$dob',MartialStatus='$martialStatus' where username='" . $_SESSION["username"] . "'");
        if (mysqli_affected_rows($db->conn) > 0) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success","Profile Updated successfully.","success");';
            echo '}, 1000);</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Error","Error occured. Please change value(s) and try again...","error");';
            echo '}, 1000);</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/sweetalert.css" rel="stylesheet" type="text/css"/>
        <script src="js/sweetalert.min.js" type="text/javascript"></script>
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
        <?php
        $db = new DB();
        $result = mysqli_query($db->conn, "select * from tbuser where username='" . $_SESSION["username"] . "'");
        $row = mysqli_fetch_array($result);
        ?>
        <!--Container starts-->
        <div class="container">
            <!--Row starts-->
            <div class="row">
                <!--Column starts-->
                <div class="col-md-12" style="margin-top: 20px">
                    <!--Add a bootstrap panel-->
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <h4>Edit Profile</h4>
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
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <!-- form group. wrap label and textbox-->
                                        <div class="form-group">
                                            <label for="txtName">Name : </label>
                                            <input type="text" required name="name" id="txtName"
                                                   class="form-control" value="<?php echo $row["Name"]; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtEmail">Email : </label>
                                            <input type="email" required name="email" id="txtEmail"
                                                   class="form-control" value="<?php echo $row["Email"]; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtMobile">Mobile : </label>
                                            <input type="tel" required name="mobile" id="txtMobile"
                                                   class="form-control" value="<?php echo $row["Mobile"]; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtAbout">About Me (Bio) : </label>
                                            <textarea required name="about" id="txtAbout"
                                                      class="form-control" style="height:100px"><?php echo $row["About"]; ?></textarea>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dob">Date Of Birth : </label>
                                            <?php
                                            $date = DateTime::createFromFormat('Y-m-d', $row["DOB"]);
                                            ?>
                                            <input type="text" required name="dob" id="txtDOB"
                                                   class="form-control" readonly="true" value="<?php echo $date->format("m/d/Y"); ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtDOB">Martial Status : </label>
                                            <br/>
                                            <select name="martialStatus" class="form-control">
                                                <option value="Single" <?php echo $row["MartialStatus"] === "Single" ? 'selected="true"' : ''; ?>>Single</option>
                                                <option value="Married" <?php echo $row["MartialStatus"] === "Married" ? 'selected="true"' : ''; ?>>Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="profilePicture">Profile Picture : </label>
                                            <?php
                                            if ($row["ImagePath"] !== "") {
                                                echo '<img src="' . $row["ImagePath"] . '" height="100"/>';
                                            }
                                            ?>
                                            <input type="file" name="profilePicture"
                                                   class="form-control"/>
                                            <br/>
                                            <input type="submit" class="btn btn-lg btn-block btn-primary"
                                                   name="submit" value="UPDATE PROFILE"/>
                                        </div>
                                    </div>
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