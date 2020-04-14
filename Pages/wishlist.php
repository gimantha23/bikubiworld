<?php
session_start();
if(!isset($_SESSION["cno"]))
{
  header('Location:customerLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist</title>
</head>
<body>
  <form action="wishlist.php" method="post">
    <table border="1">
          <tr>
            <th> Product </th>
            <th> Price </th>
            <th> Status </th>
            <th>  </th>
          </tr>
      <?php
      $con= mysqli_connect("localhost","root","","bikubiworld");
        if(!$con)
        {
          die("Error while connecting to database");
        }
      $sql="SELECT DISTINCT `pid` FROM `wishlist` WHERE `cno`='".$_SESSION['cno']."'";
      $rowsql=mysqli_query($con,$sql);
      while($row=mysqli_fetch_array($rowsql))
        {
          $sql1="SELECT * FROM `product` WHERE `pid`='".$row['pid']."';";
          $rowsql1=mysqli_query($con,$sql1);
          $row1=mysqli_fetch_array($rowsql1);

            $sql2="SELECT *,SUM(qty) AS aqty FROM `stock` WHERE `pid`='".$row['pid']."';";
            $rowsql2=mysqli_query($con,$sql2);
            $row2=mysqli_fetch_array($rowsql2);
            $s=0;
          echo"
          <tr>
            <td>
              <img src='$row1[pimage]' width='150' height='150'> <br>
              $row1[pname] <br>
              SKU:$row1[pid]
            </td>
            <td>
            $row1[pprice]
            </td>
            <td>
            ";
              $s=$row2['aqty'];
              if($s>0)
                echo"In stock";
              else
                echo"Out of Stock";
            echo"
            </td>
            <td>";
              if($s>0)
                echo"<input type='submit' name='shop".$row1['pid']."' value='Shop item'>";
              else
                echo"<input type='submit' name='shop".$row1['pid']."' value='View item'>
            </td>";
            if(isset($_POST['shop'.$row1['pid']]))
            {
              $_SESSION['pno']=$row1['pid'];
              header('Location:shopSingle.php');
            }
          echo"</tr>";
                      
        }
      ?>
    </table>
  </form>
  
</body>
</html>