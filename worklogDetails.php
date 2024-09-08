<?php
session_start(); // Start the session

include('config.php'); // Include the database connection

// Check if user is logged in
if (!isset($_SESSION['member_id'])) {
    header("Location: login.php");
    exit;
}

$member_id = $_SESSION['member_id'];

// Fetch work logs for the logged-in user
$query = "SELECT id, log_date, log_content, approved_status FROM work_logs WHERE member_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $member_id);
$stmt->execute();
$result = $stmt->get_result();
$work_logs = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close(); // Close the statement
$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Log Details</title>
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
                        status: {
                            approved: '#d1fae5',
                            rejected: '#fee2e2',
                            progress: '#e0f2fe',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <h2 class="text-3xl font-bold mb-6 text-center text-primary-800">Your Work Log Details</h2>

        <?php if (empty($work_logs)): ?>
            <p class="text-center text-gray-600">No work logs found.</p>
        <?php else: ?>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Work Log</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($work_logs as $log): ?>
                        <tr class="<?= $log['approved_status'] == 'Approved' ? 'bg-status-approved' : ($log['approved_status'] == 'Rejected' ? 'bg-status-rejected' : 'bg-status-progress') ?>">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($log['log_date']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($log['log_content']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium <?= $log['approved_status'] == 'Approved' ? 'text-green-600' : ($log['approved_status'] == 'Rejected' ? 'text-red-600' : 'text-blue-600') ?>">
                                <?= htmlspecialchars($log['approved_status']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

   
</body>
</html>
