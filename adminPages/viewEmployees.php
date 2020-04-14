<?php
    session_start();
    if(!isset($_SESSION['eno'])){
      header('Location:adminLogin.php');
    }
    if($_SESSION["des"]!="Manager")
    {
    	header('Location:adminLogin.php');
    }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>view employees</title>
  </head>
  <body>
    <form method="post" action="viewEmployees.php">

    <table>
      <thead>
        <th>
            eno
        </th>
        <th>
            Name
        </th>
        <th>
            Designation
        </th>
        <th>
            status
        </th>
      </thead>

      <?php
        $con = mysqli_connect("localhost","root","","bikubiworld");
          if(!$con)
            {
             die("cannot connect to DB server");
            }
           $sql="SELECT * FROM `employee`;";
           $rowSQL= mysqli_query( $con,$sql);
           while($row = mysqli_fetch_array( $rowSQL )){
echo "
        <tr>
          <td>
";

echo "
              ".$row['eno']."
          </td>

          <td>
              ".$row['name']."
          </td>

          <td>
              ".$row['designation']."
          </td>

          <td>
              ".$row['status']."
          </td>
          <td>
";
          $st=$row['status'];
            if($st=="active")
            {
echo"
              <input type='submit' name='".$row['eno']."' value='edit'>
";
            }
echo"
          </td>
          </tr>
";
            }
            mysqli_close($con);
            ?>

      </table>
      </form>
        <?php
          $con = mysqli_connect("localhost","root","","bikubiworld");
            if(!$con)
              {
               die("cannot connect to DB server");
              }
             $sql="SELECT * FROM `employee` WHERE `status`='active';";
             $rowSQL= mysqli_query( $con,$sql);
          while($row = mysqli_fetch_array( $rowSQL )){
            if (isset($_POST[$row['eno']])) {
              $_SESSION['eno2']=$row['eno'];
              header('Location:manageEmployee.php');
            }
          }
          mysqli_close($con);
        ?>
  </body>
</html>
