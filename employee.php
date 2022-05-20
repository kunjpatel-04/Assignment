<?php
include("server1.php");
$insert = false;
$delete = false;
if(isset($_POST["submitbtn"]))
{
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $company = $_POST["company"];
  $email = $_POST["email"];
  $phno = $_POST["phno"];

// Insertion a Company
$sql = "INSERT INTO `employees`(`First Name`, `Last Name`, `Company`, `Email`, `Phone Number`) VALUES ('$fname','$lname','$company','$email','$phno')";  
$insertresult = mysqli_query($conn, $sql);


if($insertresult){
  // echo "The record has been inserted sucessfully! <br>";
  $insert = true;
}
    else{
        echo "The record was not inserted sucessfully because of this error ---> ". mysqli_error($conn); 
    }
}
?>

    <?php
    $csql = "SELECT `Company Name` FROM `companies`";
    $cresult = mysqli_query($conn, $csql);
    $clist;
    //echo var_dump($cresult);
    if($cresult){
      // echo "The record has been inserted sucessfully! <br>";

    //  while($clist = mysqli_fetch_assoc($cresult))
    //  {
    //   echo var_dump($clist);
    //  }
    // $temp=0;
    //     while($clist = mysqli_fetch_assoc($cresult))
    //     {
    //       //echo var_dump($clist);
    //     echo "<br>";
    //     echo var_dump($clist["Company Name"]);
    //     //echo "<option value=".$clist[$temp].">".$clist[$temp]."</option>";
    //     //$temp=$temp+1;
    //     }
    }
        else{
            echo "The record was not inserted sucessfully because of this error ---> ". mysqli_error($conn); 
        }
    ?>

  <!-- Deleteing a company -->
<?php
$delete = false;

if(isset($_GET['demployee']))
{
  // echo "delete button is pressed";
  $demployee = $_GET["demployee"];
  $sql = "DELETE FROM employees WHERE `employees`.`srno.` = '$demployee'";
  $delemployee = mysqli_query($conn, $sql);

   if($delemployee){
       
    $delete = true; 
  
  }
  else{
    echo "The record was not deleted sucessfully because of this error ---> ". mysqli_error($conn); 
  }
}
?>

<!-- Editting a Employee -->
<?php
include("server1.php");
$esrno;
$efname ="";
$elname ="";
$eecompany ="";
$eeemail ="";
$ephno ="";
$update = false;
if(isset($_GET['esrno']))
{
    
    $esrno = $_GET["esrno"];
    $sql = "SELECT `First Name`, `Last Name`, `Company`, `Email`, `Phone Number` FROM `employees` WHERE `Srno.` = '$esrno'";
    $editresult = mysqli_query($conn, $sql);
  
   if($editresult){
       
    $edit = true; 
    $row = mysqli_fetch_assoc($editresult);
    echo var_dump($row);
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
    $esrno = $_POST["esrno"];

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
    
    <title>Employee</title>
</head>
<body>
    
    <?php
    if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Successfully Added!</strong> Your employee has been added successfully .
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    }

    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Successfully Deleted!</strong> Your employee has been deleted successfully .
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }

    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Successfully Updated!</strong> Your employee has been updated successfully .
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
    
    <!-- Creating a Employee -->
    <div class="container my-5">
    <h2>Add a Employee</h2>
    <form action="/finalassignment/employee.php" method="post" enctype="multipart/form-data" > 

      <div class="form-group">
        <label for="fName">First Name</label>
        <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp">
      </div>
      
      <div class="form-group">
        <!-- <label for="company">Company</label>
        <input type="text" class="form-control" id="company" name="company" aria-describedby="emailHelp"> -->
        <label for="company">Choose a Company:</label>
        <select id="company" name="company">
        <?php
        
        while($clist = mysqli_fetch_assoc($cresult))
        {
          echo "<option value=".$clist["Company Name"].">".$clist["Company Name"]."</option>";
        }
        
        ?>
         </select>
        </div>
      
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      
      <div class="form-group">
        <label for="pnno">Phone Number</label>
        <input type="text" class="form-control" id="phno" name="phno" aria-describedby="emailHelp">
      </div>
      
      
      
      
      <button type="submit" name="submitbtn" class="btn btn-primary">Add Employee</button>
    </form>

    <!-- Reading a Company -->
    <div class="container">
        <table class="table" id="myTable">
        <thead>
        <tr>
        <th scope="col">Sr No.</th>    
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Company</th>
        <th scope="col">Email</th>
        <th scope="col">Phone Number</th>
        </thead>
        </tr>
        <tbody>
        
        <?php
         $sql = "SELECT * FROM `employees`";
        $insertresult = mysqli_query($conn, $sql);
  
        while($row = mysqli_fetch_assoc($insertresult)){
            echo "<tr>
            <th scope='row'>". $row['Srno.'] ."</th>
            <td>". $row['First Name'] ."</td>
            <td>". $row['Last Name'] ."</td>
            <td>". $row['Company'] ."</td>
            <td>". $row['Email'] ."</td>
            <td>". $row['Phone Number'] ."</td>
            <td>
            <a href='employee.php?demployee=".$row['Srno.']."'>Delete</a>
            <a href='employeeedit.php?esrno=".$row['Srno.']."'>Edit</a>
            </td>            
        </tr>";
  
        }
        ?>

  
    
  </tbody>
</table>

</div>
  <hr>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
 $(document).ready( function () {
 $('#myTable').DataTable();
 } );
</script>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>