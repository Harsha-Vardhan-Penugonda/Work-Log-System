<?php
session_start();
require 'config.php'; // Assumes you have a file that connects to the database

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the fields are not empty
    if (!empty($email) && !empty($password)) {
        // Query to get the user from the database
        $sql = "SELECT * FROM MEMBERS WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['member_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}
?>
