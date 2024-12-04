<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $stmt = $conn->prepare("INSERT INTO employees (name, position, salary) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $position, $salary);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add New Employee</title>
</head>
<body>
    <h1>Add New Employee</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Employee Name" required>
        <input type="text" name="position" placeholder="Position">
        <input type="number" step="0.01" name="salary" placeholder="Salary">
        <button type="submit">Add Employee</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
