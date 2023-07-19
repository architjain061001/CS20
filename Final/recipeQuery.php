<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Recipe API</title>
	<meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="home.css">
  <style>
    #form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input[type="text"] {
      margin: 10px;
      padding: 5px;
      border: 2px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      width: 400px;
      max-width: 100%;
    }
  </style>
</head>
	<?php
  if (!isset($_SESSION["username"])) {
    echo "<script>console.log('user is NOT defined');</script>";
  }
  else {
    echo "<script>console.log('user is defined');</script>";
    echo "<script> document.getElementsByClassName('login')[0].innerHTML = '" . $_SESSION["username"] . "' </script>";
  }

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
  echo "<script>console.log('$username');</script>";
  $sql = "SELECT diet_pref, intolerances FROM user WHERE username='$username'";
  echo "<br>";
  $result = $conn->query($sql);

  echo "<br>";
  if ($result->num_rows > 0) {
    echo "<br>";
    while($row = $result->fetch_assoc()) {
      $userDiet = $row["diet_pref"];
      $userIntolerances = $row["intolerances"];
    }
  }
    $conn->close();
  ?>

    <body onload="do_query()">
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
    <main>
      
    </main>
    <h1>Search For Recipes!</h1>
    <div id = "form">
    <form id='form' method='get'>
        <!-- buttons for filter options 
        if clicked make true and then use them to filter -->
        <h2> Query: </h2> <input type="text"  name='query' id="query"  placeholder="Pasta, Cake, Soup, Salad, etc."/>
        <h2> Cuisine: </h2> <input type="text"  name='cuisine' id="cuisine"  placeholder="Greek, Italian, Thai, Indian, African, etc." />
        <!-- Include: <input type="text"  name='includes' id="includes"  placeholder="Tomato, Cheese, Basil, etc."/> -->
        <h2> Type: </h2> <input type="text"  name='type' id="type"  placeholder="Breakfast, Sauce, Dessert, Appetizer, Side, etc."/>
        <input type = "button" id = "button1" value = "Submit Search"/>
    </form>
    </div>
    <br><br>
    <div id="container"></div>
    <script>
		userDiet = "<?php echo $userDiet; ?>";
		userIntolerances ="<?php echo $userIntolerances; ?>";
		userIntolerances = userIntolerances.replace(",", "%2C");
		userQuery = "";
		userCuisine = "";
		// userIncludes = "";
		userType = "";

    var subBtn = document.getElementById("button1");
    subBtn.addEventListener("click", do_query);

    async function do_query() {
      initialize_vars();
      update_queries();

      const options = {
	      method: 'GET',
	      headers: {
		      'X-RapidAPI-Key': '88e55ed878msh790c3c390ac8aeap16be74jsn56299a21fd66',
		      'X-RapidAPI-Host': 'spoonacular-recipe-food-nutrition-v1.p.rapidapi.com'
	      }
      };

      console.log(userQuery);
      console.log(userCuisine);
    //   console.log(userIncludes);
      console.log(userType);


      const url = 'https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch?query=' + userQuery + '&cuisine=' + userCuisine + '&diet=' + userDiet +'&intolerances=' + userIntolerances + '&type=' + userType + '&instructionsRequired=true&fillIngredients=false&addRecipeInformation=true';
	    
      try {
	      const response = await fetch(url, options);
	      const result = await response.text();
        const json_response = JSON.parse(result);
        console.log(json_response);
        //print all recipes to page in a loop
        let container = document.getElementById('container');
        document.getElementById("container").innerHTML = "";
        for (var i = 0; i < 10; i++) {
          var recipe = document.createElement("div");
          //add style to the recipe div
          recipe.style.margin = "10px 0";
          recipe.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.2)";
          recipe.style.width = "60%";
          recipe.style.margin = "10px";
          recipe.style.padding = "30px";
          recipe.style.textAlign = "center";
          recipe.style.margin = "auto";
          recipe.style.backgroundColor = "beige";
          recipe.style.color = "black";

          var pic = document.createElement("img");
          var recipeTitle = document.createElement("h2");
          recipeTitle.innerHTML = json_response.results[i].title;
          var recipeSummary = document.createElement("p");
          recipeSummary.style.margin = "20px";
          recipeSummary.innerHTML = json_response.results[i].summary;

          container.appendChild(recipe);

          recipe.setAttribute('id','recipe' + i);
          pic.setAttribute("src", json_response.results[i].image);

          var newlink = document.createElement('a');
          newlink.setAttribute('class', 'recipeLink');
          console.log(json_response.results[i].sourceURL);
          newlink.setAttribute('href', json_response.results[i].sourceURL);
          newlink.innerHTML = 'See Recipe';

          document.getElementById("recipe" + i).appendChild(recipeTitle);
          document.getElementById("recipe" + i).appendChild(pic);
          document.getElementById("recipe" + i).appendChild(recipeSummary);
          document.getElementById("recipe" + i).appendChild(newlink);
        }
      } catch (error) {
	      console.error(error);
      }

    }

    function initialize_vars() {
      query = document.getElementsByName("query");
      query[0].addEventListener("change", update_queries);

      cuisine = document.getElementsByName("cuisine");
      cuisine[0].addEventListener("change", update_queries);

    //   includes = document.getElementsByName("includes");
    //   includes[0].addEventListener("change", update_queries);

      type = document.getElementsByName("type");
      type[0].addEventListener("change", update_queries);
    }

    function update_queries() {
      userQuery = document.getElementById("query").value;
      console.log("user query: "  + userQuery);
      if (userQuery) {
        userQuery = userQuery.replace(",", "%2C");
      }

      userCuisine = document.getElementById("cuisine").value;
      console.log("user cuisine: " + userCuisine);
      if (userCuisine) {
        userCuisine = userCuisine.replace(",", "%2C");
      }

    //   userIncludes = document.getElementById("includes".value);
    //   console.log("user includes: " + userIncludes);
    //   if (userIncludes) {
    //     userIncludes = userIncludes.replace(",", "%2C");
    //   }

      userType = document.getElementById("type").value;
      console.log("user type: " + userType);
      if (userType) {
			  userType = userType.replace(" ", "%20");
      }
    }
    </script>
  
</body>
</html>