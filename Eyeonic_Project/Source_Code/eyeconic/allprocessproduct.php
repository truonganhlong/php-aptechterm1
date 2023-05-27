<?php
include_once('setup.php');
$updatequery = "SET ";
if(isset($_POST['id'])){
    $id = $_POST['id'];
} else {
    $id = null;
}
if(!empty($_POST['productname'])){
    $productname = $_POST['productname'];
    $updatequery = $updatequery."ProductName = '$productname'"; 
} else {
    $productname = null;
}
if($_POST['location'] != 'null'){
    $location = $_POST['location'];
    $updatequery = $updatequery.",LocationID = $location";
} else {
    $location = 'null';
}
if($_POST['brand'] != 'null'){
    $brand = $_POST['brand'];
    $updatequery = $updatequery.",BrandID = $brand";
} else {
    $brand = 'null';
}
if($_POST['producttype'] != 'null'){
    $producttype = $_POST['producttype'];
    $updatequery = $updatequery.",ProductTypeID = $producttype";
} else {
    $producttype = 'null';
}
if($_POST['glassfor'] != 'null'){
    $glassfor = $_POST['glassfor'];
    $updatequery = $updatequery.",GlassForID = $glassfor";
} else {
    $glassfor = 'null';
}
if($_POST['framestyle'] != 'null'){
    $framestyle = $_POST['framestyle'];
    $updatequery = $updatequery.",FrameStyleID = $framestyle";
} else {
    $framestyle = 'null';
}
if($_POST['frameshape'] != 'null'){
    $frameshape = $_POST['frameshape'];
    $updatequery = $updatequery.",FrameShapeID = $frameshape";
} else {
    $frameshape = 'null';
}
if(!empty($_POST['price'])){
    $price = $_POST['price'];
    $updatequery = $updatequery.",UnitPrice = $price";
} else {
    $price = null;
}
if(!empty($_POST['unit'])){
    $unit = $_POST['unit'];
    $updatequery = $updatequery.",UnitsInStock = $unit";
} else {
    $unit = null;
}
if(isset($_POST['create'])){
    mysqli_query($con, "INSERT INTO `product`(ProductName,LocationID,BrandID,ProductTypeID,GlassForID,FrameStyleID,FrameShapeID,UnitPrice,UnitsInStock,Status) VALUES('$productname',$location,$brand,$producttype,$glassfor,$framestyle,$frameshape,$price,$unit,1)");
}
if(isset($_POST['update'])){
    mysqli_query($con, "UPDATE `product` $updatequery WHERE ProductID = $id");
}
header("Location: productadmin.php");
?>