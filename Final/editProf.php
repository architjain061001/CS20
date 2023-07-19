<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<style>
		.container {
			max-width: 500px;
			margin: 0 auto;
			padding: 20px;
			border-radius: 10px;
		}

		form {
			display: flex;
			flex-direction: column;
			margin: auto;

		}

		label {
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="email"],
		input[type="password"],
		input[type="tel"],
		input[type="textarea"] {
			padding: 10px;
			font-size: 16px;
			border-radius: 20px;
			background-color: lightgrey;
			outline: none;
			border: none;
			width: 100%;
			max-width: 500px;
			font-family: 'Montserrat', sans-serif;
			color: black;
			margin: 10px 0;
		}

		input[type="submit"] {
			padding: 10px;
			font-size: 16px;
			border-radius: 20px;
			border: none;
			background-color: darkgreen;
			color: white;
			width: 100%;
			max-width: 200px;
			margin-top: 20px;
			transition: background-color 0.3s ease;
			box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
			cursor: pointer;
			margin: 0 auto;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>

<body>
	<?php
		$server = "localhost";
		$userid = "u1fsufpgwmits";
		$pw = "cs20team8";
		$db= "dbljxr9guyxurl";


		$conn = new mysqli($server, $userid, $pw, $db);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$conn->select_db($db);
		$username = $_SESSION["username"];
		$sql = "SELECT phone, diet_pref, intolerances, address FROM user WHERE username='$username'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$phone = $row["phone"];
			$diet_pref = $row["diet_pref"];
			$address = $row["address"];
			$userIntolerances = $row["intolerances"];
			}
		}
			$conn->close();
    ?>
	<header>
        <div class="logo">
            <a href="home.php">
                <img src="logo.png" alt="Recipe App Logo">
            </a>
        </div>
        <nav>
            <ul class="centered">
                <li><a href="about-us.html">About</a></li>
                <li><a href="recipeQuery.php">Recipes</a></li>
                <li><a href="editProf.php">Profile</a></li>
                <li><a href="contact-us.html">Support</a></li>
                <li class="login"><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
	<div class="container">
		<h1>Edit Profile</h1>
		<form method='post' action='processEdits.php'>
			<label for="phone">Phone Number:</label>
			<input type="tel" id="phone" name="phone" value="<?php echo $phone;?>">

			<label for="address">Address:</label>
			<input type="textarea" id="address" name="address" value="<?php echo $address; ?>">

			<label for="allergies">Food Allergies:</label>
			<input type="text" id="allergies" name="allergies" value="<?php echo $userIntolerances; ?>">

			<label for="restrictions">Dietary Restrictions:</label>
			<input type="text" id="restrictions" name="restrictions" value="<?php echo $diet_pref; ?>">

			<input type="submit" value="Update">
		</form>
	</div>
	<footer>
    	<p>&copy; 2023 GoTo Recipe App. All rights reserved.</p>
  	</footer>
</body>

</html>