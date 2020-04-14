<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset Customer password</title>

    <script type="text/javascript">
    function validateEmail()
      {
        var em=document.getElementById("txtEmail").value;
        var atposition=em.indexOf("@");
        var dotposition=em.lastIndexOf(".");
        //var em1=em.toLowerCase();

        if (atposition<1 || dotposition<atposition+2 || dotposition+2>=em.length)
          {
            alert("Please check the e-mail address");
            //return false;
            event.preventDefault();
          }
          else
          {
            //return true;
          }
      }
    </script>

  </head>
  <body>
    <form action="customerResetPW.php" method="post">
    <table>
      <tr>
        <td>
            <label for="txtCno">
                Cno
            </label>
        </td>
        <td>
            <input type="text" name="txtCno" id="txtCno" value="" required>
        </td>
      </tr>

      <tr>
        <td>
            <label for="txtEmail">
                Email
            </label>
        </td>
        <td>
            <input type="text" name="txtEmail" id="txtEmail" value="" required>
        </td>
      </tr>

      <tr>
        <td>
            <input type="submit" name="btnSubmit" value="Confirm" onclick="validateEmail()">
            <input type="reset" name="btnreset" value="Reset">
        </td>
      </tr>
    </table>
    </form>

    <?php
    if(isset($_POST['btnSubmit']))
    {
      $cno=$_POST['txtCno'];
      $email=$_POST['txtEmail'];
      $sql="SELECT * FROM `customer` WHERE `cno` = ".$cno." AND `email` LIKE '".$email."';";
      $con = mysqli_connect("localhost","root","","bikubiworld");
        if(!$con)
        {
          die("Error while connecting to database");
        }
        $result= mysqli_query($con,$sql);
        mysqli_close($con);
      if(mysqli_num_rows($result)>0)
        {
        $_SESSION['resetCust']=$cno;
        header('Location:customerNewPW.php');
        }
        else
        {
          echo "Employee no. and Email not matching";
        }
    }
     ?>
  </body>
</html>
