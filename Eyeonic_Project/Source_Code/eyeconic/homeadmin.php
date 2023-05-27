<?php
$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homeadmin.css">
    <link rel="stylesheet" href="css/formadmin.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>    
    <title>Home Admin</title>
</head>
<body>
    <?php
    include_once('formadmin.php')
    ?>
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Recent Orders</h2>
                <a href="orderadmin.php" class="btn">View All</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>User</td>
                        <td>Price</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>     
                    <?php                        
                    $resource = mysqli_query($con, "SELECT `user`.`Username`, `order`.`TotalPrice`, `order`.`Status` FROM `order` INNER JOIN `user` ON `order`.`UserID` = `user`.`UserID` WHERE date(OrderDate) = '$today'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $user = $row['Username'];
                        $price = $row['TotalPrice'];
                        $status = $row['Status'];
                        echo '<tr>';
                        echo "<td>$user</td>";
                        echo "<td><sup>$</sup>$price</td>";
                        if($status == 0){
                            echo "<td>Shipped</td>";
                        } else if($status == 1){
                            echo "<td>Pending</td>";
                        } else {
                            echo "<td>Delivered</td>";
                        }  
                        echo '</tr>';
                    }
                    ?>                                           
                </tbody>                    
            </table>
        </div>
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>                    
            </div>
            <table>
                <tr>
                    <?php
                    $resource = mysqli_query($con, "SELECT `user`.`Username`, `user`.`Email` FROM `user` WHERE `user`.`Username` != 'Admin' ORDER BY `user`.`UserID` DESC LIMIT 5");
                    while($row = mysqli_fetch_assoc($resource)){
                        $username = $row['Username'];
                        $email = $row['Email'];
                        echo "<td>";
                        echo "<h4>Username: $username</h4>";
                        echo "</td>";
                        echo "<td>";
                        echo "<h4>Email: $email</h4>";
                        echo "</td>";
                    }
                    ?>                        
                </tr>                    
            </table>
        </div>
    </div>  
    <?php              
    echo '</div>';
    echo '<script src="js/homeadmin.js"></script>';
    ?>
</body>
</html>