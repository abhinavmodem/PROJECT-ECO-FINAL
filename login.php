<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> 
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body class="body">
    <div class="login-page">
        <div class="form">
            <form method="post">
                <lottie-player src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"  background="transparent"  speed="1"  style="justify-content: center;" loop autoplay></lottie-player>
                <input type="text" name="username" placeholder="&#xf007;  username"/>
                <input type="password" name="password" id="password" placeholder="&#xf023;  password"/>
                <i class="fas fa-eye" onclick="show()"></i> 
                <br>
                <br>
                <button type="submit" name="login">LOGIN</button>
                <p class="message"></p>
            </form>

            <form class="login-form">
                <button type="button" onclick="window.location.href='signup.php'">SIGN UP</button>
            </form>
        </div>
    </div>

    <script>
        function show() {
            var password = document.getElementById("password");
            var icon = document.querySelector(".fas")

            // ========== Checking type of password ===========
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        };
    </script>
</body>
</html>
<?php
if(isset($_POST['login'])) {
    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signup";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare SQL statement
    $sql = "SELECT * FROM sinfo WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if login was successful
    if(mysqli_num_rows($result) == 1) {
        // Login successful, redirect to dashboard or home page
        echo '<script>window.location.href = "hp.html";</script>';
        exit();
    } else {
        // Login unsuccessful, display error message
        echo "<p class='message'>Invalid username or password</p>";
    }

    // Close connection
    mysqli_close($conn);
}
?>
