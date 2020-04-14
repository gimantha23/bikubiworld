
<?php session_start();
		if(!isset($_SESSION["eno"]))
		{
			header('Location:adminLogin.php');
		}
		if($_SESSION["des"]!="Manager")
		{
			header('Location:adminLogin.php');
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>view products</title>
  </head>
  <body>
    <form action="viewProducts.php" method="post">
    <table>
      <thead>
        <th>
            Product Image
        </th>
        <th>
            Product ID
        </th>
        <th>
            Product Name
        </th>
        <th>
            price
        </th>
        <th>
            category
        </th>
        <th>
            status
        </th>
      </thead>

      <?php
        $con = mysqli_connect("localhost","root","","bikubiworld");
          if(!$con)
            {
             die("cannot connect to DB server");
            }
           $sql="SELECT * FROM `product` ORDER BY `pid` DESC;";
           $rowSQL= mysqli_query( $con,$sql);
           while($row = mysqli_fetch_array($rowSQL)){
echo "
        <tr>
          <td>
              <img src='".$row['pimage']."' width='150' height='200'>
          </td>
          <td>
              ".$row['pid']."
          </td>
          <td>
              ".$row['pname']."
          </td>
          <td>
              ".$row['pprice']."
          </td>
          <td>
              ".$row['pcategory']."
          </td>
          <td>
              ".$row['status']."
          </td>
          <td>
";
          $sts=$row['status'];
          if($sts=="active")
          {
echo"
              <input type='submit' name='".$row['pid']."' value='edit'>
";
          }
echo"
          </td>
        </tr>

";
      }

      mysqli_close($con);

      ?>

  </table>
    </form>

    <?php

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
          $_SESSION['pid']=$row['pid'];
          echo'<script> location.replace("manageProduct.php"); </script>';
        }
      }
      mysqli_close($con1);

     ?>
  </body>
</html>
