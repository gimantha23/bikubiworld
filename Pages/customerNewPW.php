<?php
session_start();
if(!isset($_SESSION['resetCust']))
  {
    header('Location:customerResetPW.php');
  }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>create new password</title>

     <script type="text/javascript">
     function validatePassword()
       {
       var pwd=document.getElementById('txtPwd').value;
       var cpwd=document.getElementById('txtconPwd').value;
       if((pwd.length < 3) || (pwd != cpwd))
         {
 			alert("Please enter a valid Password and Confirm password");
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
     <body>
       <form action="customerNewPW.php" method="post">
       <table>
         <tr>
           <td>
               <label for="txtpwd">
                   new Password
               </label>
           </td>
           <td>
               <input type="password" name="txtPwd" id="txtPwd" value="" required>
           </td>
         </tr>

         <tr>
           <td>
               <label for="txtconPwd">
                   confirm new password
               </label>
           </td>
           <td>
               <input type="password" name="txtconPwd" id="txtconPwd" value="" required>
           </td>
         </tr>

         <tr>
           <td>
               <input type="submit" name="btnSubmit" value="Confirm" onclick="validatePassword()">
               <input type="reset" name="btnreset" value="Reset">
           </td>
         </tr>
       </table>
     </form>

     <?php
         if(isset($_POST['btnSubmit']))
       {
        $cpwd = $_POST['txtconPwd'];

        $con1 = mysqli_connect("localhost","root","","bikubiworld");
        if(!$con1)
         {
           die("cannot connect to DB server");
         }
         $sql1="UPDATE `customer` SET `password` = '".$cpwd."' WHERE `customer`.`cno` = '".$_SESSION['resetCust']."'";
         mysqli_query($con1,$sql1);
         mysqli_close($con1);
         header('Location:customerLogin.php');
       }

      ?>
   </body>
 </html>
