<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Account</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <section class="account">
        <?php
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
        } else {
            echo '<script>';
            echo "alert('You must login first!');";
            echo "window.location.href = 'login.php';";
            echo '</script>';
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
            $dc_pass = password_hash($password, PASSWORD_BCRYPT);
            $password_query = "Password = '$dc_pass'";
        } else {
            $password = null;
            $password_query = null;
        }
        if(isset($_POST['cpassword'])){
            $cpassword = $_POST['cpassword'];
        } else {
            $cpassword = null;
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        } else {
            $email = null;
        }
        if(isset($_POST['phone'])){
            $phone = $_POST['phone'];
        } else {
            $phone = null;
        }
        if(isset($_POST['submit'])){
            if($_POST['password'] != $_POST['cpassword']){
                echo "<script>";
                echo "alert('Password and Confirm password must be the same! Check again');";                
                echo "</script>";
            } 
            else if ($password == null && $email == null) {
                mysqli_query($con,"UPDATE `user` SET Phone = '$phone' WHERE `user`.`UserID` = $userid");
            } 
            else if ($password == null && $phone == null) {
                mysqli_query($con,"UPDATE `user` SET Email = '$email' WHERE `user`.`UserID` = $userid");
            }
            else if ($password == null && $phone != null && $email != null) {
                mysqli_query($con,"UPDATE `user` SET Email = '$email', Phone = '$phone' WHERE `user`.`UserID` = $userid");
            }
            else if($password != null && $email == null && $phone == null){
                mysqli_query($con,"UPDATE `user` SET $password_query WHERE `user`.`UserID` = $userid");
            }
            else if($password != null && $email != null){
                mysqli_query($con,"UPDATE `user` SET $password_query, Email = '$email' WHERE `user`.`UserID` = $userid");
            }
            else if($password != null && $phone != null){
                mysqli_query($con,"UPDATE `user` SET $password_query, Phone = '$phone' WHERE `user`.`UserID` = $userid");
            } 
            else if($password != null && $email != null && $phone != null){
                mysqli_query($con,"UPDATE `user` SET $password_query, Email = '$email', Phone = '$phone' WHERE `user`.`UserID` = $userid");
            }        
        }        
        ?>
        <div class="containers">
            <div class="account-top">
                <h1>YOUR ACCOUNT</h1>
            </div>
        </div>
        <div class="containers">
            <div class="form">
                <form id="form-profile" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <?php                                        
                    $resource = mysqli_query($con,"SELECT * FROM `user` WHERE `user`.`UserID` = $userid");           
                    while($row = mysqli_fetch_assoc($resource)){                                                 
                    $username = $row['Username']; 
                    $password = $row['Password'];
                    $fullname = $row['Fullname'];
                    $email = $row['Email'];
                    $phone = $row['Phone'];          
                    echo "<label for=\"username\">Username</label>";
                    echo "<p id=\"username\">$username</p>";
                    echo "<label for=\"password\">Password</label>";
                    echo "<input type=\"password\" name=\"password\" id=\"password\">";
                    echo "<label for=\"cpassword\">Confirm Password</label>";
                    echo "<input type=\"password\" name=\"cpassword\" id=\"cpassword\">";
                    echo "<label for=\"fullname\">Fullname</label>";
                    echo "<p id=\"fullname\">$fullname</p>";
                    echo "<label for=\"email\">Email</label>";
                    echo "<input type=\"email\" name=\"email\" id=\"email\" placeholder=\"$email\">";
                    echo "<label for=\"phone\">Phone</label>";
                    echo "<input type=\"text\" name=\"phone\" id=\"phone\" placeholder=\"$phone\">";                                          
                    }                       
                    ?>                    
                    <button type="submit" name="submit" onclick="return confirm('Are you sure to update?')">Update</button>
                </form>
            </div>  
            <div class="advertise">
                <p><i class="fa-solid fa-truck"></i> Free Shipping and Returns</p>
                <p><i class="fa-solid fa-tag"></i> Prescription Lenses Included, Always.</p>
                <p><i class="fa-solid fa-circle-dollar-to-slot"></i> Save up to $220 Using Vision Insurance</p>
                <p><i class="fa-solid fa-circle-dollar-to-slot"></i> VSP Member Perk: 20% Off Eyewear</p>
            </div>          
        </div>
    </section>
    <?php 
    include_once('footer.php');
    ?>
</body>
</html>