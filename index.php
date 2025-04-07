<?php

require_once 'db_connect.php';

// Delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM meet_room WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Meeting room deleted successfully";
    } else {
        $error = "Error deleting meeting room: " . $conn->error;
    }
    $stmt->close();
    
    header("Location: index.php");
    exit();
}

// Pagination settings
$limit = 25; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) AS total FROM meet_room";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT mr.id, mr.roomName, mr.appId 
        FROM meet_room mr          
        LEFT JOIN meet_token mt ON mr.appId = mt.appId          
        ORDER BY mr.id
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .btn-action { margin-right: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="mb-4 text-secondary fw-bold">Meeting Room Management</h1>
        </div>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="d-flex justify-content-between mb-4">
            <h2>Meeting Rooms</h2>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex gap-2">
        <a href="tokens/token_management.php" class="btn btn-success">Manage Meeting Tokens</a>
        <a href="records/record_management.php" class="btn btn-success">Manage Meeting Records</a>
        <a href="feedback/feedback_management.php" class="btn btn-success">Manage Meeting Feedback</a>
    </div>
        <a href="rooms/add_room.php" class="btn btn-primary">Add New Room</a>
    </div>

        <br>
        <table class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary">ID</th>
                    <th class="bg-secondary">Room Name</th>
                    <th class="bg-info">AppId</th>
                    <th class="bg-warning">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['roomName']); ?></td>
                            <td><?php echo htmlspecialchars($row['appId']); ?></td>
                            <td>
                                <a href="rooms/edit_room.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                                <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this room?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No meeting rooms found</td>
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
                            <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
