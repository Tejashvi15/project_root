<?php

require_once '../db_connect.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM meet_feedback WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Meeting feedback deleted successfully";
    } else {
        $error = "Error deleting meeting feedback: " . $conn->error;
    }
    $stmt->close();

    header("Location: feedback_management.php");
    exit();
}

// Pagination setup
$limit = 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) AS total FROM meet_feedback";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT mr.id, mr.name, mr.email, mr.feedback, mr.ratings, mr.date
        FROM meet_feedback mr
        LEFT JOIN meet_room mm ON mr.id = mm.id
        ORDER BY mr.id
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Feedback Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .btn-action { margin-right: 5px; }
        .record-text {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="mb-4 text-success fw-bold">Meeting Feedback Management</h1>
        </div>

        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <h2>Meeting Feedback</h2>
        </div>

        <br>

        <table class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary">ID</th>
                    <th class="bg-success">Name</th>
                    <th class="bg-warning">Email</th>
                    <th class="bg-warning">Feedback</th>
                    <th class="bg-warning">Ratings</th>
                    <th class="bg-primary">Date</th>
                    <th class="bg-light">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                            <td><?php echo htmlspecialchars($row['ratings']); ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="feedback_management.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No meeting feedback found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center mt-4">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="feedback_management.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <div class="mt-4">
            <a href="../index.php" class="btn btn-secondary">Back to Meeting Rooms</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
