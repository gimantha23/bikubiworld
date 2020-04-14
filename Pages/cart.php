<?php
session_start();
if(!isset($_SESSION["cno"]))
{
  header('Location:customerLogin.php');
}
if(!isset($_SESSION["pno"]))
{
  header('Location:shopAll.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping cart</title>
</head>

<body>
<h1 align="center">Shopping cart</h1>
  <form action="cart.php" method="post">

  	
          <?php
            $con= mysqli_connect("localhost","root","","bikubiworld");
              if(!$con)
                {
                    die("Error while connecting to database");
                }
                $sql="SELECT `cno`,`pid`,SUM(qty) AS cartqty FROM `cart` WHERE `cno`='".$_SESSION['cno']."'  GROUP BY `cno`,`pid` HAVING SUM(qty)>0";
                $rowsql=mysqli_query($con,$sql);
                //$row=mysqli_fetch_array($rowsql);
                $s=0;
                  if(mysqli_num_rows($rowsql)>0)
                {  
echo"
                    <table align='center' border='1'>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price(Rs.)</th>
                        <th>Quantity</th>
                        <th>Total(Rs.)</th>
                        <th>Edit Quantity</th>
                        <th>Remove</th>
                    </tr>
                    <tr>
";
                
                      while($row=mysqli_fetch_array($rowsql))
                        {
                      $sql1="SELECT * FROM `product` WHERE `pid`='".$row['pid']."';";
                      $rowsql1=mysqli_query($con,$sql1);
                      
                      while($row1=mysqli_fetch_array($rowsql1))
                        {
                          $sql2="SELECT *,SUM(qty) AS aqty FROM `stock` WHERE `pid`=".$row['pid'].";";
                          $rowsql2=mysqli_query($con,$sql2);
                          $row2=mysqli_fetch_assoc($rowsql2);
                          //available qty
                          $aqty=$row2['aqty'];
                          $q=$row['cartqty'];
                          $p=$row1['pprice'];
echo"
                        <td><img src='".$row1['pimage']."' width='85' height='85' /> </td>
                        <td>".$row1['pname']."</td>
                        <td>".$row1['pprice']."</td>
                        <td>".$row['cartqty']."</td>
                        <td>".$tot=$p*$q."</td>
";
                        $s=$s+$p*$q;

echo"                  
                        <td><input type='number' name='".$row['pid']."' min='0' max='".$row2['aqty']."' step='1' ></td>
                      
                        <td>
                            <input type='submit' name='update".$row['pid']."' value='Update cart'><br>
                            <input type='submit' name='remove".$row['pid']."' value='Remove item'>
";
                            if (isset($_POST['update'.$row['pid']]))
                            { 
                              $eqty=$_POST[$row['pid']];
                              $cqty=$row['cartqty'];
                                if($eqty == $cqty)
                                  {
                                    
                                  }
                                else if($eqty == 0)
                                  {
                                    $cqty=0-$eqty;
                                  }
                                else
                                  {
                                    $cqty=$eqty - $cqty;
                                  }
                                  mysqli_query($con,"INSERT INTO `cart`(`cartno`, `cno`, `pid`, `qty`) VALUES (NULL,'".$_SESSION["cno"]."',".$row['pid'].",".$cqty.")");
                            }

                            if (isset($_POST['remove'.$row['pid']]))
                            {
                              mysqli_query($con,"INSERT INTO `cart`(`cartno`, `cno`, `pid`, `qty`) VALUES (NULL,'".$_SESSION["cno"]."',".$row['pid'].",'-".$row['cartqty']."')");
                            }
                            
echo"                      
                        </td>
                    </tr>
";
                        }
                      }
echo"  
                    <tr>
                        <td>
                          <input type='submit' name='btnShop' value='Continue shopping'>
                        </td>
                    </tr> 
";       
              ?>
              </form>
              <?php
              if (isset($_POST['btnShop'])) {
                header('location:shopAll.php');
              }
              ?>
            </table>

            <?php
echo"
            <table align='center' border='0'>
              <tr>
                <th colspan='2'>Cart totals</th>
              </tr>
              <tr>
                <td>
                    <label>
                      Sub total
                    </label>
                </td>
                <td>
                    <label>
                      Rs. $s
                    </label>
                </td>
              </tr>
              <tr>
                <td>
                    <label>
                      Total
                    </label>
                </td>
                <td>
                    <label>
                      Rs. $s
                    </label>
                </td>
              </tr>
                <td colspan='2'>
                    <input name='btnCheckout' type='submit' value='Proceed to checkout'>
                </td>
              </tr>
            </table>
            ";
          }
          else
          {
            echo"<h3 align='center'>YOUR CART IS EMPTY</h3>";
            echo"<h3 align='center'><a href='shopAll.php'>Start Shopping</a></h3>";
          }      
?>
  </body>
</html>
