<?php
require_once "config/db.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name  = trim($_POST["last_name"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $email      = trim($_POST["email"] ?? "");

    if ($first_name && $last_name && $department && $email) {
        $sql = "INSERT INTO staff (first_name, last_name, department, email) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $department, $email);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $message = "Error adding record: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "All fields are required.";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Staff - AfriStaff</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Add New Staff</h1>
            <p class="subtitle">Create a new staff record</p>
        </header>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="POST" action="add.php" class="form-card" novalidate>
            <div class="form-group">
                <label for="first_name">First Name <span class="required">*</span></label>
                <input type="text" id="first_name" name="first_name" required 
                       pattern="[A-Za-z\s'-]{2,50}" 
                       title="Letters, spaces, hyphens and apostrophes only. 2-50 characters."
                       placeholder="e.g. John">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name <span class="required">*</span></label>
                <input type="text" id="last_name" name="last_name" required 
                       pattern="[A-Za-z\s'-]{2,50}" 
                       title="Letters, spaces, hyphens and apostrophes only. 2-50 characters."
                       placeholder="e.g. Doe">
            </div>

            <div class="form-group">
                <label for="department">Department <span class="required">*</span></label>
                <input type="text" id="department" name="department" required 
                       pattern="[A-Za-z\s&]{2,100}" 
                       title="Letters, spaces, and ampersands only. 2-100 characters."
                       placeholder="e.g. Human Resources">
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" required 
                       placeholder="e.g. john.doe@company.com">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Record</button>
                <a href="index.php" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>
