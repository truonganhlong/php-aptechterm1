<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Your Shopping Cart</title>
</head>
<body>
    <?php 
    include_once('header.php');
    ?>
    <?php 
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
    if(isset($_GET['delid'])&&($_GET['delid']>=0)){
        array_splice($_SESSION['cart'], $_GET['delid'], 1);
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];            
    } else {
        $id = $_POST['id'] = null;
    }
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];            
    } else {
        $quantity = $_POST['quantity'] = null;
    }
    if (isset($_POST['color'])) {
        $color = $_POST['color'];            
    } else {
        $color = $_POST['color'] = null;
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];            
    } else {
        $name = $_POST['name'] = null;
    }
    if (isset($_POST['price'])) {
        $price = $_POST['price'];            
    } else {
        $price = $_POST['price'] = null;
    }
    if (isset($_POST['img'])) {
        $img = $_POST['img'];            
    } else {
        $img = $_POST['img'] = null;
    }
    if(isset($id)){
        $product = [$id,$name,$price,$img,$quantity,$color];
        $_SESSION['cart'][] = $product;
    }
    //var_dump($_SESSION['cart']);
    function showcart(bool $showhtml){
        if(isset($_SESSION['cart']) && (is_array($_SESSION['cart']))){
            $totalprice = 0;
            for($i=0; $i < sizeof($_SESSION['cart']); $i++){
                $tp = $_SESSION['cart'][$i][4] * $_SESSION['cart'][$i][2];
                $totalprice+=$tp;             
                if($showhtml == true){
                    echo '<div class="box">
                        <img src="'.$_SESSION['cart'][$i][3].'">
                        <div class="content">
                            <h3>'.$_SESSION['cart'][$i][1].'</h3>
                            <h4>Price: <sup>$</sup>'.$_SESSION['cart'][$i][2].'</h4>
                            <p class="unit">Quantity: '.$_SESSION['cart'][$i][4].'</p>
                            <p class="unit">Color: '.$_SESSION['cart'][$i][5].'</p>
                            <h4>Total Price: <sup>$</sup>'.$tp.'</h4>
                            <p class="btn-area">
                                <i class="fa fa-trash"></i>
                                <span class="btn2"><a href="cart.php?delid='.$i.'">Remove</a></span>
                            </p>
                        </div>
                    </div>';
                }
            }
            return $totalprice;
        }
    }    
    ?>
    <section class="cart">    
        <div class="containers">
            <div class="cart-top">
                <h1>SHOPPING CART (<?php 
                if(isset($_SESSION['cart'])){
                    echo count($_SESSION['cart']);
                } else {
                    echo '0';
                }              
                ?>)                
                </h1>
            </div>
        </div>
        <div class="containers">
            <div class="cart-content-left">
                <div class="cart-content-left-product">                   
                    <?php 
                    showcart(true);
                    ?>
                </div>
                <div class="cart-content-left-prescription">
                    <h1><i class="fa-solid fa-circle-exclamation"></i>Prescription Requirements</h1>                    
                    <ul>
                        <li>Prescriptions must be valid before the order date and not expired.</li>
                        <li>Prescriptions are reviewed and validated before the manufacturing process.</li>
                        <li>Prescriptions must be for the person named on the order.</li>
                        <li>Prescription information is provided during Checkout before Payment.</li>
                        <li>Contact lenses must match prescribed brand and Rx exactly, to avoid cancellation and delays.</li>
                    </ul>
                </div>
                <div class="cart-content-left-shipping-method">
                    <h1><i class="fa-solid fa-truck"></i>Shipping Method</h1>
                    <form action="" method="post">
                        <select name="shipping" id="shipping" onchange="this.form.submit()">
                            <option value='<?php echo 0 ?>'>Select shipping's method</option>";                           
                            <?php
                            $resource = mysqli_query($con,"SELECT * FROM `shipper`");           
                            while($row = mysqli_fetch_assoc($resource)){                                                 
                            $ship = $row['ShipperName']; 
                            $fee = $row['Fee'];          
                            echo "<option value='$fee'>$ship</option>";                                                       
                            }          
                            ?>                              
                        </select>
                    </form>
                    <p>All eyeglasses and prescription eyewear are custom-made, which can take up to 7 days. If your order includes a progressive prescription or is being made with TechShield™ Blue or SunSync®, we’ll need an additional 4-5 days to apply these enhancements.</p>
                </div>
            </div>
            <div class="cart-content-right">
                <div class="cart-content-right-table">
                    <table>
                        <tr>
                            <th colspan="2"><h2>Order Summary</h2></th>
                        </tr>
                        <tr>
                            <th>Product Subtotal</th>
                            <th><?php echo "<sup>$</sup>".showcart(false) ?></th>
                        </tr>
                        <tr>
                            <th>Shipping's Fee</th>
                            <th>
                            <?php 
                            if(isset($_POST['shipping'])){
                                $value = $_POST['shipping'];
                                echo "<sup>$</sup>".$value;
                            } else {
                                echo 0;
                            }
                            ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Estimated Total</th>
                            <th><?php 
                            if(isset($_POST['shipping'])){
                                $value = $_POST['shipping'];
                                echo "<sup>$</sup>".showcart(false) +  $value;
                            } else {
                                echo "<sup>$</sup>".showcart(false);
                            }
                            ?></th>                            
                        </tr>
                    </table>                
                </div>
                <div class="cart-content-right-checkout">
                    <form action="order.php" method="post">
                        <input type='hidden' name='userid' value='<?php echo $_SESSION['userid'] ?>'>
                        <input type='hidden' name='shipping' value='<?php echo $_POST['shipping'] ?>'>
                        <input type='hidden' name='price' value='<?php echo showcart(false) ?>'>
                        <button type="submit" class="fa-solid fa-bag-shopping" id="checkout"> Order</button>
                    </form>                    
                </div>
                <div class="cart-content-right-advertise">
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