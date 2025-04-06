<?php
// index.php - Main page displaying meet rooms with CRUD operations
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
    
    // Redirect to prevent form resubmission
    header("Location: index.php");
    exit();
}

// Fetch all meeting rooms with token names
$sql = "SELECT mr.id, mr.roomName, mr.appId 
        FROM meet_room mr          
        LEFT JOIN meet_token mt ON mr.appId = mt.appId          
        ORDER BY mr.id";
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
        
        <div class="d-flex justify-content-end ">
            <a href="rooms/add_room.php" class="btn btn-primary">Add New Room</a>
        </div>
        <br></br>
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
                        <td colspan="5" class="text-center">No meeting rooms found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="mt-4">
            <a href="tokens/token_management.php" class="btn btn-success">Manage Meeting Tokens</a>
        </div>
        <div class="mt-4">
            <a href="records/record_management.php" class="btn btn-success">Manage Meeting Records</a>
        </div>
        <div class="mt-4">
            <a href="feedback/feedback_management.php" class="btn btn-success">Manage Meeting FeedBack</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
