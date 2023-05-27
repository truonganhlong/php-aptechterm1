<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/orderstatus.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Your Order Status</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <main class="table">
        <?php
        if(!isset($_SESSION['userid'])){
            echo '<script>';
            echo "alert('You must login to check your order status!');";
            echo "window.location.href = 'login.php';";
            echo '</script>';
        } else {
            $userid = ($_SESSION['userid']);
        }
        ?>
        <section class="table-header">
            <h1>Your Orders</h1>
        </section>
        <section class="table-body">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Ship Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $resource = mysqli_query($con, "SELECT `product`.`ProductName`, `orderdetail`.`UnitPrice`, `orderdetail`.`Quantity`, `orderdetail`.`UnitPrice` * `orderdetail`.`Quantity` AS `TotalPrice`,`order`.`OrderDate`, `order`.`ShipAddress`, `order`.`Status`
                    FROM `orderdetail` INNER JOIN
                    `order` ON `orderdetail`.`OrderID` = `order`.`OrderID` INNER JOIN
                    `product` ON `orderdetail`.`ProductID` = `product`.`ProductID`
                    WHERE `order`.`UserID` = $userid");
                    while($row = mysqli_fetch_assoc($resource)){
                        $name = $row['ProductName'];
                        $price = $row['UnitPrice'];
                        $quantity = $row['Quantity'];
                        $totalprice = $row['TotalPrice'];
                        $date = $row['OrderDate'];
                        $address = $row['ShipAddress'];
                        $status = $row['Status'];
                        echo "<tr>";
                        echo "<td>$name</td>";
                        echo "<td><sup>$</sup>$price</td>";
                        echo "<td>$quantity</td>";
                        echo "<td><sup>$</sup>$totalprice</td>";
                        echo "<td>$date</td>";
                        echo "<td>$address</td>";
                        if($status == 0){
                            echo "<td><p>Shipped</p></td>";
                        } else if($status == 1){
                            echo "<td><p>Pending</p></td>";
                        } else {
                            echo "<td><p>Delivered</p></td>";
                        }  
                        echo "</tr>";                    
                    }
                    ?>                                  
                </tbody>
            </table>
        </section>
    </main>
    <?php
    include_once('footer.php');
    ?>
</body>
</html>