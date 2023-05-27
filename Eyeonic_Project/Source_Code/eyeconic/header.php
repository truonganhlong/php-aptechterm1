<?php
session_start();
?>
<?php
include_once("setup.php");
$menu = 'menu.php';
$search = '';
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
if (isset($_GET['location'])) {
    $location = $_GET['location'];    
} else {
    $_GET['location'] = '';
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];    
} else {
    $_GET['search'] = '';
}
echo '<header>';
echo '<div class="logo">';
echo '<a href="index.php"><img src="images/eyeconic_logo.jpg" alt="logo"></a>';
echo '</div>';
echo '<div class="menu">';
echo '<li>';
echo '<a href="'.$menu.'?producttype=Eyeglasses">EYEGLASSES</a>';
echo '<ul class="sub-menu">';
echo '<li>GLASSES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT GlassForName FROM glassfor');
while($row = mysqli_fetch_assoc($resource)){
$glassfor = $row['GlassForName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Eyeglasses';
} else {
    $menu = $menu.'&producttype=Eyeglasses';
}
echo "<li><a href='$menu&glassfor=$glassfor'>$glassfor</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>FRAME SHAPES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT FrameShapeName FROM frameshape');
while($row = mysqli_fetch_assoc($resource)){
$frameshape = $row['FrameShapeName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Eyeglasses';
} else {
    $menu = $menu.'&producttype=Eyeglasses';
}
echo "<li><a href='$menu&frameshape=$frameshape'>$frameshape</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>FRAME STYLES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT FrameStyleName FROM framestyle WHERE IsGlasses = 1');
while($row = mysqli_fetch_assoc($resource)){
$framestyle = $row['FrameStyleName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Eyeglasses';
} else {
    $menu = $menu.'&producttype=Eyeglasses';
}
echo "<li><a href='$menu&framestyle=$framestyle'>$framestyle</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>FEATURED BRANDS';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT BrandName FROM brand WHERE CategoryFor = 0 OR CategoryFor = 1');
while($row = mysqli_fetch_assoc($resource)){
$brand = $row['BrandName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Eyeglasses';
} else {
    $menu = $menu.'&producttype=Eyeglasses';
}
echo "<li><a href='$menu&brand=$brand'>$brand</a></li>";
}
echo '</ul>';
echo '</li>';
echo '</ul>';
echo '</li>';
$menu = "menu.php";
echo '<li>';
echo '<a href="'.$menu.'?producttype=Sunglasses">SUNGLASSES</a>';
echo '<ul class="sub-menu">';
echo '<li>SUNGLASSES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT GlassForName FROM glassfor');
while($row = mysqli_fetch_assoc($resource)){
$glassfor = $row['GlassForName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Sunglasses';
} else {
    $menu = $menu.'&producttype=Sunglasses';
}
echo "<li><a href='$menu&glassfor=$glassfor'>$glassfor</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>FRAME SHAPES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT FrameShapeName FROM frameshape');
while($row = mysqli_fetch_assoc($resource)){
$frameshape = $row['FrameShapeName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Sunglasses';
} else {
    $menu = $menu.'&producttype=Sunglasses';
}
echo "<li><a href='$menu&frameshape=$frameshape'>$frameshape</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>FRAME STYLES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT FrameStyleName FROM framestyle WHERE IsGlasses = 1');
while($row = mysqli_fetch_assoc($resource)){
$framestyle = $row['FrameStyleName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Sunglasses';
} else {
    $menu = $menu.'&producttype=Sunglasses';
}
echo "<li><a href='$menu&framestyle=$framestyle'>$framestyle</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>FEATURED BRANDS';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT BrandName FROM brand WHERE CategoryFor = 0 OR CategoryFor = 2');
while($row = mysqli_fetch_assoc($resource)){
$brand = $row['BrandName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Sunglasses';
} else {
    $menu = $menu.'&producttype=Sunglasses';
}
echo "<li><a href='$menu&brand=$brand'>$brand</a></li>";
}
echo '</ul>';
echo '</li>';
$menu = "menu.php";
echo '</ul>';
echo '</li>';
echo '<li>';
echo '<a href="'.$menu.'?producttype=Contact%20Lenses">CONTACT LENSES</a>';
echo '<ul class="sub-menu">';
echo '<li>CONTACT BRANDS';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT BrandName FROM brand WHERE CategoryFor = 3');
while($row = mysqli_fetch_assoc($resource)){
$brand = $row['BrandName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Contact%20Lenses';
} else {
    $menu = $menu.'&producttype=Contact%20Lenses';
}
echo "<li><a href='$menu&brand=$brand'>$brand</a></li>";
}
echo '</ul>';
echo '</li>';
echo '<li>LENS TYPES';
echo '<ul>';
$resource = mysqli_query($con, 'SELECT FrameStyleName FROM framestyle WHERE IsGlasses = 0');
while($row = mysqli_fetch_assoc($resource)){
$framestyle = $row['FrameStyleName'];
if($menu = 'menu.php'){
    $menu = $menu.'?producttype=Contact%20Lenses';
} else {
    $menu = $menu.'&producttype=Contact%20Lenses';
}
echo "<li><a href='$menu&framestyle=$framestyle'>$framestyle</a></li>";
}
echo '</ul>';
echo '</li>';
echo '</ul>';
echo '</li>';
echo '<li>';
echo '<form action="/eyeconic/menu.php">';
echo '<input type="text" name="search" placeholder="SEARCH">';
echo '<button class="fa-solid fa-magnifying-glass" type="submit"></button>';
echo '</form>';
echo '</li>';
echo '</div>';
echo '<div class="others">';
if(isset($_SESSION['userid'])){
    echo '<li><a class="fa-regular fa-user" href="account.php"> YOUR ACCOUNT</a></li>';    
} else {
    echo '<li><a class="fa-regular fa-user" href="login.php"> SIGN IN</a></li>';
}
echo '<li><a class="fa-regular fa-rectangle-list" href="orderstatus.php"> ORDER STATUS</a></li>';
echo '<li><a class="fa-solid fa-cart-shopping" href="cart.php"> CART</a></li>';
echo '<li><i class="fa-solid fa-location-dot" href=""> LOCATION</i>';
echo '<ul class="location">';
$resource = mysqli_query($con, 'SELECT LocationID,LocationName FROM location');
while($row = mysqli_fetch_assoc($resource)){
$locationid = $row['LocationID'];
$locationname = $row['LocationName'];
$menu = '';
$menu = 'location.php?location='.$locationid;
echo "<li><a href='$menu' onclick='return confirm(\"You wanna change to this location?\")'>$locationname</a></li>";
}
echo '</ul>';
echo '</li>';
if(isset($_SESSION['userid'])){
    echo '<li><a class="fa-regular fa-right-from-bracket" href="logout.php" onclick="return confirm(\'Are you sure to log-out?\')"> LOG-OUT</a></li>';    
}
echo '</div>';
echo '</header>';
?>