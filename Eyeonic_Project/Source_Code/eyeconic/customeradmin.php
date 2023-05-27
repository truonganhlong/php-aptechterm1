<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customeradmin.css">
    <link rel="stylesheet" href="css/formadmin.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Home Admin</title>
</head>
<body>
    <?php
    include_once('formadmin.php')
    ?>
    <div class="details">
        <div class="customer">
            <div class="cardHeader">
                <h2>All Customer</h2>            
            </div>
            <table>
                <thead>
                    <tr>
                        <td>User</td>
                        <td>Fullname</td>
                        <td>Email</td>
                        <td>Phone</td>                    
                    </tr>
                </thead>
                <tbody>     
                    <?php                        
                    $resource = mysqli_query($con, "SELECT * FROM `user` WHERE `user`.`Username` != 'Admin'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $user = $row['Username'];
                        $fullname = $row['Fullname'];
                        $email = $row['Email'];
                        $phone = $row['Phone'];
                        echo '<tr>';
                        echo "<td>$user</td>";
                        echo "<td>$fullname</td>";
                        echo "<td>$email</td>";
                        echo "<td>$phone</td>";
                        echo '</tr>';
                    }
                    ?>                                           
                </tbody>                    
            </table>
        </div>
    </div>
    <?php              
    echo '</div>';
    echo '<script src="js/homeadmin.js"></script>';
    ?>
</body>
</html>