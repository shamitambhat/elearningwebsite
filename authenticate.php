<?php
$host = "dpg-d0ba7g6uk2gs73chkr4g-a";
$port = "5432"; // PostgreSQL default port
$dbname = "elearn_login";
$user = "elearn_login_user";
$password = "kisRT4cbXSCsyD4SOeRfyBoznFl5kBms"; // Replace with your PostgreSQL password

// Create a PDO connection to the database
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to the database successfully!";  // For debugging
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create the credentials table if it doesn't exist
$tableCreationSQL = "
CREATE TABLE IF NOT EXISTS credentials (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
";

try {
    $conn->exec($tableCreationSQL);
    // echo "Table created successfully."; // For debugging
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}

// Get submitted data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if user already exists
$sql = "SELECT password FROM credentials WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    // User not found: store new user
    $insert = $conn->prepare("INSERT INTO credentials (username, password) VALUES (:username, :password)");
    $insert->bindParam(':username', $username, PDO::PARAM_STR);
    $insert->bindParam(':password', $password, PDO::PARAM_STR);
    
    if ($insert->execute()) {
        echo "<script>alert('New user stored in database, you have been registered, please login again.'); window.location.href='login.html';</script>";
    } else {
        echo "Error storing new user: " . $insert->errorInfo()[2];
    }
} else {
    // User found: check password
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['password'] === $password) {
        echo "<script>alert('Login successful'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Incorrect password'); window.location.href='login.html';</script>";
    }
}

// Close the connection
$conn = null;
?>
