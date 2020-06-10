<?php
session_start();
if(!isset($_SESSION['cno'])){
  header('Location:customerLogin.php');
}
$con = mysqli_connect("localhost","root","","bikubiworld");
  if(!$con)
    {
      die("cannot connect to DB server");
    }
  $sql = "SELECT * FROM `customer` WHERE `cno` = '".$_SESSION['cno']."';";
  $rowSql = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($rowSql);
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" />
<title>User account</title>
</head>

<body>
<table>
<form action="userAccount.php" method="post">
<?php 
    echo"
    <p><img src='../assets/avatar.png' width='150' height='150'></p>
    <h2>".$row['cname']."<h2>";
    $fulladdress=$row['caddress'];
    $addresspart = explode(",",$fulladdress);
    echo"
    <tr>
      <td>Name</td>
      <td><input type='text' name='txtName' value='".$row['cname']."'></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td>Address</td>
      <td>
        <input name='txtAddress' id='txtAddress' type='text' value='".$addresspart[0]."' required> <br>
        <input name='txtAddress1' id='txtAddress1' type='text' value='".$addresspart[1]."' required> <br>
        <input name='txtAddress2' id='txtAddress2' type='text' value='".$addresspart[2]."' required> <br>
        <input name='txtAddress3' id='txtAddress3' type='text' value='".$addresspart[3]."' required> <br>
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type='email' name='txtEmail' value='".$row['email']."'></td>
    </tr>
    <tr>
      <td>Telephone no.</td>
      <td><input type='text' name='txtTp' value='".$row['tpno']."'></td>
    </tr>
    <tr>
    <td>Password</td>
    <td><a href='#'>Reset password</a></td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' name='btnSubmit' value='Update'</td>
    </tr>
    ";

    if(isset($_POST['btnSubmit']))
					{
						$name = $_POST['txtName'];
						$email=$_POST['txtEmail'];
						$tp=$_POST['txtTp'];
						$a1=$_POST['txtAddress'];
						$a2=$_POST['txtAddress1'];
						$a3=$_POST['txtAddress2'];
						$a4=$_POST['txtAddress3'];
            $address=$a1.",".$a2.",".$a3.",".$a4;

            $con = mysqli_connect("localhost","root","","bikubiworld");
						if(!$con)
						 {
							 die("cannot connect to DB server");
						 }
						 $sql="UPDATE `customer` SET `cname`='".$name."',`caddress`='".$address."',`tpno`='".$tp."',`email`='".$email."' WHERE `cno`=".$_SESSION['cno']."";
						 mysqli_query($con,$sql);
						 mysqli_close($con);
					
						//  header('Location:customerLogin.php');
          }
    
?>   
</form>
</table>
<p class='items'><b> Items Wishlist</b></p>
</body>
</html>
