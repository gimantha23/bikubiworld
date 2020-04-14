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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>add employee</title>

		<script type="text/javascript">

		function validatePassword()
      {
      var pwd=document.getElementById('txtPwd').value;
      var cpwd=document.getElementById('txtConpwd').value;
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
			function Validate()
		  {
					if(validatePassword() && validateEmail())
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
    <form action="addEmployee.php" method="post">
      <table>
        <tr>
          <td>
   				 <label for="txtName">
   					  Name
   				 </label>
   			 </td>
          <td>
   				 <input type="text" name="txtName" id="txtName" required>
   			 </td>
        </tr>
        <tr>
          <td>
   				 <label for="txtEmail">
   					 Email
   				 </label>
   			 </td>
          <td>
   				 <input type="text" name="txtEmail" id="txtEmail" required>
   			 </td>
        </tr>
        <tr>
          <td>
   				 <label for="txtPwd">
   					 Password
   				 </label>
   			 </td>
          <td>
   				 <input type="password" name="txtPwd" id="txtPwd" required>
   			 </td>
        </tr>
        <tr>
          <td>
   				 <label for="txtConpwd">
   					 confirm password
   				 </label>
   			 </td>
          <td>
   				 <input type="password" name="txtConpwd" id="txtConpwd" required>
   			 </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="btnSubmit" value="Add employee" onclick="Validate()">
            <input type="reset" name="btnReset" value="Clear">
          </td>
        </tr>

      </table>
    </form>

    <?php
          if(isset($_POST['btnSubmit']))
              {
      				 $name = $_POST['txtName'];
               $pwd = $_POST['txtConpwd'];
               $email=$_POST['txtEmail'];

               $con1 = mysqli_connect("localhost","root","","bikubiworld");
               if(!$con1)
      					{
      						die("cannot connect to DB server");
      					}
                $sql1="INSERT INTO `employee`(`Name`, `Designation`,`email`,`password`,`status`) VALUES ('".$name."','Employee','".$email."','".$pwd."','active');";
                mysqli_query($con1,$sql1);
      				  mysqli_close($con1);
              }
       ?>
  </body>
</html>
