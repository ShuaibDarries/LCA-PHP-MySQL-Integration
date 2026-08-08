<?php
require_once "config/db.php";

// Validate ID parameter
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET["id"]);

// Delete the record using prepared statement
$sql = "DELETE FROM staff WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

// Redirect back to index
header("Location: index.php");
exit();
?>
