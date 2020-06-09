<?php 
    session_start();
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
<html>
  <head>
    <meta charset="utf-8">
    <title>User Messages</title>
  </head>
<body>
    <table>
<?php
    $con = mysqli_connect("localhost","root","","bikubiworld");
    if(!$con)
      {
       die("cannot connect to DB server");
      }
    $sql="SELECT * FROM `message`;";
    $rowSql=mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($rowSql)){
        echo"<tr><td>From: ".$row['name']."</td></tr>";
        echo"<tr><td>".$row['email']."</td></tr>";
        echo"<tr><td>".$row['msg']."</td></tr>";
    }
?>
</table>
</body>
</html>