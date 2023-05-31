<!DOCTYPE html>
<html>
<head>
  <title>Student Registration Form</title>
</head>
<body>
  <h1>Student Registration Form</h1>
  <form action="process.php" method="post">
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" required>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required>

    <label for="gender">Gender:</label>
    <input type="radio" id="male" name="gender" value="Male" required>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="Female" required>
    <label for="female">Female</label>

    <input type="submit" value="Submit">
  </form>
</body>
</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $fullName = test_input($_POST["fullName"]);
  $email = test_input($_POST["email"]);
  $gender = test_input($_POST["gender"]);

 
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
  }

  
  $servername = "your_servername";
  $username = "your_username";
  $password = "your_password";
  $dbname = "your_dbname";

  
  $conn = new mysqli($servername, $username, $password, $dbname);

  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
  $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$fullName', '$email', '$gender')";

  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  
  $conn->close();
}
?>