<?php
session_start();

// Only allow admin to access this page
if (!isset($_SESSION['admin'])) {
    header("Location: adminLogin.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection (make sure you include your config)
    include 'config.php';

    // Collect form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $year = (int)$_POST['year'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert into presidents table
    $sql = "INSERT INTO presidents (name, branch, year, email, password) 
            VALUES ('$name', '$branch', $year, '$email', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('President registered successfully!');</script>";
    } else {
        echo "<script>alert('Error registering president.');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register President</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg px-8 py-6 max-w-lg w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">Register a President</h2>
        <form action="" method="POST">
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter President's Name">
            </div>

            <!-- Branch -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="branch">Branch</label>
                <input type="text" id="branch" name="branch" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Branch (e.g. CSE, ECE)">
            </div>

            <!-- Year -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="year">Year</label>
                <select id="year" name="year" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="" disabled selected>Select Year</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Email Address">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" id="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter a Password">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>
