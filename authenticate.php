<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "elearn_login";

// Connect to DB
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get submitted data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if user already exists
$sql = "SELECT password FROM credentials WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // User not found: store new user
    $stmt->close();
    $insert = $conn->prepare("INSERT INTO credentials (username, password) VALUES (?, ?)");
    $insert->bind_param("ss", $username, $password);
    if ($insert->execute()) {
        echo "<script>alert('New user stored in database'); window.location.href='login.html';</script>";
    } else {
        echo "Error storing new user: " . $insert->error;
    }
    $insert->close();
} else {
    // User found: check password
    $row = $result->fetch_assoc();
    if ($row['password'] === $password) {
        echo "<script>alert('Login successful'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Incorrect password'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>
