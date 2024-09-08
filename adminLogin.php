<?php
session_start();

// Admin credentials
$admin_email = '123@123.com';
$admin_password = password_hash('admin@123', PASSWORD_BCRYPT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email matches the admin email
    if ($email === $admin_email) {
        // Verify the password
        if (password_verify($password, $admin_password)) {
            // Set session for admin
            $_SESSION['admin'] = true;

            // Redirect to Admin Dashboard
            header("Location: adminDashboard.php");
            exit();
        } else {
            // Wrong password
            $error = "Invalid email or password.";
        }
    } else {
        // Wrong email
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Work Log System</title>
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
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-primary-800">Admin Login</h2>
        <form action="adminLogin.php" method="POST">
            <?php if (isset($error)) { ?>
                <p class="text-red-500 mb-4"><?php echo $error; ?></p>
            <?php } ?>
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>
