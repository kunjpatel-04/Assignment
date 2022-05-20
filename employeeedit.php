<?php
include("server1.php");
$esrno;
$efname ="";
$elname ="";
$eecompany ="";
$eeemail ="";
$ephno ="";
$employeupdate = false;
if(isset($_GET['esrno']))
{
    
    $esrno = $_GET["esrno"];
    $sql = "SELECT `First Name`, `Last Name`, `Company`, `Email`, `Phone Number` FROM `employees` WHERE `Srno.` = '$esrno'";
    $editresult = mysqli_query($conn, $sql);
  
   if($editresult){
       
    $edit = true; 
    $row = mysqli_fetch_assoc($editresult);
    // echo var_dump($row);
    $efname = $row["First Name"];
    $elname = $row["Last Name"];
    $eecompany = $row["Company"];
    $eeemail = $row["Email"];
    $ephno = $row["Phone Number"];

  }
  else{
    echo "The record was not edited sucessfully because of this error ---> ". mysqli_error($conn); 
  }
}

if(isset($_POST['editsubmitbtn']))
{
    $efname = $_POST["fname"];
    $elname = $_POST["lname"];
    $eeemail = $_POST["email"];
    $eecompany = $_POST["company"];
    $ephno = $_POST["phno"];

    $sql = "UPDATE `employees` SET `First Name` = '$efname', `Last Name` = '$elname', `Company` = '$eecompany',
    `Email` = '$eeemail', `Phone Number` = '$ephno' WHERE `Srno.` = '$esrno'";
    $editresult = mysqli_query($conn, $sql);

    if($editresult){
        $update = true;
        
    }
    else{
        echo "The record was not deleted sucessfully because of this error ---> ". mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
   
    <title>Document</title>
</head>
<body>

<div class="container my-5">
    <h2>Edit a Employee</h2>
    <form action="/finalassignment/employee.php" method="post" enctype="multipart/form-data" >      
          
      <div class="form-group">
        <label for="Name">First Name</label>
        <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" value="<?php echo $efname; ?>">
      </div>
      
      <div class="form-group">
        <label for="Name">Last Name</label>
        <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" value="<?php echo $elname; ?>">
      </div>
      
      <div class="form-group">
        <label for="Name">Company</label>
        <input type="text" class="form-control" id="company" name="company" aria-describedby="emailHelp" value="<?php echo $eecompany; ?>">
      </div>

      <div class="form-group">
        <label for="Name">Email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $eeemail; ?>">
      </div>

      <div class="form-group">
        <label for="img">Phone Number</label>
        <input type="text" name="phno" id="phno" value="<?php echo $ephno; ?>" />
      </div>
      
      <input type="hidden" class="form-control" id="esrno" name="esrno" aria-describedby="emailHelp"  value="<?php echo $esrno; ?>">
      <button type="submit" name="editsubmitbtn" class="btn btn-primary">Edit Employee</button>
    </form>

</div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
    crossorigin="anonymous"></script>
    
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>