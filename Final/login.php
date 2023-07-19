<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
  </head>

  <body>
    <div class="loginForm">
      <form method= 'post' action = 'process_login.php' >
        <h2>User Login</h2>
        <label for="username">Username:</label> <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label> <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
      </form>

      <a href="editProf.php">Click here</a>
      
      <div class="signup">
        <p>Don't have an account?</p>
        <a href="createAcc.php">Sign up now</a>
      </div>
    </div>

  </body>
</html>
