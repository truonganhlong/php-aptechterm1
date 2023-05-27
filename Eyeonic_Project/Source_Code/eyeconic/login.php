<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <?php
    include_once('header.php')
    ?>
    <?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = mysqli_query($con,"SELECT * FROM `user` WHERE `user`.`Username` = '$username'");
        $username_count = mysqli_num_rows($query);
        if($username_count){
            while($row = mysqli_fetch_assoc($query)){
                $db_pass = $row['Password'];
                $_SESSION['userid'] = $row['UserID'];
                if($username == 'Admin' && $password = $db_pass){
                    ?>
                        <script>               
                            alert('Login As Admin');     
                            location.replace("homeadmin.php");
                        </script>
                    <?php
                } else {
                    $pass_decode = password_verify($password, $db_pass);
                    if($pass_decode == true){
                        ?>
                        <script>               
                            alert('Login Successful');     
                            location.replace("index.php");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>               
                            alert('Password Incorect');                                        
                        </script>
                        <?php
                    }
                }                
            }            
        } else {
            ?>
            <script>               
                alert('Invalid Username');                                        
            </script>
            <?php
        }
    }
    ?>
    <section class="home">        
        <div class="content">
            <h2>Don't Have An Account?</h2>
            <p>Although you’re free to shop as a guest on 
                Eyeconic, we recommend creating an account. It’s 
                the easiest way to browse, connect any eligible 
                vision benefits, and receive the latest deals and 
                promotions.
            </p>
            <a href="register.php">Register Now</a>           
        </div>
        <div class="wrapper-login">
            <h2>Member Login</h2>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
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
                <input type="submit" name="login" class="btn" value="Login">
            </form>            
        </div>
    </section>
    <?php
    include_once('footer.php')
    ?>    
</body>
</html>