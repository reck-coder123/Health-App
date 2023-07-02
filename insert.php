<?php
// Database connection details
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// Upload the PDF file
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["report"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the file is a PDF
if ($fileType != "pdf") {
  echo "Sorry, only PDF files are allowed.";
  $uploadOk = 0;
}

// Check if the file was successfully uploaded
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["report"]["tmp_name"], $targetFile)) {
    // File uploaded successfully, insert the data into the database
    $sql = "INSERT INTO user_health_reports (name, age, weight, email, report_path)
            VALUES ('$name', '$age', '$weight', '$email', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
      echo "User details and health report inserted successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

// Close the database connection
$conn->close();
?>
