<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Order</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <section class="order">
        <?php
        if(!isset($_SESSION['userid'])){
            echo '<script>';
            echo "alert('You must login before order!');";
            echo "window.location.href = 'login.php';";
            echo '</script>';
        }  
        if(!isset($_SESSION['cart'])){
            echo '<script>';
            echo "alert('Your cart is empty!');";
            echo "window.location.href = 'cart.php';";
            echo '</script>';
        }
        ?>
        <div class="containers">
            <div class="order-top">
                <h1>YOUR ORDER</h1>
            </div>
        </div>
        <div class="containers">
            <div class="order-left">
                <form id="form-order" action="checkout.php" method="post">                    
                    <label for="shipname">Ship Name</label>
                    <input type="text" name="shipname" id="shipname">
                    <label for="shipaddress">Ship Address</label>
                    <input type="text" name="shipaddress" id="shipaddress">                    
                    <input type='hidden' name='userid' value='<?php echo $_SESSION['userid'] ?>'>
                    <input type='hidden' name='shipping' value='<?php echo $_POST['shipping'] ?>'>
                    <input type='hidden' name='totalprice' value='<?php $total = $_POST['price'] + $_POST['shipping'];echo $total ?>'>
                    <input type='hidden' name='date' value='<?php $mydate=getdate(date("U"));echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]"; ?>'>
                    <button type="submit" class="fa-solid fa-bag-shopping" id="checkout" onclick="return confirm('Are you sure to check-out these products?')"> CHECK OUT</button>                    
                </form>
            </div>  
            <div class="order-right">
                <div class="overview">
                    <table>
                        <tr>
                            <th colspan="2"><h2>Order Summary</h2></th>
                        </tr>
                        <tr>
                            <th>Product Subtotal</th>
                            <th>
                                <?php
                                if(isset($_POST['price'])){
                                    $price = $_POST['price'];
                                    echo '<sup>$</sup>'.$price;
                                } else {
                                    $price = 0;
                                }
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Shipping's Fee</th>
                            <th>
                                <?php
                                if(isset($_POST['shipping'])){
                                    $shipping = $_POST['shipping'];
                                    echo '<sup>$</sup>'.$shipping;
                                } else {
                                    $shipping = 0;
                                }
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Estimated Total</th>
                            <th>
                                <?php
                                if(isset($price) && isset($shipping)){
                                    $total = $price + $shipping;
                                    echo '<sup>$</sup>'.$total;
                                } else {
                                    $total = 0;
                                }   
                                ?>
                            </th>                            
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <th>
                                <?php
                                $mydate=getdate(date("U"));
                                echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
                                ?>
                            </th>
                        </tr>
                    </table>
                </div>                
                <div class="advertise">
                    <p><i class="fa-solid fa-truck"></i> Free Shipping and Returns</p>
                    <p><i class="fa-solid fa-tag"></i> Prescription Lenses Included, Always.</p>
                    <p><i class="fa-solid fa-circle-dollar-to-slot"></i> Save up to $220 Using Vision Insurance</p>
                    <p><i class="fa-solid fa-circle-dollar-to-slot"></i> VSP Member Perk: 20% Off Eyewear</p>
                </div>  
            </div>                    
        </div>
    </section>
    <?php
    include_once('footer.php');
    ?>
</body>
</html>