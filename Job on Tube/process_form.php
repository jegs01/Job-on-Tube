<?php
// Assuming you've already established a connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "client";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data into database
$sql = "INSERT INTO job_postings (job_title, category, open_worldwide, salary_range, job_type, application_link_email, job_description, company_name, company_hq, company_website, company_email, company_description, agreed_to_terms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssss", $job_title, $category, $open_worldwide, $salary_range, $job_type, $application_link_email, $job_description, $company_name, $company_hq, $company_website, $company_email, $company_description, $agreed_to_terms);

// Get form data
$job_title = htmlspecialchars($_POST['job-title']);
$category = htmlspecialchars($_POST['toggleDropdown']);
$open_worldwide = htmlspecialchars($_POST['tickOption']);
$salary_range = htmlspecialchars($_POST['toggleDropdown2']);
$job_type = htmlspecialchars($_POST['tickOption1']);
$application_link_email = htmlspecialchars($_POST['application-link']);
$job_description = htmlspecialchars($_POST['job-description']);
$company_name = htmlspecialchars($_POST['company-name']);
$company_hq = htmlspecialchars($_POST['company-hq']);
$company_website = htmlspecialchars($_POST['company-website']);
$company_email = htmlspecialchars($_POST['email']);
$company_description = htmlspecialchars($_POST['company-description']);
$agreed_to_terms = htmlspecialchars(isset($_POST['terms']) ? 'Yes' : 'No'); // Check if the checkbox is checked

// Execute SQL statement
if ($stmt->execute()) {
    header("Location: index.html?status=success");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
