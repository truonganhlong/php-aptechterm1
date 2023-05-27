<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/register.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <?php
    if(isset($_POST['submit'])){
        $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);

        $pass = password_hash($password, PASSWORD_BCRYPT);
        $usernamequery = "SELECT * FROM `user` WHERE `user`.`Username` = '$username'";
        $query = mysqli_query($con, $usernamequery);

        $usernamecount = mysqli_num_rows($query);
        if($usernamecount>0){
            ?>
                <script>
                    alert("Username already exists");                    
                </script>
            <?php
        } else {
            $insertquery = "INSERT INTO `user`(Username,Password,Fullname,Email,Phone,Status) VALUES('$username','$pass','$fullname','$email','$phone',1)";
            $iquery = mysqli_query($con, $insertquery);
            if($iquery){
                $selectidquery = "SELECT * FROM `user` WHERE `user`.`Username` = '$username'";
                $query1 = mysqli_query($con, $selectidquery);
                while($row = mysqli_fetch_assoc($query1)){                        
                    $id = $row['UserID'];
                }
                $rolequery = "INSERT INTO `userrole`(UserID,RoleID) VALUES($id,2)";
                mysqli_query($con, $rolequery);
                ?>
                    <script>
                        alert("Register Successful");
                        window.location.href = "login.php";
                    </script>
                <?php
            } else {
                ?>
                    <script>
                        alert("Register Failed");
                        window.location.href = "login.php";
                    </script>
                <?php
            }
        }
    }
    ?>
    <section class="home">
        <div class="wrapper-register">
            <h2>Register New Account</h2>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-person"></i></span>
                    <input type="text" name="fullname" required>
                    <label>Enter your fullname</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="username" required>
                    <label>Enter your username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required>
                    <label>Enter your password</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email">
                    <label>Enter your email</label>
                </div>      
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" name="phone">
                    <label>Enter your phone</label>
                </div>        
                <button type="submit" name="submit" class="btn">Register</button>
            </form>
        </div>   
    </section>
    <?php
    include_once('footer.php');
    ?>
</body>
</html>