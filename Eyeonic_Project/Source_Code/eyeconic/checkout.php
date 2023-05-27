<?php
session_start();
include_once('setup.php');
if(isset($_POST['shipname']) && isset($_POST['shipaddress']) && isset($_POST['userid']) && isset($_POST['shipping']) && isset($_POST['date']) && isset($_POST['totalprice'])){
    $shipname = $_POST['shipname'];
    $shipaddress = $_POST['shipaddress'];
    $userid = $_POST['userid'];
    $shipping = $_POST['shipping'];
    $totalprice = $_POST['totalprice'];
    $resource = mysqli_query($con,"SELECT `shipper`.`ShipperID` FROM `shipper` WHERE `shipper`.`Fee` = $shipping");           
        while($row = mysqli_fetch_assoc($resource)){                                                 
        $shipid = $row['ShipperID']; 
        }
    $date = $_POST['date'];
    mysqli_query($con,"INSERT INTO `order`(UserID, OrderDate, ShipVia, TotalPrice, ShipName, ShipAddress) VALUES ($userid, CURRENT_TIMESTAMP, $shipid, $totalprice,'$shipname','$shipaddress')");
    $resource = mysqli_query($con,"SELECT `order`.`OrderID` FROM `order` WHERE `order`.`UserID` = $userid ORDER BY `order`.`OrderID` DESC LIMIT 1");
    while($row = mysqli_fetch_assoc($resource)){
        $orderid = $row['OrderID'];
        if(isset($_SESSION['cart']) && (is_array($_SESSION['cart']))){
            for($i=0; $i < sizeof($_SESSION['cart']); $i++){
                $productid = $_SESSION['cart'][$i][0];
                $price = $_SESSION['cart'][$i][2];
                $quantity = $_SESSION['cart'][$i][4];
                mysqli_query($con,"INSERT INTO `orderdetail`(OrderID,ProductID,UnitPrice,Quantity) VALUES ($orderid,$productid,$price,$quantity)");
            }
        }        
    }
    unset ($_SESSION['cart']);
    header('Location:orderstatus.php');
}
?>