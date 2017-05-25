<?php

if (isset($_POST['first']))
{
    $first = $_POST['first'];
    $second = $_POST['second'];
    $sum = $first + $second;
    $difference = $first - $second;
    $product = $first * $second;
    $quotient = $first / $second;
    
    echo "<h1>1st Number: $first</h1>" .
        "<h1>2nd Number: $second</h1>" .
        "<h2>Sum: $sum </h2>" .
        "<h2>Difference: $difference </h2>" .
        "<h2>Product: $product</h2>" .
        "<h2>Quotient: $quotient</h2>";
    $i = 0;
    while ($first <= $second){
        echo $first++;
        echo "<br>";
    }
    
}


?>

<!DOCTYPE HTML>

<html>
  <head>
      <title>Exercise #2 - Santos, Andrei Mishael</title>
  </head>
  <body>
    <form method="POST" >
        1st Number: <input type="number" name="first" min="1" max="100" value="1" required><br>
        2nd Number: <input type="number" name="second" min="1" max="100" value="1" required><br>
        <button type="submit" name="evaluate">Evaluate Me!</button>
    </form>
  </body>
</html>