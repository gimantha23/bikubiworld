<?php
session_start();
if(!isset($_SESSION["pno"]))
{
  header('Location:shopAll.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Product page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Stylesheets/ratingStyle.css">
  <style>
    .checked {
    color: orange;
  }
  </style>
  </head>
  <body>
    <form action="shopSingle.php" method="post">
    <?php
    $con= mysqli_connect("localhost","root","","bikubiworld");
    if(!$con)
      {
      die("Error while connecting to database");
      }

      $sql1="SELECT * FROM `stock` WHERE `pid`='".$_SESSION['pno']."';";
      $rowsql1=mysqli_query($con,$sql1);
      $row1=mysqli_fetch_assoc($rowsql1);
      $aqty=$row1['qty'];

      $sql="SELECT * FROM `product` WHERE `pid`='".$_SESSION['pno']."';";
      $rowsql=mysqli_query($con,$sql);
      $row=mysqli_fetch_array($rowsql);

        echo"<div>";
                echo "<div class='pimage-box'>";
                      echo"<img src='".$row['pimage']."' width='300' height='400'>"."<br>";
                echo "</div>";
            echo "".$row['pname'].""."<br>";
            echo "Rs."." ".$row['pprice']." "."<br>";
            echo "SKU: "." ".$row['pid']." "."<br>";
            echo "Sizes: "." ".$row['psize']." "."<br>";
            echo "Colors:<br>";
            $c=$row['pcolor'];
            $colors=explode(",",$c);
            echo "<input type='color' name='color1' value='$colors[0]' disabled name='favcolor'>";
            //$a=print_r(strlen("$size"));
            if(strlen("$c")>1)
              echo "<input type='color' name='color2' value='$colors[1]' disabled name='favcolor'><br>";
            else
              echo"<br>";

              $sql1="SELECT *,SUM(qty) AS aqty FROM `stock` WHERE `pid`='".$_SESSION["pno"]."';";
              $rowsql1=mysqli_query($con,$sql1);
              $row1=mysqli_fetch_assoc($rowsql1);
              $aqty=$row1['aqty'];
              if($aqty>0)
                echo "Available: $aqty <br>";
              else
                echo"Out of Stock <br>";
            //$_SESSION['aqty']=$aqty;
            if(isset($_SESSION['cno']))
            {   if($aqty>0)
                  {
                    echo "Quantity: <input type='number' name='txtQty' value='1' min='1' max='$aqty' step='1' required> <br>";
                    echo "<input type='submit' name='btnaddtoCart' value='Add to Cart'>";
                  }
                echo "<input type='submit' name='btnaddtoWl' value='Add to Wishlist'>"."<br>";
                echo"<a href='cart.php'>View cart</a>";
                echo "<br>";
            }
            else
            {
                echo"please <a href='customerLogin.php'>log in</a> to shop this item";
                $_SESSION['shopping']=1;
            }
        echo "</div>";
    mysqli_close($con);
  ?>
    </form>
    <?php
      if (isset($_POST['btnaddtoCart']))
      {
        $con1= mysqli_connect("localhost","root","","bikubiworld");
        if(!$con1)
          {
          die("Error while connecting to database");
          }
          $qty=$_POST['txtQty'];
          $cno=$_SESSION['cno'];
          $pnum=$_SESSION['pno'];

            $sql="INSERT INTO `cart` (`cartno`, `cno`, `pid`, `qty`) VALUES (NULL, '".$cno."', '".$pnum."', '".$qty."')";
            mysqli_query($con1,$sql);
      }

      if(isset($_POST['btnaddtoWl']) && !isset($_SESSION['WL']))
        {
          $con1= mysqli_connect("localhost","root","","bikubiworld");
            if(!$con1)
              {
              die("Error while connecting to database");
              }
          $sql2="INSERT INTO `wishlist` (`wno`, `cno`, `pid`) VALUES (NULL, ".$_SESSION['cno'].", ".$_SESSION['pno'].")";
          mysqli_query($con1,$sql2);
          $_SESSION['WL']=$_SESSION['pno'];
          echo"<a href='wishlist.php'>View Wishlist</a>";
        }
      else if(isset($_POST['btnaddtoWl']) && isset($_SESSION['WL']))
      {
        echo "Item is Already in your Wishlist <br>";
        echo"<a href='wishlist.php'>View Wishlist</a>";
      }

     ?>
    <form action="shopSingle.php" method="post">
    <?php
        if(isset($_SESSION["cno"]))
          {
  echo"
            <fieldset class='rating' name='rating'>
            <legend>Please rate:</legend>
            <input type='radio' id='star5' name='rating' value='5' /> <label for='star5'>5 stars</label>
            <input type='radio' id='star4' name='rating' value='4' /> <label for='star4'>4 stars</label>
            <input type='radio' id='star3' name='rating' value='3' /> <label for='star3'>3 stars</label>
            <input type='radio' id='star2' name='rating' value='2' /> <label for='star2'>2 stars</label>
            <input type='radio' id='star1' name='rating' value='1' /> <label for='star1'>1 star</label>
            </fieldset>
        <div class='clearfix'></div>
        Write A Review
        <div class='clearfix'></div>
            <textarea name='txtReview' id='txtReview' cols='70' rows='10' maxlength='250'></textarea><br>     
            <p>Posting as cno  $_SESSION[cno] </p>
            <input type='submit' name='btnPost' id='btnPost' value='Post review'>
    ";
    echo"";
         }
    ?>   
    <?php 
      if(isset($_POST['btnPost']))
      {
        $con2 = mysqli_connect("localhost","root","","bikubiworld");
            if(!$con2)
              {
              die("Error while connecting to database");
              }
        $re=$_POST['txtReview'];
        $star=$_POST['rating'];
        $sqla="INSERT INTO `review` (`rno`, `cno`, `pid`, `rtext`, `rating`, `date`) VALUES (NULL, '".$_SESSION['cno']."', '".$_SESSION['pno']."','".$re."', '".$star."' ,CURDATE() )";
        mysqli_query($con2,$sqla);
      }
    ?>
    </form>

    <form action="shopSingle.php" method="post">
    <?php
  	    $conb= mysqli_connect("localhost","root","","bikubiworld");
  	      if(!$conb)
  		      {
  		        die("Error while connecting to database");
  		      }

        $sqlb="SELECT * FROM `review` WHERE `pid`='".$_SESSION['pno']."';";
        $rowsqlb=mysqli_query($conb,$sqlb);
        if(mysqli_num_rows($rowsqlb)>0)
        {
          echo"<h3>User reviews</h3>";
        }
        else
        {
          echo"<h3>User reviews</h3>";
          echo "No reviews posted yet for this item";
        }
        while($rowb=mysqli_fetch_array($rowsqlb)){
            $rating=$rowb['rating'];
            for ($i=0; $i < $rating ; $i++){
              echo"<span class='fa fa-star checked'></span>";
            }
            for ($i=0; $i < (5-$rating) ; $i++){
            echo"<span class='fa fa-star'></span>";
            }
            echo"<br>";
            echo"<textarea name='r' id='r' cols='30' rows='5'> $rowb[rtext] </textarea> <br>";
            if(isset($_SESSION['cno']))
              {
                echo"<p> Posted by: $rowb[cno] on $rowb[date] </p> ";
              }
            }
    ?>
    </form>
  </body>
</html>
