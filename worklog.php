<?php
session_start(); // Start the session

include('config.php'); // Include the database connection

// Check if the user is logged in and member_id is available
if (!isset($_SESSION['member_id'])) {
    echo "Error: No member_id set in session.";
    exit;
}

$member_id = $_SESSION['member_id']; // Retrieve member_id from session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $log_date = $_POST['log_date'];
    $log_content = $_POST['log_content'];
    $from_time = $_POST['from_time'];
    $to_time = $_POST['to_time'];
    $created_at = date('Y-m-d H:i:s'); 

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO work_logs (member_id, log_date, log_content, created_at, updated_at, approved_status) 
                            VALUES (?, ?, ?, ?, ?, 'Progress')");
    $stmt->bind_param('issss', $member_id, $log_date, $log_content, $created_at, $created_at);

    if ($stmt->execute()) {
        echo "<script>alert('Successfully Submitted for President Approval.');</script>";
    } else {
        echo "<script>alert('Submission Failed! Please try again.');</script>";
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Log - Work Log System</title>
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
        <h2 class="text-3xl font-bold mb-6 text-center text-primary-800">Submit Work Log</h2>
        <form action="worklog.php" method="POST">
            <div class="space-y-4">
                <div>
                    <label for="log_date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" id="log_date" name="log_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="log_content" class="block text-sm font-medium text-gray-700">Work Log</label>
                    <textarea id="log_content" name="log_content" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"></textarea>
                </div>
                <div class="flex space-x-4">
                    <div>
                        <label for="from_time" class="block text-sm font-medium text-gray-700">From Time</label>
                        <input type="time" id="from_time" name="from_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="to_time" class="block text-sm font-medium text-gray-700">To Time</label>
                        <input type="time" id="to_time" name="to_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <a href="worklogDetails.php" class="block p-6 hover:bg-gray-100">
                <h3 class="text-2xl font-semibold text-primary-800">View Work Logs</h3>
                <p class="text-gray-600 mt-2">Click here to view your submitted work logs.</p>
            </a>
        </div>
</body>
</html>
