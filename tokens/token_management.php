<?php
// token_management.php - Manage meeting tokens with CRUD operations
require_once '../db_connect.php';

// Delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Check if token is in use
    $check_sql = "SELECT COUNT(*) as count FROM meet_room WHERE meet_token_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();
    
    if ($check_row['count'] > 0) {
        $error = "Cannot delete token because it's used by " . $check_row['count'] . " meeting room(s)";
    } else {
        $sql = "DELETE FROM meet_token WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $message = "Meeting token deleted successfully";
        } else {
            $error = "Error deleting meeting token: " . $conn->error;
        }
        $stmt->close();
    }
    
    // Redirect to prevent form resubmission
    header("Location: token_management.php");
    exit();
}

// Fetch all tokens
$sql = "SELECT id, name, appId, token, date FROM meet_token ORDER BY id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Token Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .btn-action { margin-right: 5px; }
        .token-text {
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
        <h1 class="mb-4 text-success fw-bold">Meeting Token Management</h1>
    </div>

        
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="d-flex justify-content-between mb-3">
            <h2>Meeting Tokens</h2>
            
        </div>
        
        <div class="d-flex justify-content-end ">
        <a href="add_token.php" class="btn btn-primary">Add New Token</a>
        </div>
        <br></br>
        
        <table class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary">ID</th>
                    <th class="bg-secondary">Name</th>
                    <th class="bg-success">App ID</th>
                    <th class="bg-warning">Token</th>
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
                            <td><?php echo htmlspecialchars($row['appId']); ?></td>
                            <td class="token-text" title="<?php echo htmlspecialchars($row['token']); ?>">
                                <?php echo htmlspecialchars($row['token']); ?>
                            </td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                                <a href="edit_token.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                                <a href="token_management.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this token?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No meeting tokens found</td>
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
