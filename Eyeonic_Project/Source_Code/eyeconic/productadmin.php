<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productadmin.css">
    <link rel="stylesheet" href="css/formadmin.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>    
    <title>Home Admin</title>
</head>
<body>
    <?php   
    include_once('formadmin.php');
    if(isset($_GET['update'])){
        $id = $_GET['update'];
        $edit_status = true;
    } else {
        $edit_status = false;
    }
    if(isset($_GET['delete'])&&isset($_GET['status'])){
        $id = $_GET['delete'];
        $status = $_GET['status'];
        if($status == 0){
            $status = 1;
        } else {
            $status = 0;
        }
        mysqli_query($con, "UPDATE `product` SET Status = $status WHERE ProductID = $id");
    }
    if(isset($_POST['colorimagesubmit'])){
        $id = $_POST['productchoose'];
        $color = $_POST['color'];
        if(!empty($_POST['color'])){
            $resource = mysqli_query($con,"SELECT * FROM `color` WHERE `color`.`ColorName` = '$color'");
            if(mysqli_num_rows($resource)){
                $row = mysqli_fetch_assoc($resource);
                $colorid = $row['ColorID'];
                mysqli_query($con,"INSERT INTO `productcolor`(ProductID,ColorID) VALUES($id,$colorid)");
            } else {
                mysqli_query($con,"INSERT INTO `color`(ColorName) VALUES('$color')");
                $resource = mysqli_query($con,"SELECT * FROM `color` WHERE `color`.`ColorName` = '$color'");
                $row = mysqli_fetch_assoc($resource);
                $colorid = $row['ColorID'];
                mysqli_query($con,"INSERT INTO `productcolor`(ProductID,ColorID) VALUES($id,$colorid)");
            }
        }
        $imgname = $_POST['imgname'];
        $img = $_FILES['image']['name'];
        $insertimg = "INSERT INTO `image`(ProductID,ImageLink) VALUES($id,'images/$img')";
        if(mysqli_query($con,$insertimg)){
            move_uploaded_file($_FILES['image']['tmp_name'], "images/$img");
        }
    }
    ?>
    <div class="details">
        <div class="tableproduct">
            <div class="cardHeader">
                <h2>All Products</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <td width="250px">Product</td>
                        <td>Price</td>
                        <td>Unit In Stock</td>
                        <td>Status</td>       
                        <td>Detail</td>
                        <td>Update</td>
                        <td>On/Off</td>             
                    </tr>
                </thead>
                <tbody>     
                    <?php                        
                    $resource = mysqli_query($con, "SELECT * FROM `product`");
                    while($row = mysqli_fetch_assoc($resource)){
                        $productid = $row['ProductID'];
                        $productname = $row['ProductName'];
                        $locationid = $row['LocationID'];
                        $brandid = $row['BrandID'];
                        $producttypeid = $row['ProductTypeID'];
                        $glassforid = $row['GlassForID'];
                        $framestyleid = $row['FrameStyleID'];
                        $frameshapeid = $row['FrameShapeID'];
                        $price = $row['UnitPrice'];
                        $unitinstock = $row['UnitsInStock'];
                        $unitonorder = $row['UnitsOnOrder'];
                        $status = $row['Status'];
                        echo '<tr>';
                        echo "<td width='250px'>$productname</td>";
                        echo "<td><sup>$</sup>$price</td>";
                        echo "<td>$unitinstock</td>";
                        if($status == 0){
                            echo "<td>Off</td>";
                        } else {
                            echo "<td>On</td>";
                        }  
                        echo "<td><a href='productadmin.php?detail=$productid'>Detail</a></td>";
                        echo "<td><a href='productadmin.php?update=$productid'>Update</a></td>";
                        if($status == 0){
                            echo "<td><a href='productadmin.php?delete=$productid&status=$status'>On</a></td>";
                        } else {
                            echo "<td><a href='productadmin.php?delete=$productid&status=$status'>Off</a></td>";
                        }                        
                        echo '</tr>';                        
                    }
                    ?>                                           
                </tbody>                    
            </table>
        </div>
        <div class="formproduct">
            <div class="cardHeader">
                <h2>Form Create Product</h2>                    
            </div>
            <div class="form">
                <form action="allprocessproduct.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <div class="form1">
                        <label for="productname">Product Name</label>
                        <input type="text" name="productname" id="productname"> 
                        <label for="location">Location</label>
                        <select name="location" id="location">  
                            <?php
                            echo "<option value='null'>Choose your select</option>";
                            $resource = mysqli_query($con,"SELECT * FROM `location`");           
                            while($row = mysqli_fetch_assoc($resource)){ 
                            $locationid = $row['LocationID'];  
                            $locationname = $row['LocationName'];                        
                            echo "<option value='$locationid'>$locationname</option>";                        
                            }          
                            ?>                                
                        </select>
                        <label for="brand">Brand</label>
                        <select name="brand" id="brand">   
                            <?php
                            echo "<option value='null'>Choose your select</option>";
                            $resource = mysqli_query($con,"SELECT * FROM `brand`");           
                            while($row = mysqli_fetch_assoc($resource)){                        
                            $brandid = $row['BrandID'];  
                            $brandname = $row['BrandName'];                       
                            echo "<option value='$brandid'>$brandname</option>";                        
                            }          
                            ?>                                
                        </select>
                        <label for="producttype">Product Type</label>
                        <select name="producttype" id="producttype">   
                            <?php
                            echo "<option value='null'>Choose your select</option>";
                            $resource = mysqli_query($con,"SELECT * FROM `producttype`");           
                            while($row = mysqli_fetch_assoc($resource)){  
                            $producttypeid = $row['ProductTypeID'];
                            $producttypename = $row['ProductTypeName'];                        
                            echo "<option value='$producttypeid'>$producttypename</option>";                        
                            }          
                            ?>                                
                        </select>
                        <label for="glassfor">Glass For</label>
                        <select name="glassfor" id="glassfor">   
                            <?php
                            echo "<option value='null'>Choose your select</option>";
                            $resource = mysqli_query($con,"SELECT * FROM `glassfor`");           
                            while($row = mysqli_fetch_assoc($resource)){   
                            $glassforid = $row['GlassForID'];                     
                            $glassforname = $row['GlassForName'];                        
                            echo "<option value='$glassforid'>$glassforname</option>";                        
                            }          
                            ?>                                
                        </select>
                    </div>
                    <div class="form2">
                        <label for="framestyle">Frame Style</label>
                        <select name="framestyle" id="framestyle">   
                            <?php
                            echo "<option value='null'>Choose your select</option>";
                            $resource = mysqli_query($con,"SELECT * FROM `framestyle`");           
                            while($row = mysqli_fetch_assoc($resource)){   
                            $framestyleid = $row['FrameStyleID'];            
                            $framestylename = $row['FrameStyleName'];                        
                            echo "<option value='$framestyleid'>$framestylename</option>";                        
                            }          
                            ?>                                
                        </select>
                        <label for="frameshape">Frame Shape</label>
                        <select name="frameshape" id="frameshape">   
                            <?php
                            echo "<option value='null'>Choose your select</option>";
                            $resource = mysqli_query($con,"SELECT * FROM `frameshape`");           
                            while($row = mysqli_fetch_assoc($resource)){    
                            $frameshapeid = $row['FrameShapeNameID'];                      
                            $frameshapename = $row['FrameShapeName'];                        
                            echo "<option value='$frameshapeid'>$frameshapename</option>";                        
                            }          
                            ?>                                
                        </select>
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" id="price"> 
                        <label for="unit">Unit</label>
                        <input type="number" name="unit" id="unit">                         
                    </div>
                    <?php
                    if(!$edit_status){
                        echo "<button type=\"submit\" name=\"create\" onclick=\"return confirm('Are you sure to create this new product?')\"> CREATE</button>";
                    } else {
                        echo "<button type=\"submit\" name=\"update\" onclick=\"return confirm('Are you sure to update this new product?')\"> UPDATE</button>";
                    }
                    ?>
                </form>
            </div>
        </div>
        <?php
            if(isset($_GET['detail'])){
                $id = $_GET['detail']; 
                $resource = mysqli_query($con, "SELECT `Product`.*, `Location`.`LocationName`, `Brand`.`BrandName`, `ProductType`.`ProductTypeName`, `GlassFor`.`GlassForName`, `FrameStyle`.`FrameStyleName`, `FrameShape`.`FrameShapeName` 
                FROM `Product` INNER JOIN `Location` ON `Product`.`LocationID` = `Location`.`LocationID` 
                LEFT JOIN `Brand` ON `Product`.`BrandID` = `Brand`.`BrandID`
                LEFT JOIN `ProductType` ON `Product`.`ProductTypeID` = `ProductType`.`ProductTypeID`
                LEFT JOIN `GlassFor` ON `Product`.`GlassForID` = `GlassFor`.`GlassForID`
                LEFT JOIN `FrameStyle` ON `Product`.`FrameStyleID` = `FrameStyle`.`FrameStyleID`
                LEFT JOIN `FrameShape` ON `Product`.`FrameShapeID` = `FrameShape`.`FrameShapeID` 
                WHERE `Product`.`ProductID` = $id");
                while($row = mysqli_fetch_assoc($resource)){  
                    $productname = $row['ProductName'];
                    $location = $row['LocationName'];
                    $brand = $row['BrandName'];
                    $producttype = $row['ProductTypeName'];
                    $glassfor = $row['GlassForName'];
                    $framestyle = $row['FrameStyleName'];
                    $frameshape = $row['FrameShapeName'];
                    $price = $row['UnitPrice'];
                    $unitinstock = $row['UnitsInStock'];
                    $unitonorder = $row['UnitsOnOrder'];
                    echo "<div class=\"detailproduct\">";
                    echo "<div class=\"cardHeader\">";
                    echo "<h2>Product's Detail</h2>";
                    echo "</div>";
                    echo "<p>Brand: $brand</p>";
                    echo "<p>Gender: $glassfor</p>";
                    echo "<p>Frame Style: $framestyle</p>";
                    echo "<p>Frame Shape: $frameshape</p>";
                    echo "<p>Location: $location</p>";                    
                }
                $resource = mysqli_query($con,"SELECT `color`.`ColorName`
                FROM `color` INNER JOIN
                `productcolor` ON `color`.`ColorID` = `productcolor`.`ColorID` INNER JOIN
                `product` ON `productcolor`.`ProductID` = `product`.`ProductID`
                WHERE `product`.`ProductID` = $id");    
                echo "<p>Color: ";       
                while($row = mysqli_fetch_assoc($resource)){                        
                $color = $row['ColorName'];                   
                echo "<ul>";                  
                echo "<li>$color</li>";
                echo "</ul></p>"; 
                }
                echo "<p>Image: </p>";
                $resource = mysqli_query($con,"SELECT `Image`.`ImageLink` FROM `Image` WHERE `Image`.`ProductID` = $id");
                while($row = mysqli_fetch_assoc($resource)){                        
                    $firstlink = $row['ImageLink'];                        
                    echo "<img src='$firstlink'>";                        
                }
                echo "</div>";
            }
        ?>        
        <div class="colorimage">
            <form action="productadmin.php" method="post" enctype="multipart/form-data">
                <div class="cardHeader">
                    <h2>Form Add Color And Image</h2>                    
                </div>
                <label>Select product</label>
                <select name="productchoose">   
                    <?php
                    echo "<option value='null'>Choose your select</option>";
                    $resource = mysqli_query($con,"SELECT * FROM `product`");           
                    while($row = mysqli_fetch_assoc($resource)){   
                    $productid = $row['ProductID'];            
                    $productname = $row['ProductName'];                        
                    echo "<option value='$productid'>$productname</option>";                        
                    }          
                    ?>                                
                </select>
                <label>Color</label>
                <input type="text" name="color">
                <label>Image Name</label>
                <input type="text" name="imgname">
                <label>Select image to upload</label>
                <input type="file" name="image">
                <input type="submit" name="colorimagesubmit" value="Add">
            </form>
        </div>
    </div>  
    <?php              
    echo '</div>';
    echo '<script src="js/homeadmin.js"></script>';
    ?>
</body>
</html>