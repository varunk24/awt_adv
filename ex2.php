<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight booking</title>
</head>

<body>
  
    <h1>Flight booking</h1>
    <form  method="post">
        <label for="">Name</label>
        <input type="text" name="name" id="">
        <br>
        <br>
        <label for="">Seat</label>
        <br>
        <div>
        
        <input type="radio" name="seat" value="Window" checked> Window 
        
        <input type="radio" name="seat" value="Aisle"> Aisle 
      
        <input type="radio" name="seat" value="Middle"> Middle 
        </div>
        <br>
        <br>
        <label for="">Food</label>
        <br>
        <div>
        
        <input type="radio" name="food" value="Vegetarian" checked> Vegetarian 
       
        <input type="radio" name="food" value="Non Vegetarian"> Non Vegetarian 
     
        <input type="radio" name="food" value="Vegan"> Vegan 
        </div>
        <br>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php
if (isset($_POST['submit'])) {
    echo "<h1>Ticket Booked Successfully</h1>";
    $name = $_POST['name'];
    $seat = $_POST['seat'];
    $food = $_POST['food'];
    setcookie('name', $name, time() + (86400 * 30), "/");
    setcookie('seat', $seat, time() + (86400 * 30), "/");
    setcookie('food', $food, time() + (86400 * 30), "/");
    setcookie('timeVisited', date("h:i:sa") , time() + (86400 * 30), "/");

echo "<h3>Cookie has been set </h3>";
echo "<h3>Click below to see cookie contents</h3>";
echo "<form  method=\"post\"><input type=\"submit\" value=\"View\" name=\"view\"></form>";

}
if (isset($_COOKIE['name']) && isset($_POST['view'])) {
    ?>
    <h1>JSD Flights </h1>
    <h4>Thank you for choosing jsd flights </h4>
    <p>The cookie values are</p>
    <br><br>
    <h4>Name : <?php echo $_COOKIE['name'] ?></h4>
    <h4>Seat : <?php echo $_COOKIE['seat'] ?></h4>
    <h4>Food : <?php echo $_COOKIE['food'] ?></h4>
    <h4>Time Visited : <?php echo $_COOKIE['timeVisited'] ?></h4>
    <?php } ?>

</body>

</html>

