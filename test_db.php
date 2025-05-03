<?php
$conn = new mysqli("localhost", "root", "", "elearn_login");

if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

echo "✅ Database connection successful.";
$conn->close();
?>
