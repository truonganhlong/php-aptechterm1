<?php 
session_start();
if(isset($_GET['location'])){
    $_SESSION['location'] = $_GET['location'];
}
header('Location:index.php');
?>