<?php
//var for db connect
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

$connection= new mysqli($servername,$username,$password,$dbname);


//var that take from From
$idNumber="";
$firstName="";
$lastName="";
$email="";
$errorMsg="";
$successMsg="";

if( $_SERVER['REQUEST_METHOD']== 'POST')
{

$idNumber=$_POST["id"];    
$firstName=$_POST["firstname"];
$lastName=$_POST["lastname"];
$email=$_POST["email"];


do{

    if(empty($idNumber)||empty($firstName)||empty($lastName)||empty($email))
    {
        $errorMsg="All the fields are required";
      
        break;
 
    }

    // add the new user to db

    $sql= "INSERT INTO users (id,firstname,lastname,email) VALUES('$idNumber','$firstName','$lastName','$email')";
    $result = $connection->query($sql);

    if($result){
        $errorMsg="invalid query: " .$connection->error;
        break;
    }

    $idNumber="";
    $firstName="";
    $lastName="";
    $email="";
    $successMsg= "the user added correctly";
    header("location: /Project_HW/ShowDbTable.php");
    exit;

}while(false);



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
        <div class="row mb-3">
                <label class="col-sm-3 col-from-label "> ID Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $idNumber;?>">   
                      
                </div>
            </div>
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
                        <div class='alert alert-succsess alert-dismissible fade show' role='alert'>
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