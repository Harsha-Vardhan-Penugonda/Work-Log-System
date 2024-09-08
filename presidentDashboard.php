<?php
session_start();

// Ensure that only the president can access this page
if (!isset($_SESSION['president'])) {
    header("Location: presidentDashboad.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>President Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-6xl w-full">
        <!-- Logo Section -->
        <div class="flex justify-center mb-8">
            <img src="logo.png" alt="Logo" class="h-24">
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- View Work Logs Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">View Work Details</h2>
                    <p class="text-gray-600 mb-4">Check all the work logs submitted by members under your supervision.</p>
                    <a href="workData.php" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                        View Work Logs
                    </a>
                </div>
            </div>

            <!-- Work Approval Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Approve Work</h2>
                    <p class="text-gray-600 mb-4">Review and approve or reject work logs submitted by members.</p>
                    <a href="approveWork.php" class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                        Approve Work
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
