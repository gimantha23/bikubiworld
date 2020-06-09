<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8">
<title>Contact Us</title>
<link rel="stylesheet" href="contactStyle.css">
</head>

<body>
<h1>Contact Us</h1>
<form action="contact.php" method="post">
  <table>
    <tr>
        <td><label for="txtName">Name</label></td>
        <td><input type="text" name="txtName" id="txtName" required></td>
    </tr>
    <tr>        
        <td><label for="txtEmail">Email</label></td>			
        <td><input type="email" name="txtEmail" id="txtEmail" required></td>
    </tr>
    <tr>    
        <td><label for="txtMsg">Message</label></td>
        <td><textarea name="txtMsg" id="txtMsg" cols="50" rows="10" required></textarea></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="btnSubmit" value="Send Message"></td>
    </tr>
  </table>
</form> 
<?php
  if(isset($_POST['btnSubmit'])){
    $name=$_POST['txtName'];
    $email=$_POST['txtEmail'];
    $msg=$_POST['txtMsg'];
    $con=mysqli_connect('localhost','root','','bikubiworld');
    if(!$con)
      {
       die("cannot connect to DB server");
      }
    $sql="INSERT INTO `message`(`mno`, `name`, `email`, `msg`, `date`) VALUES (NULL,'".$name."','".$email."','".$msg."',CURDATE());";
    mysqli_query($con,$sql);
    
    $mailtxt = "Hi $name, We received your message. Thank you for your interest in Bikubiworld \r\n Team Bikubiworld";
    mail($email, "We Received your message", $mailtxt);
  }
?>
</body>
</html>
