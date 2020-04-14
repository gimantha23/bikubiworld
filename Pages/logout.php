<?php
session_start();
print_r($_SESSION);
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>logout</title>
   </head>
   <body>
     <form class="" action="logout.php" method="post">
       <input type="submit" name="btnLogout" value="logout">
     </form>
     <?php
     if(isset($_POST['btnLogout']))
     {
       session_destroy();
     }
      ?>
   </body>
 </html>
