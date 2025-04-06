<?php

require_once '../db_connect.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $sql = "DELETE FROM meet_records WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Meeting record deleted successfully";
    } else {
        $error = "Error deleting meeting record: " . $conn->error;
    }
    $stmt->close();
    
    header("Location: record_management.php");
    exit();
}

$sql = "SELECT mr.id, mr.record, mr.date, mr.appId
        FROM meet_records mr
        LEFT JOIN meet_room mm ON mr.appId = mm.appId
        ORDER BY mr.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Record Management</title>
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
            <h1 class="mb-4 text-success fw-bold">Meeting Record Management</h1>
        </div>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="d-flex justify-content-between mb-3">
            <h2>Meeting Records</h2>
        </div>
        
        <div class="d-flex justify-content-end">
            <a href="add_record.php" class="btn btn-primary">Add New Record</a>
        </div>
        <br></br>
        
        <table class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary">ID</th>
                    <th class="bg-success">App ID</th>
                    <th class="bg-warning">Record</th>
                    <th class="bg-primary">Date</th>
                    <th class="bg-light">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['appId']); ?></td>
                            <td class="record-text" title="<?php echo htmlspecialchars($row['record']); ?>">
                                <?php echo htmlspecialchars($row['record']); ?>
                            </td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                                <a href="edit_record.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                                <a href="record_management.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No meeting records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="mt-4">
            <a href="../index.php" class="btn btn-secondary">Back to Meeting Rooms</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>