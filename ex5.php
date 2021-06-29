<?php
    
  $conn = mysqli_connect('localhost','root', '123456', 'test');
$createSQL = "create table if not exists customer(
    accno varchar(30) primary key,
    pass varchar(40),
    name varchar(15),
    address varchar(30),
    account_type varchar(15),
    balance int(10));";
$result = $conn->query($createSQL);

if (isset($_POST['submit'])) {
    $accno = $_POST['accno'];
    $pass = $_POST['pass'];

    $checkUser = "select * from customer where accno='" . $accno . "' and pass='" . $pass . "';";
    if ($res = mysqli_query($conn, $checkUser)) {
        if (mysqli_num_rows($res) > 0) {
            session_start();
            $_SESSION['accno'] = $accno;
            header('Location: ex5_dash.php');
            exit();
        } else {
            echo '<script type="text/javascript">document.getElementById("error").style.display="inline-block";</script>';
        }
    } else {
        echo "ERROR: Could not able to execute $sql. "
            . mysqli_error($link);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <table>
                <tr>
                    <td><label for="">Account Number</label></td>
                    <td><input type="text" name="accno" id=""></td>
                </tr>
                <tr>
                    <td><label for="">Password</label></td>
                    <td><input type="password" name="pass" id=""></td>
                </tr>
                <tr>
                    <td colspan="2" id="error">User name or Password is wrong</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="submit" name="submit">
                    </td>
                </tr>

            </table>
        </form>
    </div>
    <style>
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #333;
            padding: 30px;
            border-radius: 10px;
        }

        label {
            color: white;
        }

        input {
            display: block;
            margin: 20px auto;
        }

        #error {
            color: red;
            display: none;
        }
    </style>


</body>

</html>