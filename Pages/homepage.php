<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8">
<title>Welcome to Bikubiworld</title>
<link rel="stylesheet" href="../Resources/CSS/grid.css">
<link rel="stylesheet" href="../Resources/CSS/normalize.css">
<link rel="stylesheet" href="../Stylesheets/mainStyles.css">
<link rel="stylesheet" href="../Stylesheets/navbarStyle.css">
<link rel="stylesheet" href="../Stylesheets/homestyle.css">
<link rel="stylesheet" type="text/css" href="../Resources/CSS/ionicons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">

</head>
<body>
        <header>
            <nav>
                <div class="row">
                    <img src="../Resources/assets/BKB.JPG" alt="BKB logo" class="logo">
                    <ul class="main-nav">
                        <li><a href="#">Food delivery</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Our cities</a></li>
                        <li><a href="#">Sign up</a></li>
                    </ul>
                </div>
            </nav>
        </header>
  
        <section class="section-features">
            <div class="row">
                <h2>Get food fast &mdash; not fast food</h2>
                <p class="long-copy">
                    Hello, we’re Bikubiworld, your new premium food delivery service. We know you’re always busy. No time for cooking. So let us take care of that, we’re really good at it, we promise!
                </p>
            </div>
            <div class="row">
            <h2>DISCOVER COLLECTIONS</h2>
            </div>
            <div class="row">
              <div class= "col span-1-of-2">
                <img src="../Resources/assets/babyyyyyyyyyyy.png" width="auto" height="500" alt="kids_toys">
              </div>
              <div class= "col span-2-of-2">
                <img src="../Resources/assets/boys toys.jpg" width="auto" height="250" alt="boys_toy">
                <img src="../Resources/assets/baby.jpg" width="auto" height="250">
              </div>
            </div>
        </section>

        <section class='section-products'>
        <div class='row'>
          <h2>POPULAR PRODUCTS</h2>
        </div>
        <div class='row'>
          <?php
          $con = mysqli_connect("localhost","root","","bikubiworld");
          if(!$con)
            {
             die("cannot connect to DB server");
            }
            $sql="SELECT * FROM `product` WHERE `status`='active';";
            $rowSQL= mysqli_query($con,$sql);
            $i=4;
            while(($row = mysqli_fetch_array($rowSQL)) && $i>0 ){
              echo"
              <div class='col span-1-of-4 box'>
                    <img src='".$row['pimage']."' alt='pimage'>
                    <h3>".$row['pname']."</h3>
                    <div class='product-feature'>
                    <i class='ion-ios-person icon-small'></i>
                    ".$row['pcategory']."
                    </div>
                    <div class='product-feature'>
                    <i class='ion-ios-star icon-small'></i>
                    $".$row['pprice']."
                    </div>
                    <div class='product-feature'>
                    <i class='ion-social-twitter icon-small'></i>
                    Available now!
                    </div>
              </div>";
              $i--;
            }
            ?>
        </div>
        </section>
    <div class='row'>
    <h2>WATCH THEM GROW!!</h2>
    </div>
    <div class='row'>
    <img src="../Resources/assets/cover11.jpg" width="1000" height="400">
    </div>
</body>
</html>
