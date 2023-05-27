<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <script src="https://kit.fontawesome.com/3309153c5f.js" crossorigin="anonymous"></script>
    <title>Homepage</title> 
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <section id="slide">
        <div class="aspect-ratio-169">
            <a class="a-image" href=""><img src="images/slide1.jpg"></a>            
            <a class="a-image" href=""><img src="images/slide2.jpg"></a>
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>            
        </div>           
    </section>
    <?php
    include_once('footer.php');    
    ?>
    <script src="js/index.js"></script>
</body>
</html>