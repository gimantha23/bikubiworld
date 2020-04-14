<?php
    session_start();
    if(!isset($_SESSION['eno'])){
      header('Location:adminLogin.php');
    }
    else if (!isset($_SESSION['eno2'])) {
    header('Location:viewEmployees.php');
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage employee</title>

    <script type="text/javascript">

    function validatePassword()
      {
      var pwd=document.getElementById('txtPwd').value;
      if((pwd.length < 3))
        {
            alert("Please enter a strong password");
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
            event.preventDefault();
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
    <?php
      $con = mysqli_connect("localhost","root","","bikubiworld");
        if(!$con)
          {
           die("cannot connect to DB server");
          }
          $eno2=$_SESSION['eno2'];
         $sql="SELECT * FROM `employee` where `eno`='$eno2';";
         $rowSQL= mysqli_query( $con,$sql);
         $row = mysqli_fetch_assoc( $rowSQL);
    echo"
        <form action=\"manageEmployee.php\" method=\"post\">
        <table>

        <tr>
          <td>
            <label for='txtEno'>Eno</label>
          </td>
          <td>
            <input type='text' name='txtEno' id='txtEno' value=" .$row['eno']. " required readonly>
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtName'>Name</label>
          </td>
          <td>
            <input type=\"text\" name=\"txtName\" id=\"txtName\" value=" .$row['name']. " required>
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtDes'>Designation</label>
          </td>
          <td>
            <input type=\"text\" name=\"txtDes\" id=\"txtDes\" value=" .$row['designation']. " required readonly>
";
            $desg = $row['designation'];
            if($desg=='Employee')
            {
  echo"
            <input type = \"submit\" name=\"btnPromote\" value=\"promote\">
";
            }
echo"
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtEmail'>Email</label>
          </td>
          <td>
            <input type=\"text\" name=\"txtEmail\" id=\"txtEmail\" value=" .$row['email']. " required>
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtPwd'>Password</label>
          </td>
          <td>
            <input type=\"text\" name=\"txtPwd\" id=\"txtPwd\" value=" .$row['password']. " required>
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtStatus'>Status</label>
          </td>
          <td>
            <input type=\"text\" name=\"txtStatus\" id=\"txtStatus\" value=" .$row['status']. " required readonly >
          </td>
        </tr>

        <tr>
          <td>
            <input type=\"submit\" name=\"btnUpdate\" id=\"btnUpdate\" value=\"update\" onclick='Validate()'>
          </td>
          ";
          $st=$row['status'];
          $con3=mysqli_connect("localhost","root","","bikubiworld");
          if(!$con3){
            die("Cannot connect to DB server");
          }

echo"
          <tr>
             <td>
";

          if($st=='active'){
echo"
              <input type='submit' name='btnDelete' id='btnDelete' value='delete'>
";
          }

    mysqli_close($con);
     ?>

                </td>
            </tr>
          </table>
     </form>

     <?php
     if(isset($_POST["btnUpdate"])){
       $name=$_POST["txtName"];
       $pass=$_POST["txtPwd"];
       $email=$_POST["txtEmail"];
       $con=mysqli_connect("localhost","root","","bikubiworld");
       if(!$con){
         die("Cannot connect to DB server");
       }

       $sql1="UPDATE `employee` SET `name` = '".$name."',`password` = '".$pass."',`email` = '".$email."' WHERE `eno` = '".$_SESSION['eno2']."'";
       mysqli_query($con,$sql1);
       mysqli_close($con);
       }
       ?>

     <?php
     if(isset($_POST["btnDelete"])){
       $con=mysqli_connect("localhost","root","","bikubiworld");
       if(!$con){
         die("Cannot connect to DB server");
       }
       $sql3="UPDATE `employee` SET `status` = 'inactive' WHERE `eno` = '".$_SESSION['eno2']."'";
       mysqli_query($con,$sql3);
       mysqli_close($con);
       //echo "deleted";
       }
        ?>

        <?php

      if(isset($_POST["btnPromote"])){
        //echo "promoted";
        $con=mysqli_connect("localhost","root","","bikubiworld");
        if(!$con){
          die("Cannot connect to DB server");
        }
        $sql4="UPDATE `employee` SET `designation` = 'Manager' WHERE `eno` = '".$_SESSION['eno2']."'";
        mysqli_query($con,$sql4);
        mysqli_close($con);

        }
        ?>
  </body>
</html>
