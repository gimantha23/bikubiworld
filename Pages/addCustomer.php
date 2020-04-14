<?php
session_start();
 ?>
<html>
<head>
<title>Create account</title>

<script type="text/javascript">

				function validatePassword()
					{
					var pwd=document.getElementById('txtPassword').value;
					var cpwd=document.getElementById('txtConpassword').value;
					if((pwd.length < 3) || (pwd != cpwd))
						{
							alert("Please enter a correct Password and Confirm password");
							return false;
						}
					else
						{
						return true;
						}
					}

				function validateEmail()
					{
						var em=document.getElementById("txtEmail").value;
						var atposition=em.indexOf("@");
						var dotposition=em.lastIndexOf(".");
						var em1=em.toLowerCase();

						if (atposition<1 || dotposition<atposition+2 || dotposition+2>=em1.length)
							{
							alert("Please enter a valid e-mail address");
							return false;
							}
						else
							{
							return true;
							}
					}

					function validateTp()
					{
						var tp=document.getElementById("txtTp").value;
							if(tp.length < 10 || isNaN(tp))
							{
								alert("Please enter a valid contact number");
								return false;
							}
							else
							{
								return true;
							}
					}

					function Validate()
					{
							if(validatePassword() && validateEmail() && validateTp())
							{
							}
							else
							{
								event.preventDefault();
							}
					}
</script>
</head>

<body>

 <h2>Create an account</h2>
  <form action="addCustomer.php" method="post">
 	<table border="1">

   <tr>
     <td>
			 <label for="txtName">Name</label>
		 </td>
     <td>
			 <input name="txtName" id="txtName" type="text" required>
		 </td>
   </tr>

	 <tr>
	 	<td>
		 <label for="txtAddress">Address</label>
	 	</td>
     <td>
			 <input name="txtAddress" id="txtAddress" type="text" required placeholder="enter street address"><br>
			 <input name="txtAddress1" id="txtAddress1" type="text" required placeholder="enter city"><br>
			 <input name="txtAddress2" id="txtAddress2" type="text" required placeholder="enter state/province/region"><br>
			 <input name="txtAddress3" id="txtAddress3" type="text" required placeholder="enter zip code"><br>
		 </td>
   </tr>

	 <tr>
	 	 <td>
		 	<label for="txtEmail">Email</label>
	 	 </td>
     <td>
			 <input name="txtEmail" id="txtEmail" type="text" required>
		 </td>
   </tr>

	 <tr>
	 	 <td>
		 	<label for="txtTp">Telepone no.</label>
	 	 </td>
     <td>
			 <input name="txtTp" id="txtTp" type="text" required>
		 </td>
   </tr>

   	<tr>
		 <td>
 		 <label for="txtPassword">Password</label>
 			</td>
    	<td>
			<input name="txtPassword" id="txtPassword" type="password" required>
			</td>
    </tr>

    <tr>
			<td>
			<label for="txtConpassword">Confirm Password</label>
		 </td>
    <td>
			<input name="txtConpassword" id="txtConpassword" type="password" required>
		</td>
    </tr>

    <tr>
    	<td colspan="2">
			<input name="btnSubmit" id="btnSubmit" type="submit" value="Create account" onclick="Validate()">
      <input name="btnReset" type="reset" >
      </td>
   </tr>

</table>
 </form>

 		<?php
			 if(isset($_POST['btnSubmit']))
					{
						$name = $_POST['txtName'];
						$pwd = $_POST['txtConpassword'];
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
						 $sql="INSERT INTO `customer` (`cno`, `cname`, `caddress`, `tpno`, `email`,`password`,`status`) VALUES (NULL, '".$name."', '".$address."', '".$tp."', '".$email."','".$pwd."','active');";
						 mysqli_query($con,$sql);
						 mysqli_close($con);
					
						 header('Location:customerLogin.php');
					}
					 
		?>


</body>
</html>
