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
	<title>Add product</title>
	<script type="text/javascript">
		function validateCategory()
		{
			var c=document.getElementById('lstPcategory').value;
			if (c=="------------")
			{
				alert("please select a category");
				event.preventDefault();
			}
		}
	</script>
</head>
 <h2> Add product  </h2>
<body>
 <form method="post" action="addProduct.php" enctype="multipart/form-data">
   <table border="1">
     <tr>
       <td>
				 <label for="txtPname">
					 Product name
				 </label>
			 </td>
       <td>
				 <input type="text" name="txtPname" id="txtPname" required>
			 </td>
     </tr>

     <tr>
       <td>
				 <label for="lstPcategory">
					 Product category
				 </label>
			 </td>
			 <td>
       <select name="lstPcategory" id="lstPcategory">
       <option value="------------">------------</option>
       <option value="A">A</option>
       <option value="B">B</option>
       <option value="C">C</option>
       </select>
       </td>
     </tr>

     <tr>
       <td>
				 <label for="txtPrice">
					 Price
				 </label>
			 </td>
       <td>
				 <input type="number" name="txtPrice" id="txtPrice"  min="1" step="0.1" required>
			 </td>
     </tr>

		 <tr>
       <td>
				 <label>
					 Sizes
				 </label>
			 </td>
       <td>
				  <input type="checkbox" id="sizeS" name="sizeS" value="S">
				  <label for="sizeS">S</label><br>
				  <input type="checkbox" id="sizeM" name="sizeM" value="M">
				  <label for="sizeM">M</label><br>
				  <input type="checkbox" id="sizeL" name="sizeL" value="L">
				  <label for="sizeL">L</label><br>
			 </td>
     </tr>

		 <tr>
       <td>
				 <label for="c1">
					 Colors
				 </label>
			 </td>
       <td>
				 <input type="color" name="c1"><br>
				 <input type="color" name="c2">
			 </td>
     </tr>

		 <tr>
       <td>
				 <label for="txtDesc">
					 Description
				 </label>
			 </td>
       <td>
				 <textarea name="txtDesc" rows="6" cols="40" maxlength="100"></textarea>
			 </td>
     </tr>

     <tr>
       <td>
				 <label for="pimage">
					 Product image
				 </label>
			 </td>
       <td>
				 <input type="file" name="pimage" id="pimage" required>
			 </td>
     </tr>

     <tr>
       <td>
       <input type="submit" name="btnSubmit" value="Add product" onclick="validateCategory()">
			 <input type="reset" name="btnReset" value="Clear">
       </td>
     </tr>
   </table>
 </form>
</body>
</html>


<?php
		$con= mysqli_connect("localhost","root","","bikubiworld");
		if(!$con)
		{
			die("Error while connecting to database");
		}

		if(isset($_POST["btnSubmit"]))
		{
			$ss=""; $sm=""; $sl="";
			$name=$_POST["txtPname"];
			$category=$_POST["lstPcategory"];
			$price=$_POST["txtPrice"];
			$des=$_POST['txtDesc'];
				if(isset($_POST["sizeS"]))
					$ss=$_POST["sizeS"];
				if(isset($_POST["sizeM"]))
					$sm=$_POST["sizeM"];
				if(isset($_POST["sizeL"]))
					$sl=$_POST["sizeL"];

			$size=$ss.",".$sm.",".$sl;
			if($size==",,"||$size==",")
				{
					$size=NULL;
				}
					/*if(!isset($_POST["sizeM"]))
						$size=$ss.",".$sl;
					else if
						$size=$ss.",".$sm.",".$sl;

					else if(!isset($_POST["sizeL"]))
						$size=$ss.",".$sm;
					else
						$size=$ss.",".$sm.",".$sl;*/

			$c1=$_POST["c1"];
			$c2=$_POST["c2"];
			$color=$c1.",".$c2;
			$img=$_FILES["pimage"];

			$v1=rand(1111,9999);
			$v2=rand(1111,9999);
			$v3=$v1.$v2;
			$v3=md5($v3);

			$fnm=($_FILES["pimage"]["name"]);
			$dst="../product_image/".$v3.$fnm;
			//$dst1="../product_image/".$v3.$fnm;
			move_uploaded_file($_FILES["pimage"]["tmp_name"],$dst);

			$sql="INSERT INTO `product` (`pid`, `pname`, `pcategory`, `pprice`,`psize`,`pcolor`,`pdesc`,`pimage`, `status`)
			VALUES (NULL, '".$name."','".$category."', '".$price."','".$size."','".$color."','".$des."','".$dst."', 'active');";
			mysqli_query($con,$sql);
			mysqli_close($con);
		}
?>
