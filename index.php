<?php
include("server1.php");
$insert = false;
if(isset($_POST["submitbtn"]))
{
  $cname = $_POST["CompanyName"];
  $email = $_POST["Email"];
  $website = $_POST["website"];

  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];   
  $folder = "image/".$filename;

// Insertion a Company
$sql = "INSERT INTO `companies`(`Company Name`, `Email`, `Logo`, `Website`) VALUES ('$cname','$email','$folder','$website')";  
$insertresult = mysqli_query($conn, $sql);

if($insertresult){
  // echo "The record has been inserted sucessfully! <br>";
  $insert = true;
}
else{
  echo "The record was not inserted sucessfully because of this error ---> ". mysqli_error($conn); 
}

// Now let's move the uploaded image into the folder: image
move_uploaded_file($tempname, $folder);
    
}

?>
<!-- Deleteing a company -->
<?php
$delete = false;

if(isset($_GET['dcompany']))
{
  // echo "delete button is pressed";
  $deletecompany = $_GET["dcompany"];
  $sql = "DELETE FROM companies WHERE `companies`.`Company Name` = '$deletecompany'";
  $delcompany = mysqli_query($conn, $sql);

   if($delcompany){
       
    $delete = true; 
  
  }
  else{
    echo "The record was not deleted sucessfully because of this error ---> ". mysqli_error($conn); 
  }
}
?>

   

  <!-- Editting a Company -->
  <?php
include("server1.php");
$editcompany ;
$ecname ="";
$eemail ="";
$elogo ="";
$ewebsite ="";
$update = false;
if(isset($_GET['ecompany']))
{
    
    $ecompany = $_GET["ecompany"];
    $sql = "SELECT `Company Name`, `Email`, `Logo`, `Website` FROM `companies` WHERE `Company Name` = '$ecompany'";
    $editresult = mysqli_query($conn, $sql);
  
   if($editresult){
       
    $edit = true; 
    $row = mysqli_fetch_assoc($editresult);
    echo var_dump($row);
    $ecname = $row["Company Name"];
    $eemail = $row["Email"];
    $elogo = $row["Logo"];
    $ewebsite = $row["Website"];

  }
  else{
    echo "The record was not edited sucessfully because of this error ---> ". mysqli_error($conn); 
  }
}

if(isset($_POST['editsubmitbtn']))
{
  echo var_dump($_POST);
    $ecname = $_POST["CompanyName"];
    $eemail = $_POST["Email"];
    //$elogo = $_POST["uploadfile"];
    $ewebsite = $_POST["website"];
    $ocname = $_POST["oldcname"];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];   
    $folder = "image/".$filename;
    echo var_dump($folder);

    $sql = "UPDATE `companies` SET `Company Name` = '$ecname', `Email` = '$eemail', `Logo` = '$folder', `Website` = '$ewebsite'
     WHERE `Company Name` = '$ocname'";
//echo "<br>";
echo var_dump($sql);
    $updateresult = mysqli_query($conn, $sql);

    if($updateresult){
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


      <?php
    if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Successfully Added!</strong> Your note has been added successfully .
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    }
    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Successfully Deleted!</strong> Your company has been deleted successfully .
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }

    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Successfully Updated!</strong> Your company has been updated successfully .
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    ?>
      
      <!-- Creating a Company -->
      <div class="container my-5">
    <h2>Add a Company</h2>
    <form action="/finalassignment/index.php" method="post" enctype="multipart/form-data" >      
          
      <div class="form-group">
        <label for="Name">Company Name</label>
        <input type="text" class="form-control" id="CompanyName" name="CompanyName" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="Name">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="img">Select Logo</label>
        <input type="file" name="uploadfile" id="uploadfile" value="" />
      </div>
      
      <div class="form-group">
        <label for="website">Website</label>
        <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp">
      </div>
      
      <button type="submit" name="submitbtn" class="btn btn-primary">Add Company</button>
    </form>

    <!-- Reading a Company -->
    <div class="container ">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Company Name</th>
          <th scope="col">Email</th>
          <th scope="col">Logo</th>  
          <th scope="col">Website</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT * FROM `companies`";
      $insertresult = mysqli_query($conn, $sql);
      
      while($row = mysqli_fetch_assoc($insertresult))
      {
        echo "<tr>
        <td>". $row['Company Name'] ."</td>
        <td>". $row['Email'] ."</td>
        <td> <img height='40' width='40' src=".$row['Logo']."></td>
        <td>". $row['Website'] ."</td>
        <td>
        <a href='index.php?dcompany=".$row['Company Name']."'>Delete</a>
        <a href='companyedit.php?ecompany=".$row['Company Name']."'>Edit</a>
        </td>
      </tr>";
      }
      
      ?>
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