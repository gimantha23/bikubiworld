<?php
session_start();
?>
<html>
<head>
<title>Customer login</title>
</head>

<body>
<form method="post" action="customerLogin.php">
    <h1>Customer Login</h1>

     <table>
      <tr>
        <td>
          <label for="txtCno">
            cno
          </label>
        </td>
        <td>
          <input type="text" name="txtCno" id="txtCno" required>
        </td>
      </tr>

      <tr>
        <td>
          <label for="txtPwd">
            password
          </label>
        </td>
        <td>
          <input type="password" name="txtPwd" id="txtPwd" required>
        </td>
      </tr>

      <tr>
        <td>
          <input type="submit" name="btnSubmit" value="Login">
        </td>
        <td>
          <input type="reset" name="btnReset" value="Reset">
        </td>
      </tr>
    </table>
    <p>New to Bikubiworld? <a href="addCustomer.php">sign up</a> here</p>
    <p>Forgot Password? Click <a href="customerResetPW.php">here</a> to reset.</p>

</form>

<?php
	 if(isset($_POST["btnSubmit"]))
	 {
	 $cno= $_POST["txtCno"];
	 $password = $_POST["txtPwd"];

	$con = mysqli_connect("localhost","root","","bikubiworld");
		if(!$con)
		{
			die("cannot connect to DB server");
		}
		$sql = "SELECT * FROM `customer` WHERE `cno` = '".$cno."' AND `password` = '".$password."'";

  	$result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    $cno=$row['cno'];
  	if(mysqli_num_rows($result)>0)
		  {
			     $_SESSION["cno"]= $cno;
      }
    else if(mysqli_num_rows($result)<=0)
      {
				   echo "Invalid crediantials";
      }
      
    if((isset($_SESSION['cno'])) && (isset($_SESSION['shopping'])))
      {
          header('Location:shopSingle.php');
      }
    else if(isset($_SESSION['cno']))
      {
          header('Location:homepage.html');
      }
    
			mysqli_close($con);
	 }
	 ?>

</body>
</html>
