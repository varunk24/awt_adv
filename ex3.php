<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();
$disable="";

?>

<body>
    <style>
        td,
        table {
            border: 2px black solid;
            background-color: #ccc;
        }

        td {
            padding: 10px;

        }

        input {
            display: block;
            margin: auto;
        }
    </style>
    <table>
    <?php
        if (isset($_POST['login'])) {
         $user = $_POST['userid'];
        echo "<h4>Logged-In</h4>";
        if ($user==$_SESSION['user']) {
            $value=$_SESSION['value'];
            $value=$value+1;
            $_SESSION['value']=$value;
            echo "<h3> Repeated user </h3>";
            echo  "<h3>" . $_SESSION['user'] . " you have visited " . $_SESSION['value'] . " Times</h3>";
         
        }else{
            $_SESSION['user']=$user;
            $_SESSION['value']=1;
            echo "<h3> New user </h3>";
            echo  "<h3>" . $_SESSION['user'] . " you have visited " . $_SESSION['value'] . " Times</h3>";
        }
        $_SESSION['loggedin'] = true;
        $disable="disabled";
    
        }

        if (isset($_POST['logout'])) {
            echo "<h4>Logged-Out</h4>";
            
            header('location:./ex3.php');
           
        }
?>
        <?php
        if (isset($_POST['login']))
            echo "<th colspan=\"2\">" . $_SESSION['user'] . " Logged in currently</th>";
        else
            echo "<th colspan=\"2\">Student Login</th>";
        ?>
        <form  method="post">
            <tr>
                <td><label>User ID</label></td>
                <td><input <?php echo $disable;?> type="text" name="userid"></td>
            </tr>
            <tr>
                <td><label>Password</label></td>
                <td><input <?php echo $disable;?> type="password" name="password"></td>
            </tr>
            <tr>
                <?php
                if (!isset($_POST['login']))
                    echo "<td colspan=2><input type=\"submit\" value=\"Login\" name=\"login\"></td>";
                if (isset($_POST['login']))
                echo "<td colspan=2><input type=\"submit\" value=\"Logout\" name=\"logout\"></td>";
                ?>
            </tr>
        </form>
        
    </table>



</body>

</html>