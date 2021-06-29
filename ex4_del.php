<?php 
$conn = mysqli_connect("localhost", "root", "123456", "test");

if(!empty($_POST['accno'])){

if($conn === false){

echo "connection not possible";

}

$id=$_POST['accno'];

$query = "DELETE FROM passport WHERE passnum='$id'";

if ( $conn->query($query)== TRUE  &&  $conn->affected_rows > 0 ) {
    echo"<h3>Data Succesfully Deleted</h3> ";
}
}





?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>delete user</title>
<link rel="stylesheet"  href="./bootstrap.css">
</head>
<body>

<br><br>
<div class="container" style="border:1px black solid">
<br><br><br>
<form  method="post">

<label>Enter the account number you want to delete.</label>

<input type="number" name="accno" placeholder="Enter account number here!" required>

<br>
<hr>

<input type="submit" name="Delete" value="Delete"> <a href="ex4.php" role="button">Go back</a>
<br><br>
</form>

</div>


</body>
</html>