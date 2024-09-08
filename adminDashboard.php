<?php
session_start();

// Check if the admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: adminLogin.php");
    exit();
}

// You can add the president check here based on how you set the session for the president
$is_president = isset($_SESSION['president']) && $_SESSION['president'] === true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Work Log System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Logo -->
    <header class="bg-white shadow-sm py-4 mb-6">
        <div class="max-w-7xl mx-auto px-4">
            <img src="SAC LOGO.jpg" alt="SAC LOGO" class="h-12 mx-auto">
        </div>
    </header>

    <!-- Dashboard -->
    <main class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Register President (Only for Admin) -->
            <?php if (isset($_SESSION['admin'])): ?>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-bold text-primary-700 mb-4">Register President</h3>
                <p class="text-gray-600">Add new presidents to the system.</p>
                <a href="registerPresident.php" class="mt-4 inline-block bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700">
                    Go to Register President
                </a>
            </div>
            <?php endif; ?>

            <!-- View Work Logs (Visible to both Admin and President) -->
            <?php if (isset($_SESSION['admin']) || $is_president): ?>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-bold text-primary-700 mb-4">View Work Logs</h3>
                <p class="text-gray-600">Review the work logs submitted by the members.</p>
                <a href="workData.php" class="mt-4 inline-block bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700">
                    Go to Work Logs
                </a>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
