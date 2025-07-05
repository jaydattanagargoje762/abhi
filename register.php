<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Password encryption (recommended)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if mobile already exists
    $check_sql = "SELECT * FROM users WHERE mobile='$mobile'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Mobile number already registered!'); window.location.href='register.php';</script>";
    } else {
        $sql = "INSERT INTO users (name, mobile, password, role) 
                VALUES ('$name', '$mobile', '$hashed_password', '$role')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registered Successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid Request'); window.location.href='register.php';</script>";
}
?>
