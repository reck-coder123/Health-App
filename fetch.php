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

// Get the email ID
$email = $_GET['email'];

// Fetch the user's health report
$sql = "SELECT report_path FROM user_health_reports WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $reportPath = $row['report_path'];

  // Output the file for download
  header('Content-type: application/pdf');
  header('Content-Disposition: attachment; filename="health_report.pdf"');
  readfile($reportPath);
} else {
  echo "Health report not found for the given email ID.";
}

// Close the database connection
$conn->close();
?>