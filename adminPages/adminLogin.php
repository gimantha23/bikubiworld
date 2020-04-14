<?php
session_start();
?>
<html>
<head>
<title>Admin login</title>
</head>

<body>
<form method="post" action="adminLogin.php">
    <h1>Admin Login</h1>

     <table>
      <tr>
        <td>
          <label for="txtEno">
            eno
          </label>
        </td>
        <td>
          <input type="text" name="txtEno" id="txtEno" required>
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
    <p>Forgot Password? Click <a href="adminResetPW.php">here</a> to reset.</p>

</form>

<?php
	 if(isset($_POST["btnSubmit"]))
	 {
	 $e = $_POST["txtEno"];
	 $password = $_POST["txtPwd"];

	$con = mysqli_connect("localhost","root","","bikubiworld");
		if(!$con)
		{
			die("cannot connect to DB server");
		}
		$sql = "SELECT * FROM `employee` WHERE `eno` = '".$e."' AND `password` = '".$password."'";

	$result= mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $eno=$row['eno'];
  $des=$row['designation'];
	if(mysqli_num_rows($result)>0)
		{
			$_SESSION["eno"]= $eno;
      $_SESSION["des"]= $des;
      header('Location:dashboardAdmin.php');
		}
		else
    {
				echo "Invalid crediantials";
		}
			mysqli_close($con);
	 }
	 ?>

</body>
</html>
