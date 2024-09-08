<?php
// Database connection variables
$servername = "localhost"; // or the hostname of your database server
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "worklogsystem"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $registration_number = $_POST['registration_number'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $council = $_POST['council'];
    $year = $_POST['year'];
    $branch = $_POST['branch'];
    $section = $_POST['section'];
    $contact = $_POST['contact'];
    
    // Prepare the SQL query to insert data into the MEMBERS table
    $sql = "INSERT INTO MEMBERS (name, registration_number, email, password, council, year, branch, section, contact, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiiss", $name, $registration_number, $email, $password, $council, $year, $branch, $section, $contact);
    
    // Execute the query
    if ($stmt->execute()) {
        echo "Registration successful!";
        // Redirect to login page or display success message
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
