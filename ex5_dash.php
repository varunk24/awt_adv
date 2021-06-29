<?php
session_start();
if (!isset($_SESSION['accno'])) {
    header('Location: ex5.php');
    exit();
}
$conn = mysqli_connect('localhost','root', '123456', 'test');
$bal = "select balance from customer where accno='" . $_SESSION['accno'] . "';";
$balAmt = 0;
$result = mysqli_query($conn, $bal);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $balAmt = $row["balance"];
    }
}
if (isset($_POST['submit'])) {

    $bal = "select balance from customer where accno='" . $_SESSION['accno'] . "';";
    $balAmt = 0;
    $result = mysqli_query($conn, $bal);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $balAmt = $row["balance"];
        }
    }


    if ($_POST['submit'] == 'Deposit') {
        $amt = $_POST['amount'];
        $newBal = (float)$balAmt + (float)$amt;
        $updateQuery = "update customer SET balance=" . $newBal . " where accno = '" . $_SESSION['accno'] . "';";
        if (mysqli_query($conn, $updateQuery)) {
            echo '<script>alert("Dear Account Holder,\n Rs.' . $amt . ' Credited")</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    if ($_POST['submit'] == 'Withdraw') {
        $amt = $_POST['amount'];

        if ($balAmt - $amt < 500) {
            echo '<script>alert("Dear Account Holder,\nYou need to maintain a minimum balance of Rs. 500 at all times")</script>';
        } else {
            $newBal = (float)$balAmt - (float)$amt;
            $updateQuery = "update customer SET balance=" . $newBal . " where accno = '" . $_SESSION['accno'] . "';";
            if (mysqli_query($conn, $updateQuery)) {
                echo '<script>alert("Dear Account Holder,\n Rs.' . $amt . ' Debited")</script>';
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
    if ($_POST['submit'] == 'Balance') {
        echo '<script>alert("Dear Account Holder,\nYour Balance is Rs. ' . $balAmt . '")</script>';
    }

    if ($_POST['submit'] == 'Create') {
        $new_accno = $_POST['accno'];
        $new_password = $_POST['password'];
        $new_name = $_POST['name'];
        $new_address = $_POST['address'];
        $new_account_type = $_POST['account_type'];
        $opening_balance = $_POST['opening_balance'];


        $insertQuery = "insert into customer values(" . $new_accno . ",'" . $new_password . "','" . $new_name .
            "','" . $new_address . "','" . $new_account_type . "'," . $opening_balance . ");";

        if (mysqli_query($conn, $insertQuery)) {
            echo '<script>alert("Account Created");</script>';
        } else {
            if (mysqli_errno($conn) == 1062) {
                echo '<script>alert("Account already exists");</script>';
            }
        }
    }

    if ($_POST['submit'] == 'logout') {
        session_destroy();
        header('Location: ex5.php');
        exit();
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
    <Button type="button" onclick="createShow();">Create Account</Button>
    <Button type="button" onclick="depositShow();">Deposit</Button>
    <Button type="button" onclick="withdrawShow();">Withdraw</Button>
    <form action="" method="post">
        <br>
        <input type="submit" value="Balance" name="submit">
        <input type="submit" value="logout" name="submit">

    </form>


    <div class="center">
        <form action="" method="post" id="depositForm" style="display: none;">
            <label for="">Amount to deposit</label>
            <input type="number" name="amount" id=""><br>
            <input type="submit" name="submit" value="Deposit">
        </form>

        <form action="" method="post" id="withdrawForm" style="display: none;">
            <label for="">Amount to withdraw</label>
            <input type="number" name="amount" id=""><br>
            <input type="submit" name="submit" value="Withdraw">
        </form>

        <form action="" method="post" id="create">
            <label for="">Account Number</label>
            <input type="number" name="accno" required>

            <label for="">Password</label>
            <input type="password" name="password" required>

            <label for="">Name</label>
            <input type="text" name="name" required>

            <label for="">Address</label>
            <input type="text" name="address" required>

            <label for="">Account Type</label>
            <input type="text" name="account_type" required>

            <label for="">Balance</label>
            <input type="number" name="opening_balance" id="openingBal" required onkeyup="checkBal();">




            <input type="submit" name="submit" id="createAcc" value="Create" disabled>
        </form>

    </div>

    <script>
        function depositShow() {
            document.getElementById("withdrawForm").style.display = "none";
            document.getElementById("create").style.display = "none";
            document.getElementById("depositForm").style.display = "inline-block";
        }

        function withdrawShow() {
            document.getElementById("depositForm").style.display = "none";
            document.getElementById("create").style.display = "none";
            document.getElementById("withdrawForm").style.display = "inline-block";
        }

        function createShow() {
            document.getElementById("depositForm").style.display = "none";
            document.getElementById("create").style.display = "inline-block";
            document.getElementById("withdrawForm").style.display = "none";
        }

        function checkBal() {
            if (document.getElementById("openingBal").value < 500) {
                document.getElementById("createAcc").setAttribute("disabled", "disabled");
            } else {
                document.getElementById("createAcc").removeAttribute("disabled");
                console.log("sdghkasdh");
            }
        }
    </script>


    <style>
        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #333;
            padding: 40px;
            border-radius: 10px;
        }

        .center input {
            display: block;
            margin: 0 auto 20px auto;
        }

        label {
            color: white;
        }
    </style>

</body>

</html>