<?php
require 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $stmt = $conn->prepare("UPDATE employees SET name = ?, position = ?, salary = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $name, $position, $salary, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($employee['name']) ?>" required>
        <input type="text" name="position" value="<?= htmlspecialchars($employee['position']) ?>">
        <input type="number" step="0.01" name="salary" value="<?= $employee['salary'] ?>">
        <button type="submit">Save Changes</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
