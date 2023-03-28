<!DOCTYPE html>
<html>
  <head>
    <title>Credit Transactions</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  
  <body>
    <header>
      <h1 style="font-family:Ubuntu;" align = "center">My Credits</h1>
    </header>
    <nav>
      <ul>
        <li><a href="hp.html">Home</a></li>
      </ul>
    </nav>
    <main>
      <h2 style="font-family:Ubuntu;" align = "center">Welcome to My Credits</h2>
      <form method="POST">
        <label for="username">Enter username:</label>
        <input type="text" id="username" name="username"><br><br>
        <input type="submit" value="Submit">
      </form>
      <form class = "image">
        <label for="total_credits">total credits:</label>
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "signup";
          
          // Connect to the database
          $conn = mysqli_connect($servername, $username, $password, $dbname);
      
          // Check for connection errors
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
      
          // Get the amount from the database for the given username
          if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $query = "SELECT amount FROM wastesubmit1 WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
        
            // Check for query errors
            if (!$result) {
              die("Query failed: " . mysqli_error($conn));
            }
        
            // Display the total credits
            $row = mysqli_fetch_assoc($result);
            $total_credits = $row['amount'] * 2;
            echo "<p>$total_credits</p>";
          }
      
          // Close the database connection
          mysqli_close($conn);
        ?>
        <img src="https://th.bing.com/th?q=Reward+Cartoon&w=120&h=120&c=1&rs=1&qlt=90&cb=1&pid=InlineBlock&mkt=en-IN&cc=IN&setlang=en&adlt=moderate&t=1&mw=247">
      </form>
    </main>
    <!-- <footer>
      <p>Contact Us:<br><br>+91 999 988 7799/+91 222 266 9967<br>Help Desk<br>@purifyme@gmail.com</p>
    </footer> -->
  </body>
</html>
