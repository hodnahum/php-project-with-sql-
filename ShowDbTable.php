

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-widt,initial-scale=1.0">
        <title>dbTable</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <style>
         
            
            header{
                text-align: center;
                padding:8px ;
                background-color: azure;
            }
            footer{
                text-align: center;
            }
            table{
                border-collapse: collapse;
                border-radius: 2px;
                border: 2px solid;
                width: 100%;
                color: #588c7e;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 25px;
                text-align: center;
            }

            th{
                background-color: #588c7e;
                color: black;
            }
           
        </style>
    </head>

    <body>

   

<div class="container my-5">
 <head class="header"><h1>list Of Users</h1></head>


<a class="btn btn-primary" href=" /Project_HW/create.php" role="button">New Client</a>
<br>



<table class="table">
    <tr>
        <th>Id Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname ,email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
        <tr>
        <td>$row[id] </td>
        <td>$row[firstname]</td>
        <td>$row[lastname] </td>
        <td>$row[email]</td>
        <td>
        <a class='btn btn-primary btn-sm' href='/Project_HW/edit.php?id=$row[id]'>Edit</a>
        <a class = 'btn btn-danger btn-sm' href='/Project_HW/delete.php?id=$row[id]'>Delete</a> 
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</table>

<footer><h5>created by hod nahum</h5></footer>
    </body>
</html>