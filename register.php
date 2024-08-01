<?php
// Database connection
$servername = "localhost";
$username = "root"; // MySQL 사용자명
$password = "tjrwls0802"; // MySQL 비밀번호
$dbname = "ticket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// SQL query
$sql = "INSERT INTO Users (name, username, password) VALUES (?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

// Execute the statement
if ($stmt->execute()) {
    // 회원가입 성공 시 리디렉션
    header("Location: login.html");
    exit();
} else {
    // 회원가입 실패 시 에러 메시지 출력
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
