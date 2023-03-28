<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="signup_style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600"
      rel="stylesheet"
      type="text/css"
    />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  </head>

  <body class="body">
    <div class="login-page">
      <div class="form">
        <form method="post" action="signup.php">
          <lottie-player
            src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"
            background="transparent"
            speed="1"
            style="justify-content: center"
            loop
            autoplay
          ></lottie-player>
          <input type="text" placeholder="full name" name="full_name" />
          <input type="text" placeholder="email address" name="email_address" />
          <input type="text" placeholder="pick a username" name="username" />
          <input type="password" id="password" placeholder="set a password" name="password" />
          <i class="fas fa-eye" onclick="show()"></i>
          <br>
          <br>
          <button type="submit" name="submit">SIGN UP</button>
        </form>

        <form class="login-form">
          <button type="button" onclick="window.location.href='login.php'">
            SIGN IN
          </button>
        </form>
      </div>
    </div>
  </body>
  <script>
    function show() {
      var password = document.getElementById("password");
      var icon = document.querySelector(".fas");

      // ========== Checking type of password ===========
      if (password.type === "password") {
        password.type = "text";
      } else {
        password.type = "password";
      }
    }
  </script>
</html>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $full_name = $_POST["full_name"];
  $email_address = $_POST["email_address"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Insert form data into database table
  $sql = "INSERT INTO sinfo (full_name, email_address, username, password)
          VALUES ('$full_name', '$email_address', '$username', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close database connection
$conn->close();
?>
