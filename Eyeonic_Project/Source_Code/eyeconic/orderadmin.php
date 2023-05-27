<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/orderadmin.css">
    <link rel="stylesheet" href="css/formadmin.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>    
    <title>Document</title>
</head>
<body>
    <?php
    include_once('formadmin.php');
    if(isset($_POST['changestatus'])){
        $orderid = $_POST['orderid'];
        $status = $_POST['status'];
        mysqli_query($con, "UPDATE `order` SET Status = $status WHERE OrderID = $orderid");
    }
    ?>
    <div class="details">
        <div class="orders">
            <div class="cardHeader">
                <h2>All Orders</h2>            
            </div>
            <table>
                <thead>
                    <tr>
                        <td>User</td>
                        <td>Order Date</td>
                        <td>Ship Via</td>   
                        <td>Price</td>
                        <td>Name</td>          
                        <td>Address</td>   
                        <td>Status</td>          
                        <td>Detail</td>        
                    </tr>
                </thead>
                <tbody>     
                    <?php                        
                    $resource = mysqli_query($con, "SELECT `order`.*, `user`.`Username`, `shipper`.`ShipperName` FROM `order` INNER JOIN `user` ON `order`.`UserID` = `user`.`UserID` INNER JOIN `shipper` ON `order`.`ShipVia` = `shipper`.`ShipperID`");
                    while($row = mysqli_fetch_assoc($resource)){
                        $orderid = $row['OrderID'];
                        $user = $row['Username'];
                        $orderdate = $row['OrderDate'];
                        $ship = $row['ShipperName'];
                        $price = $row['TotalPrice'];
                        $shipname = $row['ShipName'];
                        $shipaddress = $row['ShipAddress'];
                        $status = $row['Status'];
                        echo '<tr>';
                        echo "<td>$user</td>";
                        echo "<td>$orderdate</td>";
                        echo "<td>$ship</td>";
                        echo "<td>$price</td>";
                        echo "<td>$shipname</td>";
                        echo "<td>$shipaddress</td>";
                        if($status == 0){
                            echo "<td>Shipped</td>";
                        } else if($status == 1){
                            echo "<td>Pending</td>";
                        } else {
                            echo "<td>Delivered</td>";
                        }  
                        echo "<td><a href='orderadmin.php?detail=$orderid'>Detail</a></td>";
                        echo '</tr>';
                    }
                    ?>                                           
                </tbody>                    
            </table>
        </div>
        <?php
        if(isset($_GET['detail'])){
            echo "<div class=\"orderdetail\">";
            echo "<div class=\"cardHeader\">";
            echo "<h2>Order's Detail</h2>";
            echo "</div>";
            $index = 0;
            $id = $_GET['detail']; 
            $resource = mysqli_query($con, "SELECT `orderdetail`.*, `product`.`ProductName` FROM `orderdetail` INNER JOIN `product` ON `orderdetail`.`ProductID` = `product`.`ProductID` WHERE `orderdetail`.`OrderID` = $id");
            while($row = mysqli_fetch_assoc($resource)){  
                $index += 1;
                $orderid = $row['OrderID'];
                $productname = $row['ProductName'];
                $price = $row['UnitPrice'];
                $quantity = $row['Quantity'];     
                echo "<p>$index.</p>";            
                echo "<p>Product Name: $productname</p>";
                echo "<p>Price: $price</p>";
                echo "<p>Quantity: $quantity</p>";
            }   
            echo "<form action='orderadmin.php' method='post'>";
            echo "<input type='hidden' name='orderid' value='$orderid'>";
            echo "<p>Select Status</p>";
            echo "<select name='status'>";   
            echo "<option value='0'>Shipped</option>";  
            echo "<option value='1'>Pending</option>";
            echo "<option value='2'>Delivered</option>";
            echo "</select>";                    
            echo "<input type='submit' name='changestatus' value='Change Status'>";
            echo "</form>";  
            echo "</div>";   
        }
        ?>
    </div>
    <?php              
    echo '</div>';
    echo '<script src="js/homeadmin.js"></script>';
    ?>
</body>
</html>