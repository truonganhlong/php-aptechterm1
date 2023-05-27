<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/product.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Product</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <section class="product">   
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];            
        } else {
            $id = $_GET['id'] = null;
        }
        ?>     
        <div class="container">
            <?php
            $resource = mysqli_query($con,"SELECT `Product`.*, `Location`.`LocationName`, `Brand`.`BrandName`, `ProductType`.`ProductTypeName`, `GlassFor`.`GlassForName`, `FrameStyle`.`FrameStyleName`, `FrameShape`.`FrameShapeName` 
                                            FROM `Product` INNER JOIN `Location` ON `Product`.`LocationID` = `Location`.`LocationID` 
                                            LEFT JOIN `Brand` ON `Product`.`BrandID` = `Brand`.`BrandID`
                                            LEFT JOIN `ProductType` ON `Product`.`ProductTypeID` = `ProductType`.`ProductTypeID`
                                            LEFT JOIN `GlassFor` ON `Product`.`GlassForID` = `GlassFor`.`GlassForID`
                                            LEFT JOIN `FrameStyle` ON `Product`.`FrameStyleID` = `FrameStyle`.`FrameStyleID`
                                            LEFT JOIN `FrameShape` ON `Product`.`FrameShapeID` = `FrameShape`.`FrameShapeID` 
                                            WHERE `Product`.`ProductID` = $id");
            while($row = mysqli_fetch_assoc($resource)){                        
                $name = $row['ProductName'];
                $price = $row['UnitPrice'];
                $inStock = $row['UnitsInStock'];
                $location = $row['LocationName'];
                if(is_null($location)){
                    $location = 'None';
                }
                $brand = $row['BrandName'];
                if(is_null($brand)){
                    $brand = 'None';
                }
                $productType = $row['ProductTypeName'];
                $glassFor = $row['GlassForName'];
                if(is_null($glassfor)){
                    $glassFor = 'None';
                }
                $frameStyle = $row['FrameStyleName'];
                if(is_null($frameStyle)){
                    $frameStyle = 'None';
                }
                $frameShape = $row['FrameShapeName'];       
                if(is_null($frameShape)){
                    $frameShape = 'None';
                }                                        
            }
            ?>
            <div class="product-top">
                <p>
                    <?php
                    echo $productType." / ".$name;
                    ?>
                </p>
            </div>
            <div class="product-content row">
                <div class="product-content-left row">
                    <div class="product-content-left-big-img">
                    <?php
                    $resource = mysqli_query($con,"SELECT `Image`.`ImageLink` FROM `Image` WHERE `Image`.`ProductID` = $id ORDER BY `Image`.`ImageID` LIMIT 1");
                    while($row = mysqli_fetch_assoc($resource)){                        
                        $firstlink = $row['ImageLink'];                        
                        echo "<img src='$firstlink'>";                        
                    }
                    ?>
                    </div>
                    <div class="product-content-left-small-img">
                    <?php
                    $resource = mysqli_query($con,"SELECT `Image`.`ImageLink` FROM `Image` WHERE `Image`.`ProductID` = $id");
                    while($row = mysqli_fetch_assoc($resource)){                        
                        $link = $row['ImageLink'];                        
                        echo "<img src='$link'>";                        
                    }
                    ?>   
                    </div>
                </div>
                <div class="product-content-right">                    
                    <div class="product-content-right-name">
                        <?php
                        echo "<h1>$name</h1>";
                        ?>
                    </div>
                    <div class="product-content-right-price">
                        <?php
                        echo "<p><sup>$</sup>$price</p>";
                        ?>
                    </div>
                    <form action="/eyeconic/cart.php" method="post">
                        <div class="product-content-right-color">
                            <label for="color">Select color:</label>
                            <select name="color" id="color">   
                                <?php
                                $resource = mysqli_query($con,"SELECT `color`.`ColorName`
                                FROM `color` INNER JOIN
                                `productcolor` ON `color`.`ColorID` = `productcolor`.`ColorID` INNER JOIN
                                `product` ON `productcolor`.`ProductID` = `product`.`ProductID`
                                WHERE `product`.`ProductID` = $id");           
                                while($row = mysqli_fetch_assoc($resource)){                        
                                $color = $row['ColorName'];                        
                                echo "<option value='$color'>$color</option>";                        
                                }          
                                ?>                                
                            </select>
                        </div>                     
                        <div class="product-content-right-quantity">
                            <input type='hidden' name='id' value='<?php echo $id ?>'>
                            <input type='hidden' name='name' value='<?php echo $name ?>'>
                            <input type='hidden' name='price' value='<?php echo $price ?>'>
                            <input type='hidden' name='img' value='<?php echo $firstlink ?>'>
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" min="1" max="<?php echo $inStock ?>">                            
                        </div>      
                        <div class="product-content-right-button">
                            <button type="submit"><i class="fas fa-shopping-cart"></i> <p>ADD TO CART</p></button>
                        </div>
                    </form>            
                </div>
            </div>
            <hr>
            <div class="product-content row">
                <div class="product-content-left row">
                    <div class="product-content-left-detail">
                        <h1>DETAIL</h1>
                        <p>Brand: <?php echo "$brand"?></p>
                        <p>Gender: <?php echo "$glassFor"?></p>
                        <p>Frame Style: <?php echo "$frameStyle"?></p>
                        <p>Frame Shape: <?php echo "$frameShape"?></p>
                        <p>Location: <?php echo "$location"?></p>                                            
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-prescription">
                        <h1><i class="fa-solid fa-circle-exclamation"></i>Prescription Requirements</h1>
                        <p>Prescriptions are carefully reviewed and validated before lenses are made.</p>
                        <p>To avoid cancellation and delays, prescriptions must be:</p>
                        <ul>
                            <li>Valid before the order date and not expired.</li>
                            <li>For the person named on the order.</li>
                            <li>Provided during Checkout and before Payment.</li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    <?php
    include_once('footer.php');
    ?>
</body>
</html>