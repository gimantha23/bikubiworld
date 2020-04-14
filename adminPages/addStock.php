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
    <title>Add stocks</title>
    <script type="text/javascript">
      function validateItemno()
      {
        var pno=document.getElementById("lstProduct").value;
				if (pno=="----------")
				{
					alert("please select a product id");
					event.preventDefault();
				}
      }
    </script>
  </head>

  <body>
    <form action="addStock.php" method="post">
      <table>

        <tr>
          <td>
            <label for="lstProduct">
                Select product
            </label>
          </td>
          <td>
            <select name="lstProduct" id="lstProduct">
              <option value="----------">----------</option>
              <?php
              $con=mysqli_connect("localhost","root","","bikubiworld");
              if(!$con)
                {
                  die("cannot connect to DB server");
                }
              $sql="SELECT * FROM `product` ORDER BY `pid` ASC;";
              $rowSQL=mysqli_query($con,$sql);
              while($row=mysqli_fetch_array($rowSQL))
                {
                  echo "<option value=".$row['pid'].">".$row['pid']." -".$row['pname']."</option>";
                }
               ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>
            <label for="txtQty">
                Quantity
            </label>
          </td>
          <td>
            <input type="number" name="txtQty" value="txtQty" step="1" required>
          </td>
        </tr>

        <tr>
          <td>
            <label for="txtRemark">
                Remarks
            </label>
          </td>
          <td>
            <textarea name="txtRemark" rows="4" cols="25" maxlength="100" placeholder="if any Remarks"></textarea>
          </td>
        </tr>

        <tr>
          <td>
            <input type="submit" name="btnAdd" value="Add stocks" onclick="validateItemno()">
          </td>
          <td>
            <input type="reset" name="btnReset" value="Clear">
          </td>
        </tr>
      </table>
    </form>

		<?php

		if(isset($_POST['btnAdd']))
		{
			$pid=$_POST['lstProduct'];
			$qty=$_POST['txtQty'];
			$rem=$_POST['txtRemark'];

			$sql1="INSERT INTO `stock` (`pid`, `qty`, `date`, `remarks`) VALUES ('".$pid."', '".$qty."',CURDATE(), '".$rem."')";
			mysqli_query($con,$sql1);
			mysqli_close($con);
		}
		?>

  </body>
</html>
