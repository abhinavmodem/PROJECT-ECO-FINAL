<!DOCTYPE html>
<html>
<head>
<title>Submit Waste</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="submit_style.css">
</head>
<body>
<div class="container">
<h1>Submit Waste</h1>
<p>Please fill out the form to categorize your waste:</p>
<form method="POST" action="submit_waste.php">
 <div class="form-group">
<label for="username">Username:</label>
 <input type="text" class="form-control" id="username" name="username">
 </div>
 <div class="form-group">
<label for="location">Waste location:</label>
<input type="text" class="form-control" id="location" name="location">
</div>
            
<div class="form-group">
<label for="bnb">Is the waste biodegradable or non-biodegradable?</label>
<select class="form-control" id="bnb" name="bnb">
<option value="biodegradable">Biodegradable</option>
<option value="non-biodegradable">Non-biodegradable</option>
</select>
</div>
<div class="form-group">
<label for="type">What type of waste is it?</label>
<select class="form-control" id="type" name="type">
<option value="paper">Paper</option>
<option value="plastic">Plastic</option>
<option value="metal">Metal</option>
<option value="fabric">Fabric</option>
</select>
</div>
<div class="form-group">
<label for="amount">Enter the amount of waste(kg):</label>
<input type="number" class="form-control" id="amount" name="amount">
</div>
<button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>
</body>
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
  $username = $_POST["username"];
  $location = $_POST["location"];
  $bnb = $_POST["bnb"];
  $type = $_POST["type"];
  $amount = $_POST["amount"];

  // Check if user already exists in database
  $sql = "SELECT * FROM wastesubmit1 WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // User already exists, update waste amount
    $row = $result->fetch_assoc();
    $newAmount = $row["amount"] + $amount;
    $sql = "UPDATE wastesubmit1 SET amount='$newAmount' WHERE username='$username'";
    if ($conn->query($sql) !== TRUE) {
      echo "Error updating record: " . $conn->error;
    }
  } else {
    // User does not exist, insert new record
    $sql = "INSERT INTO wastesubmit1 (username, location, bnb, type, amount)
            VALUES ('$username', '$location', '$bnb', '$type','$amount')";
    if ($conn->query($sql) !== TRUE) {
      echo "Error inserting record: " . $conn->error;
    }
  }

  // Calculate coins based on total waste per user
  $sql = "SELECT SUM(amount) as totalWaste FROM wastesubmit1 WHERE username='$username'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalWaste = $row["totalWaste"];
    $coins = $totalWaste * 2;
   
    
  }
}

// Close database connection
$conn->close();
?>