<?php
require_once "config/db.php";

// Search functionality
$search = "";
$where_clause = "";
if (isset($_GET["search"]) && !empty(trim($_GET["search"]))) {
    $search = trim($_GET["search"]);
    $where_clause = "WHERE first_name LIKE ? OR last_name LIKE ? OR department LIKE ?";
}

// Pagination setup
$records_per_page = 10;
$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
$offset = ($page - 1) * $records_per_page;

// Count total records for pagination
if ($where_clause) {
    $count_sql = "SELECT COUNT(*) as total FROM staff " . $where_clause;
    $count_stmt = $conn->prepare($count_sql);
    $search_param = "%" . $search . "%";
    $count_stmt->bind_param("sss", $search_param, $search_param, $search_param);
} else {
    $count_sql = "SELECT COUNT(*) as total FROM staff";
    $count_stmt = $conn->prepare($count_sql);
}
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_records = $count_result->fetch_assoc()["total"];
$total_pages = ceil($total_records / $records_per_page);
$count_stmt->close();

// Fetch records
if ($where_clause) {
    $sql = "SELECT id, first_name, last_name, department, email, created_at FROM staff " . $where_clause . " ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search . "%";
    $stmt->bind_param("sssii", $search_param, $search_param, $search_param, $records_per_page, $offset);
} else {
    $sql = "SELECT id, first_name, last_name, department, email, created_at FROM staff ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $records_per_page, $offset);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AfriStaff - Staff Directory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>AfriStaff</h1>
            <p class="subtitle">Staff Directory Management System</p>
        </header>

        <div class="toolbar">
            <a href="add.php" class="btn btn-primary">+ Add New Staff</a>

            <form method="GET" action="index.php" class="search-form">
                <input type="text" name="search" placeholder="Search by name or department..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-secondary">Search</button>
                <?php if ($search): ?>
                    <a href="index.php" class="btn btn-outline">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                <td><?php echo htmlspecialchars($row["first_name"]); ?></td>
                                <td><?php echo htmlspecialchars($row["last_name"]); ?></td>
                                <td><?php echo htmlspecialchars($row["department"]); ?></td>
                                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                <td><?php echo htmlspecialchars($row["created_at"]); ?></td>
                                <td class="actions">
                                    <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-edit">Edit</a>
                                    <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="no-records">No staff records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-outline">&laquo; Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="btn btn-active"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-outline"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-outline">Next &raquo;</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <footer>
            <p>Total Records: <?php echo $total_records; ?></p>
        </footer>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
