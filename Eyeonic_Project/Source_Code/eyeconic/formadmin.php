<?php
include_once('setup.php');
$today = date("Y-m-d");
echo '<div class="container">';
echo '<div class="navigation">';
echo '<ul>';
echo '<li>';
echo '<a href="#">';
echo '<span class="icon">';
echo '<i class="fa-solid fa-eye"></i>';
echo '</span>';
echo '<span class="title">Eyeconic</span>';
echo '</a>';
echo '</li>';
echo '<li>';
echo '<a href="homeadmin.php">';
echo '<span class="icon">';
echo '<i class="fa-solid fa-house"></i>';
echo '</span>';
echo '<span class="title">Dashboard</span>';
echo '</a>';
echo '</li>';
echo '<li>';
echo '<a href="customeradmin.php">';
echo '<span class="icon">';
echo '<i class="fa-solid fa-users"></i>';
echo '</span>';
echo '<span class="title">Customer</span>';
echo '</a>';
echo '</li>';
echo '<li>';
echo '<a href="productadmin.php">';
echo '<span class="icon">';
echo '<i class="fa-solid fa-suitcase"></i>';
echo '</span>';
echo '<span class="title">Products</span>';
echo '</a>';
echo '</li>';
echo '<li>';
echo '<a href="orderadmin.php">';
echo '<span class="icon">';
echo '<i class="fa-solid fa-table-list"></i>';
echo '</span>';
echo '<span class="title">Orders</span>';
echo '</a>';
echo '</li>';
echo '<li>';
echo '<a href="logout.php" onclick="return confirm(\'Are you sure to log-out?\')">';
echo '<span class="icon">';
echo '<i class="fa-solid fa-right-from-bracket"></i>';
echo '</span>';
echo '<span class="title">Sign Out</span>';
echo '</a>';
echo '</li>';
echo '</ul>';
echo '</div>';
echo '</div>';
echo '<div class="main">';
echo '<div class="topbar">';
echo '<div class="toggle">';
echo '<i class="fa-solid fa-bars"></i>';
echo '</div>';
echo '<div class="search">';
echo '<label>';
echo '<input type="text" placeholder="Search here">';
echo '<i class="fa-solid fa-magnifying-glass"></i>';
echo '</label>';
echo '</div>';
echo '</div>';
echo '<div class="cardBox">';
echo '<div class="card">';
echo '<div>';
$resource = mysqli_query($con, "SELECT COUNT(OrderID) AS Sale FROM `order` WHERE `order`.`Status` = 0 AND date(OrderDate) = '$today' ");
while($row = mysqli_fetch_assoc($resource)){
    $sale = $row['Sale'];
    if(is_null($row['Sale'])){
        echo "<div class='numbers'>0</div>";
    } else {
        echo "<div class='numbers'>$sale</div>";
    }                        
}
echo '<div class="cardname">Sales</div>';
echo '</div>';
echo '<div class="iconBx">';
echo '<i class="fa-solid fa-cart-plus"></i>';
echo '</div>';
echo '</div>';
echo '<div class="card">';
echo '<div>';
$resource = mysqli_query($con, "SELECT SUM(TotalPrice) AS TotalPrice FROM `order` WHERE `order`.`Status` = 0 AND date(OrderDate) = '$today' ");
while($row = mysqli_fetch_assoc($resource)){
    $earning = $row['TotalPrice'];
    if(is_null($row['TotalPrice'])){
        echo "<div class='numbers'><sup>$</sup>0</div>";
    } else {
        echo "<div class='numbers'><sup>$</sup>$earning</div>";
    }                        
}
echo '<div class="cardname">Earning</div>';
echo '</div>';
echo '<div class="iconBx">';
echo '<i class="fa-solid fa-money-check-dollar"></i>';
echo '</div>';
echo '</div>';
echo '</div>';

