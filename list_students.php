<?php
require 'db.php';

// Charger les étudiants
$query = $pdo->query("SELECT * FROM students ORDER BY studentID ASC");
$students = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students List</title>

<style>
:root {
    --primary-color: #1e3a8a;
    --secondary-color: #3b82f6;
    --light-bg: #f5f7fa;
    --text-color: #1f2937;
    --border-color: #d1d5db;
    --white: #ffffff;
}
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: var(--light-bg);
    color: var(--text-color);
    margin: 0;
    padding: 0;
}
h2 { text-align: center; color: var(--primary-color); margin-top: 20px; }

nav {
    background-color: var(--primary-color);
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 10px 0;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
nav a {
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    font-weight: 500;
}
nav a:hover { background-color: var(--secondary-color); }

table {
    border-collapse: collapse;
    margin: 25px auto;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    font-size: 15px;
    width: 90%;
}
th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid var(--border-color);
}
th {
    background-color: var(--secondary-color);
    color: white;
    font-weight: 600;
}
tr:last-child td { border-bottom: none; }

button {
    background-color: var(--secondary-color);
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 5px;
    cursor: pointer;
}
button:hover { background-color: #2563eb; }

.delete-btn { background-color: #dc2626; }
.delete-btn:hover { background-color: #b91c1c; }
</style>
</head>

<body>

<nav>
    <a href="tp.html">Home</a>
    <a href="list_students.php">Students List</a>
    <!--<a href="add_student_form.php">Add Student</a>-->
</nav>

<h2>Students List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (count($students) > 0): ?>
            <?php foreach($students as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['studentID']) ?></td>
                    <td><?= htmlspecialchars($s['lastname']) ?></td>
                    <td><?= htmlspecialchars($s['firstname']) ?></td>
                    <td><?= htmlspecialchars($s['email']) ?></td>

                    <td>
                        <form action="tp.html" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $s['studentID'] ?>">
                            <button type="submit">Update</button>
                        </form>

                        <form action="delete_student.php" method="post" style="display:inline;">
                            <input type="hidden" name="deleteID" value="<?= $s['studentID'] ?>">
                            <button class="delete-btn" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="5" style="padding:20px;">No students found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
