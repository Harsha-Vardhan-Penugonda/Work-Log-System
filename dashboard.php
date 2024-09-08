<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login.html"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Work Log System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-xl mb-8">
        <img src="SAC LOGO.jpg" alt="SAC Logo">
    </div>
    <div class="bg-white p-7 rounded-lg shadow-lg w-full max-w-md text-center">
        <h2 class="text-3xl font-bold mb-4 text-primary-800">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
        <p class="text-gray-700 mb-6">You have successfully logged into the Work Log System.</p>
    </div>

    <div class="grid grid-cols-1 gap-8 w-full max-w-4xl">
        <!-- Log Work Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <a href="worklog.php" class="block p-6 hover:bg-gray-100">
                <h3 class="text-2xl font-semibold text-primary-800">Log Work</h3>
                <p class="text-gray-600 mt-2">Click here to log your work.</p>
            </a>
        </div>

        <!-- View Work Logs Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <a href="worklogDetails.php" class="block p-6 hover:bg-gray-100">
                <h3 class="text-2xl font-semibold text-primary-800">View Work Logs</h3>
                <p class="text-gray-600 mt-2">Click here to view your submitted work logs.</p>
            </a>
        </div>
    </div>
<br>
    <form method="post" class="mt-6">
            <button type="submit" name="logout" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                Logout
            </button>
        </form>
</body>
</html>
