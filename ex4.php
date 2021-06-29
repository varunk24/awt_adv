<?php
$conn = mysqli_connect("localhost", "root", "123456", "test");
if($conn === false){
echo "connection not possible";
}
if(isset($_POST['submit'])){
$target= "../uploads/".basename($_FILES['photo']['name']);
$pic= $_FILES['photo']['name'];
$passnum=  $_POST['num'];
$fname = $_POST['fname'];
$sname =  $_POST['sname'];
$dob= $_POST['dob'];
$nation= $_POST['nation'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$sql = "INSERT INTO passport  VALUES ('$passnum', '$fname','$sname','$dob','$nation','$address','$gender','$pic')";
move_uploaded_file($_FILES['photo']['tmp_name'],$target);
if(mysqli_query($conn, $sql)){
echo"<h3>Data Succesfully Inserted</h3> ";
}
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PassPort Portal</title>
<link rel="stylesheet"  href="./bootstrap.css">
</head>
<body>
<div class="container" style="border:1px black solid">
<div class="frame">
<form  method="post" enctype="multipart/form-data">
<header><h1>PASSPORT FORM</h1></header>
<hr>
<table>
<tr>
<td>Enter passport num:</td>
<td><input type="number" name="num" required></td>
</tr>
<tr>
<td>Enter first name:</td>
<td><input type="text" name="fname" required></td>
</tr>
<tr>
<td>Enter second name:</td>
<td><input type="text" name="sname" required></td>
</tr>
<tr>
<td>Enter date of birth:</td>
<td><input type="date" name="dob" required></td>
</tr>
<tr>
<td>Enter Nationality:</td>
<td><input type="text" name="nation" required></td>
</tr>
<tr>
<td>Enter address:</td>
<td><textarea name="address" ></textarea></td>
</tr>
<tr>
<td><label for="gender">Select gender:</label></td>
<td>Male: <input type="radio" name="gender" value="Male"> Female:<input type="radio" name="gender" value="female"> Other:<input type="radio" name="gender" value="other"></td>

</tr>

<tr>
<td>Upload Picture:</td>
<td><input type="file" name="photo" id="photo"></td>

</tr>

<tr>
<th  colspan="2"><button class="btn btn-primary"><input type="submit" name="submit" value = "Submit"></a></button>
</tr>
</table>
</form>
<div class="butt">
<a href="ex4_del.php"  role="button" class="btn btn-danger">Delete</a>
<a href="ex4_upt.php"  role="button" class="btn btn-info">Update</a>
</div>
</div>
<hr>
<hr>
</div>
</body>
</html>