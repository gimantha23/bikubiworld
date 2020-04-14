<?php
session_start();
?>
<html>
<head>
<title>Shop</title>
</head>

<body>
    <form action="shopAll.php" method="post">
    <?php
  	$con= mysqli_connect("localhost","root","","bikubiworld");
  	if(!$con)
  		{
  		die("Error while connecting to database");
  		}

  	$sql="SELECT * FROM `product` WHERE `status`='active';";
  	$rowsql=mysqli_query($con,$sql);
  	while($row=mysqli_fetch_array($rowsql))
      {
        echo"<div>";
  			echo"<img src='".$row['pimage']."' width='150' height='200'>"."<br>";
  			echo "".$row['pname'].""."<br>";
  			echo "Rs."." ".$row['pprice']." "."<br>";

        $sql1="SELECT *,SUM(qty) AS aqty FROM `stock` WHERE `pid`=".$row['pid']." GROUP BY `pid`;";
        $rowsql1=mysqli_query($con,$sql1);
        $row1=mysqli_fetch_assoc($rowsql1);

        $aqty=$row1['aqty'];
        //echo"$aqty";
        if($aqty <= 0 || $aqty==NULL)
          {
            echo "out of stock"."<br>";
          }
        else
          {
            echo "available: ";
            echo "".$aqty."<br>";
          }
          $rowsql1=mysqli_query($con,$sql1);
        	$row1=mysqli_fetch_array($rowsql1);

  			echo "<input type='submit' name='".$row['pid']."' value='view'> <br>";
        echo"<br>";
        echo"</div>";
  	   }


  	mysqli_close($con);
?>
    </form>


<?php
echo $aqty;
    $con1 = mysqli_connect("localhost","root","","bikubiworld");
      if(!$con1)
        {
         die("cannot connect to DB server");
        }

       $sql="SELECT * FROM `product` WHERE `status`='active';";
       $rowSQL= mysqli_query( $con1,$sql);
       while($row = mysqli_fetch_array( $rowSQL ))
          {
        if (isset($_POST[$row['pid']])) {
          $_SESSION['pno']=$row['pid'];
          header('location:shopSingle.php');
              }
          }
      mysqli_close($con1);
     ?>
</body>
</html>
