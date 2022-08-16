<?php

$servername = "localhost";
$username = "root";
$password = "hodn1991";
$dbname = "myDB";

$connection= new mysqli($servername,$username,$password,$dbname);
$idNumber="";
$firstName="";
$lastName="";
$email="";
$idNumber="";
$errorMsg="";
$successMsg="";


if( $_SERVER['REQUEST_METHOD']== 'GET'){

    if(!isset($_GET["id"]))
    {
        header("location: /Project_HW/ShowDbTable.php");
        exit;
    }
    $id=$_GET["id"];

    $sql= "SELECT* FROM users WHERE id=$id";
    $result= $connection->query($sql);
    $row= $result->fetch_assoc(); 
   
    if(!$row){

        header("location: /Project_HW/ShowDbTable.php");
        exit;
    }
    $idNumber=$row["id"];
    $firstName=$row["firstname"];
    $lastName=$row["lastname"];
    $email=$row["email"];
}
else {
    $idNumber=$_POST["id"];
    $firstName=$_POST["firstname"];
    $lastName=$_POST["lastname"];
    $email=$_POST["email"];
    do {
        if(empty($idNumber)||empty($firstName)||empty($lastName)||empty($email))
    {
        $errorMsg="All the fields are required";
      
        break;
 
    }

    $sql="UPDATE users SET firstname='$firstName' ,lastname='$lastName',email='$email' WHERE id='$idNumber' ";
    $result=$connection->query($sql);

    if(!$result){
        $errorMsg = "invalid query: ". $connection->error;
        break;
    }
     $successMsg="User Update correctly";
    
     header("location: /Project_HW/ShowDbTable.php");
        exit;

    } while (true);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class= "container my-5">
        <h2> New User</h2>
        <?php
        if(!empty($errorMsg))
        {echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong> $errorMsg </strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> 
            ";

        }
        ?>
        <form method="post" >
            <input type="hidden"  name ="id" value="<?php echo $idNumber;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label "> First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstName;?>">   
                      
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label "> Last Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="lastname" value="<?php echo $lastName;?>">     
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label "> Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">     
                </div>
            </div>
            <?php
            
            if(!empty($successMsg)){
                echo"
                <div class ='row mb-3>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-succsess' role='alert'>
                            <strong>$successMsg</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>    
                </div>
                ";
            }

            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>              
                <div class="col-sm-3 d-grid">
                  <a  class= "btn btn-outline-primary" href="/Project_HW/ShowDbTable.php" role= "button"> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>