<?php session_start();
		if(!isset($_SESSION["eno"]))
		{
			header('Location:adminLogin.php');
		}
		if(!isset($_SESSION["pid"]))
		{
			header('Location:viewProducts.php');
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
    <title>Manage Product</title>
  </head>
  <body>
  <?php
  $con = mysqli_connect("localhost","root","","bikubiworld");
      if(!$con)
        {
         die("cannot connect to DB server");
        }
       $p=$_SESSION['pid'];
       $sql="SELECT * FROM `product` where `pid`='".$p."';";
       $rowSQL= mysqli_query( $con,$sql);
       $row = mysqli_fetch_assoc( $rowSQL);

echo"
    <form action='manageProduct.php' method='post' enctype='multipart/form-data'>
      <table>

        <tr>
          <td>
            <label for='txtPid'>P ID</label>
          </td>
          <td>

            <input type='text' name='txtPid' id='txtPid' value=".$row['pid']." required readonly>
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtName'>Name</label>
          </td>
          <td>
            <input type='text' name='txtName' id='txtName' value=".$row['pname']." required readonly>
          </td>
        </tr>
";
echo "
        <tr>
          <td>
            <label for='lstPcategory'>Category</label>
          </td>
          <td>
            <select name='lstPcategory' id='lstPcategory'>

                <option value=".$row['pcategory'].">
                   ".$row['pcategory']."
                </option>
";
                $cat=$row['pcategory'];
                $sql2="SELECT distinct `pcategory` FROM `product` where `pcategory` != '$cat' ;";
                $rowSQL= mysqli_query( $con,$sql2);
                while($row = mysqli_fetch_assoc( $rowSQL))
								{
echo"
                <option value='".$row['pcategory']."'>
                   ".$row['pcategory']."
                </option>
";
              	}
echo "
            </select>
          </td>
        </tr>
          ";
          $sql="SELECT * FROM `product` where `pid`='$p';";
          $rowSQL= mysqli_query( $con,$sql);
          $row = mysqli_fetch_assoc( $rowSQL);
echo"
        <tr>
          <td>
            <label for='txtPrice'>Price</label>
          </td>
          <td>
            <input type='number' name='txtPrice' id='txtPrice' value=".$row['pprice']." min='0' step='0.01' required>
          </td>
        </tr>

				<tr>
          <td>
            <label>Sizes</label>
          </td>
					<td>
";
					$size[0]="";$size[1]="";$size[2]="";
					$s=$row['psize'];
					$a=strlen("$s");
					$size=explode(",",$s);
					echo "$s <br>";
					//echo"$size[0]  -";echo"$size[1]  -";echo"$size[2]";
					//$a=print_r(strlen("$size"));
					//print_r($size);
					//echo"$a";

echo"
							<input type='checkbox' id='sizeS' name='sizeS' value='S'>
							<label for='sizeS'>S</label><br>
							<input type='checkbox' id='sizeM' name='sizeM' value='M'>
							<label for='sizeM'>M</label><br>
							<input type='checkbox' id='sizeL' name='sizeL' value='L'>
							<label for='sizeL'>L</label>

					</td>
			 </tr>
";

				$c=$row['pcolor'];
				$colors=explode(",",$c);
echo"
				<tr>
					<td>
						<label>Colors</label>
					</td>
					<td>
						<input type='color' name='color1' value='$colors[0]'> <br>
						<input type='color' name='color2' value='$colors[1]'>
					</td>
        </tr>
        
        <tr>
					<td>
						<label>Description</label>
					</td>
					<td>
          <textarea name='txtDesc' rows='6' cols='40' maxlength='100'>".$row['pdesc']."</textarea>
					</td>
				</tr>


				<tr>
          <td>
            <label for='pImage'>Image</label>
          </td>
          <td>
            <img src='".$row['pimage']."' width='150' height='200'>
						<input type='file' name='pimage' value='Change Image'>
          </td>
        </tr>

        <tr>
          <td>
            <label for='txtStatus'>status</label>
          </td>
          <td>
            <input type='text' name='txtStatus' id='txtStatus' value=" .$row['status']. " readonly>
            </td>
        </tr>

        <tr>
          <td>
              <input type='submit' name='btnUpdate' value='update'>
          </td>

          <td>
";
          $st=$row['status'];
          if($st=='active'){
echo"
              <input type='submit' name='btnDelete' id='btnDelete' value='delete'>
";
          }
echo"
        </tr>
";
            ?>
      </table>
    </form>

    <?php
		$dst=$row['pimage'];
		$ss=""; $sm=""; $sl="";
    if(isset($_POST["btnUpdate"])){
      $name=$_POST["txtName"];
      $c=$_POST["lstPcategory"];
      $price=$_POST["txtPrice"];
      $desc=$_POST["txtDesc"];
      
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
			$c1=$_POST["color1"];
			$c2=$_POST["color2"];
			$color=$c1.",".$c2;

			/*$v1=rand(1111,9999);
			$v2=rand(1111,9999);
			$v3=$v1.$v2;
			$v3=md5($v3);*/

			$fnm=($_FILES["pimage"]["name"]);
			$dst="../product_image/".$fnm;
			//$dst1="../product_image/".$v3.$fnm;
			move_uploaded_file($_FILES["pimage"]["tmp_name"],$dst);

      $con=mysqli_connect("localhost","root","","bikubiworld");
      if(!$con){
        die("Cannot connect to DB server");
      }
			if($fnm=="")
			{
				$sql3="UPDATE `product` SET `pname` = '".$name."',`pcategory`='".$c."', `pprice` = '".$price."',`pcolor`='".$color."',`psize`='".$size."',`pdesc`='".$desc."' WHERE `pid` = '".$_SESSION['pid']."'";
				mysqli_query($con,$sql3);
			}
			else
			{
      $sql4="UPDATE `product` SET `pname` = '".$name."',`pcategory`='".$c."', `pprice` = '".$price."', `pimage`='".$dst."',`pcolor`='".$color."',`psize`='".$size."',`pdesc`='".$desc."' WHERE `pid` = '".$_SESSION['pid']."'";
      mysqli_query($con,$sql4);
			}
      mysqli_close($con);
      }
      ?>

      <?php
      if(isset($_POST["btnDelete"])){
        $con=mysqli_connect("localhost","root","","bikubiworld");
        if(!$con){
          die("Cannot connect to DB server");
        }
        $sql4="UPDATE `product` SET `status` = 'inactive' WHERE `pid` = '".$_SESSION['pid']."'";
        mysqli_query($con,$sql4);
        mysqli_close($con);
        }
      ?>

  </body>
</html>
