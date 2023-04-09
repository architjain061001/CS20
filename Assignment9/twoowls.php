<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Two Owls Café Menu</title>
    <link rel="stylesheet" href="twoowls.css">
    <script>
      function validateForm() {
            // Check that at least one item is ordered
            var orderItems = document.querySelectorAll("select");
            var itemsSelected = false;
            for (var i = 0; i < orderItems.length; i++) {
                if (orderItems[i].value > 0) {
                    itemsSelected = true;
                    break;
                }
            }
            if (!itemsSelected) {
                alert("Please select at least one item.");
                return false;
            }

            var firstName = document.getElementsByName("first_name")[0].value;
            var lastName = document.getElementsByName("last_name")[0].value;

            // Check that customer's first and last name were provided
            if (firstName == "" || lastName == "") {
                alert("Please provide your first and last name.");
                return false;
            }
            
            // Get the current date and time
            var currentTime = new Date();

            // Create a new date object for the cafe's closing time
            var closingTime = new Date();
            closingTime.setHours(3, 0, 0); // Set closing time to 3am

            // Check if the current time is during open hours (8pm to 3am)
            if (currentTime.getHours() >= 16 || currentTime.getHours() < 3) {
                // Check if there's at least 30 minutes until closing time
                if (currentTime.getHours() > 2 && currentTime.getHours() < 3 && currentTime.getMinutes() > 30) {
                    // Order was submitted during open hours and at least 30 minutes prior to closing
                    alert("Please submit your order at least 30 minutes before closing time (3am).");
                    return false;
                } else {
                    // Order was submitted too close to closing time
                    alert("Order submitted successfully!");
                }
            } else {
                // Order was submitted outside of open hours
                alert("We're currently closed. Please place your order during open hours (8pm to 3am).");
                return false;
            }
        }
    </script>
  </head>
  <body>
    <h1>Two Owls Café Menu</h1>
    <p>Open daily from 8pm to 3am</p>
    
    <form action="process_order.php" method="post" onsubmit="return validateForm()">
      <h2>Menu</h2>
      
      <table>
        <tr>
          <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
        </tr>
        <?php
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
          
          // Display menu items in a grid
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>$" . $row["cost"] . "</td>";
            echo "<td><select name='" . $row["id"] . "'>";
            for($i = 0; $i <= 10; $i++) {
              echo "<option value='" . $i . "'>" . $i . "</option>";
            }
            echo "</select></td>";
            echo "</tr>";
          }
          
          // Close database connection
          $conn->close();
        ?>
      </table>
      
      <h2>Order Information</h2>
      <label for="first_name">First Name:</label>
      <input type="text" name="first_name"><br>
      <label for="last_name">Last Name:</label>
      <input type="text" name="last_name"><br>
      <label for="special_instructions">Special Instructions:</label>
      <textarea name="special_instructions"></textarea><br>
      <input type="submit" value="Submit Order">
    </form>
  </body>
</html>
