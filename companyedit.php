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

if(isset($_POST["submitbtn"]))
{
    $ecname = $_POST["Company Name"];
    $eemail = $_POST["Email"];
    $elogo = $_POST["Logo"];
    $ewebsite = $_POST["Website"];

    $sql = "UPDATE `companies` SET `Company Name` = '$ecname', `Email` = '$eemail', `Logo` = '$elogo', `Website` = '$ewebsite'
     WHERE `Company Name` = '$ecname'";
    $updateresult = mysqli_query($conn, $sql);

    if($updateresult){
        $update = true;
        
    }
    else{
        echo "The record was not deleted sucessfully because of this error ---> ". mysqli_error($conn);
    }
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
    <h2>Edit a Company</h2>
    <form action="/finalassignment/index.php" method="post" enctype="multipart/form-data" >      
          
      <div class="form-group">
        <label for="Name">Company Name</label>
        <input type="text" class="form-control" id="CompanyName" name="CompanyName" aria-describedby="emailHelp" value="<?php echo $ecname; ?>">
      </div>

      <div class="form-group">
        <label for="Name">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" value="<?php echo $eemail; ?>">
      </div>

      <div class="form-group">
        <label for="img">Select Logo</label>
        <input type="file" name="uploadfile" id="uploadfile" value="<?php echo $elogo; ?>" />
      </div>
      
      <div class="form-group">
        <label for="website">Website</label>
        <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp" value="<?php echo $ewebsite; ?>">
      </div>
      
      <input type="hidden" class="form-control" id="oldcname" name="oldcname" aria-describedby="emailHelp"  value="<?php echo $ecname; ?>">
      <button type="submit" name="editsubmitbtn" class="btn btn-primary">Edit Company</button>
    </form>

  </div>
</body>
</html>