<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/menu.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Menu</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <section id="category">
    <?php    
    $seacrh = null;
    if (isset($_GET['producttype'])) {
        $producttype = $_GET['producttype'];            
    } else {
        $producttype = $_GET['producttype'] = null;
    }
    if (isset($_GET['brand'])) {
        $brand = $_GET['brand'];            
    } else {
        $brand = $_GET['brand'] = null;
    }
    if (isset($_GET['frameshape'])) {
        $frameshape = $_GET['frameshape'];            
    } else {
        $frameshape = $_GET['frameshape'] = null;
    }
    if (isset($_GET['framestyle'])) {
        $framestyle = $_GET['framestyle'];            
    } else {
        $framestyle = $_GET['framestyle'] = null;
    }
    if (isset($_GET['glassfor'])) {
        $glassfor = $_GET['glassfor'];            
    } else {
        $glassfor = $_GET['glassfor'] = null;
    }
    if (isset($_GET['search'])) {
        $search = $_GET['search'];                
    } else {
        $search = $_GET['search'] = null;
    }
    if (isset($_SESSION['location'])) {        
        $locationQuery = "`Product`.`LocationID` = ".$_SESSION['location'];   
    } else {
        $locationQuery = null;
    }
    ?>
        <div class="container">
            <div class="category-description">
                <?php                    
                if(!is_null($brand)){
                    echo "<h1>$brand</h1>";
                    $resource = mysqli_query($con, "SELECT BrandID,Description FROM brand WHERE BrandName = '$brand'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $id = $row['BrandID'];
                        $description = $row['Description'];
                        echo "<p>$description</p>";
                    }
                } else if(!is_null($frameshape)){
                    echo "<h1>$frameshape</h1>";
                    $resource = mysqli_query($con, "SELECT FrameShapeID,Description FROM frameshape WHERE FrameShapeName = '$frameshape'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $id = $row['FrameShapeID'];
                        $description = $row['Description'];
                        echo "<p>$description</p>";
                    }
                } else if(!is_null($framestyle)){
                    echo "<h1>$framestyle</h1>";
                    $resource = mysqli_query($con, "SELECT FrameStyleID,Description FROM framestyle WHERE FrameStyleName = '$framestyle'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $id = $row['FrameStyleID'];
                        $description = $row['Description'];
                        echo "<p>$description</p>";
                    }
                } else if(!is_null($glassfor)){
                    echo "<h1>$glassfor</h1>";
                    $resource = mysqli_query($con, "SELECT GlassForID,Description FROM glassfor WHERE GlassForName = '$glassfor'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $id = $row['GlassForID'];
                        $description = $row['Description'];
                        echo "<p>$description</p>";
                    }
                } else if(!is_null($producttype)) {
                    echo "<h1>$producttype</h1>";
                    $resource = mysqli_query($con, "SELECT Description FROM producttype WHERE ProductTypeName = '$producttype'");
                    while($row = mysqli_fetch_assoc($resource)){
                        $description = $row['Description'];
                        echo "<p>$description</p>";
                    }
                } else {
                    echo "<h1>Products</h1>";
                }
                ?>
            </div>
            <div class="category-top row">
                <div class="category-top-item">
                    <p>
                        <?php        
                        if(!is_null($producttype)){
                            $resource = mysqli_query($con, "SELECT ProductTypeID FROM producttype WHERE ProductTypeName = '$producttype'");
                            while($row = mysqli_fetch_assoc($resource)){
                                $producttypeid = $row['ProductTypeID'];                            
                            }
                            if(!is_null($brand)){
                                $sqlshow = "WHERE `Product`.`ProductTypeID` = $producttypeid AND `Product`.`BrandID` = $id";
                                echo $producttype.' / '.$brand;
                            } else if(!is_null($frameshape)){
                                $sqlshow = "WHERE `Product`.`ProductTypeID` = $producttypeid AND `Product`.`FrameShapeID` = $id";
                                echo $producttype.' / '.$frameshape;
                            } else if(!is_null($framestyle)){
                                $sqlshow = "WHERE `Product`.`ProductTypeID` = $producttypeid AND `Product`.`FrameStyleID` = $id";
                                echo $producttype.' / '.$framestyle;
                            } else if(!is_null($glassfor)){
                                $sqlshow = "WHERE `Product`.`ProductTypeID` = $producttypeid AND `Product`.`GlassForID` = $id";
                                echo $producttype.' / '.$glassfor;
                            } else {
                                $sqlshow = null;
                                echo $producttype;
                            }
                        } else {
                            $sqlshow = null;
                            $producttypeid = null;
                            echo "Result for $search";
                        }                                   
                        ?>
                    </p>
                </div>
                <div class="category-top-item">
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="">SORT BY</option>
                        <option value="<?php echo $htl?>">Price: High to low</option>
                        <option value="<?php echo $lth?>">Price: Low to high</option>
                    </select>
                </div>
            </div>    
            <div class="category-content row">
                <?php
                if(isset($_SESSION['location'])){
                    if($search != null){
                        $resource = mysqli_query($con, "SELECT `Product`.`ProductID`,`Product`.`ProductName`, CAST(`Product`.`UnitPrice` AS DECIMAL(10,2)) AS UnitPrice, I.`ImageLink` FROM `Product` INNER JOIN (SELECT * FROM `Image` GROUP BY `Image`.`ProductID`) AS I ON `Product`.`ProductID` = I.`ProductID` WHERE `Product`.`Status` = 1 AND `Product`.`ProductName` LIKE '%$search%' AND $locationQuery");                    
                    } else {
                        if(is_null($sqlshow)){
                            $resource = mysqli_query($con, "SELECT `Product`.`ProductID`,`Product`.`ProductName`, CAST(`Product`.`UnitPrice` AS DECIMAL(10,2)) AS UnitPrice, I.`ImageLink` FROM `Product` INNER JOIN (SELECT * FROM `Image` GROUP BY `Image`.`ProductID`) AS I ON `Product`.`ProductID` = I.`ProductID` WHERE `Product`.`Status` = 1 AND `Product`.`ProductTypeID` = $producttypeid AND $locationQuery");
                        } else {
                            $resource = mysqli_query($con, "SELECT `Product`.`ProductID`,`Product`.`ProductName`, CAST(`Product`.`UnitPrice` AS DECIMAL(10,2)) AS UnitPrice, I.`ImageLink` FROM `Product` INNER JOIN (SELECT * FROM `Image` GROUP BY `Image`.`ProductID`) AS I ON `Product`.`ProductID` = I.`ProductID` $sqlshow AND `Product`.`Status` = 1 AND $locationQuery");
                        }   
                    }
                } else {
                    if($search != null){
                        $resource = mysqli_query($con, "SELECT `Product`.`ProductID`,`Product`.`ProductName`, CAST(`Product`.`UnitPrice` AS DECIMAL(10,2)) AS UnitPrice, I.`ImageLink` FROM `Product` INNER JOIN (SELECT * FROM `Image` GROUP BY `Image`.`ProductID`) AS I ON `Product`.`ProductID` = I.`ProductID` WHERE `Product`.`Status` = 1 AND `Product`.`ProductName` LIKE '%$search%'");                    
                    } else {
                        if(is_null($sqlshow)){
                            $resource = mysqli_query($con, "SELECT `Product`.`ProductID`,`Product`.`ProductName`, CAST(`Product`.`UnitPrice` AS DECIMAL(10,2)) AS UnitPrice, I.`ImageLink` FROM `Product` INNER JOIN (SELECT * FROM `Image` GROUP BY `Image`.`ProductID`) AS I ON `Product`.`ProductID` = I.`ProductID` WHERE `Product`.`Status` = 1 AND `Product`.`ProductTypeID` = $producttypeid");
                        } else {
                            $resource = mysqli_query($con, "SELECT `Product`.`ProductID`,`Product`.`ProductName`, CAST(`Product`.`UnitPrice` AS DECIMAL(10,2)) AS UnitPrice, I.`ImageLink` FROM `Product` INNER JOIN (SELECT * FROM `Image` GROUP BY `Image`.`ProductID`) AS I ON `Product`.`ProductID` = I.`ProductID` $sqlshow AND `Product`.`Status` = 1");
                        }   
                    }
                }                                                   
                while($row = mysqli_fetch_assoc($resource)){
                    $id = $row['ProductID'];
                    $name = $row['ProductName'];
                    $price = $row['UnitPrice'];
                    $link = $row['ImageLink'];
                    echo "<div class='category-content-item'>";
                    echo "<a href='product.php?id=$id'><img src='$link'></a>";
                    echo "<h1>$name</h1>";
                    echo "<p><sup>$</sup>$price</p>";
                    echo "</div>";                
                }
                ?>                
            </div>
            <div class="category-bottom">
                
            </div>
        </div>         
    </section>
    <?php
    include_once('footer.php');    
    ?>
</body>
</html>