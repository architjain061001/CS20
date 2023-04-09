<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Two Owls Café Order</title>
    <link rel="stylesheet" href="twoowls.css">
  </head>
  <body>
    <?php include "twoowls.php"; ?>
    <h1>Order Summary</h1>
    <table>
      <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Cost</th>
      </tr>
      <?php
        // Get the order data from the form submission
        $order = array();
        foreach($_POST as $key => $value) {
          if(is_numeric($value) && $value > 0) {
            $item_id = intval($key);
            $quantity = intval($value);
            $order[$item_id] = $quantity;
          }
        }
        
        // Connect to database
        $servername = "localhost";
        $username = "uyxjbbn8kij8o";
        $password = "Architjain_1";
        $dbname = "db6ovb9qgjcjvz";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        // Fetch menu items
        $sql = "SELECT * FROM menu_items";
        $result = $conn->query($sql);
        
        // Display ordered items with their quantities and cost
        $subtotal = 0;
        while($row = $result->fetch_assoc()) {
          $item_id = $row["id"];
          $name = $row["name"];
          $cost = $row["cost"];
          $quantity = $order[$item_id];
          if($quantity > 0) {
            $item_total = $cost * $quantity;
            $subtotal += $item_total;
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$quantity</td>";
            echo "<td>$" . number_format($item_total, 2) . "</td>";
            echo "</tr>";
          }
        }
        
        // Calculate tax and total
        $tax_rate = 0.0625;
        $tax = $subtotal * $tax_rate;
        $total = $subtotal + $tax;

        // Close database connection
        $conn->close();
      ?>
    </table>
    <p>Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
    <p>Tax (<?php echo ($tax_rate * 100); ?>%): $<?php echo number_format($tax, 2); ?></p>
    <p>Total: $<?php echo number_format($total, 2); ?></p>
    <?php
      // Calculate pickup time in 15 minutes from the current time
      date_default_timezone_set('America/New_York');
      $pickup_time = time() + (15 * 60);
      $formatted_time = date("h:i A", $pickup_time);
    ?>
    <p>Pickup time: <?php echo $formatted_time; ?></p>
  </body>
</html>
