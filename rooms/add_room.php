<?php
// add_room.php - Form to add a new meeting room
require_once '../db_connect.php';

$message = $error = '';

// Fetch all tokens for dropdown
$sql = "SELECT appId, name FROM meet_token ORDER BY name"; 
$tokens = $conn->query($sql);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = trim($_POST['roomName']);
    $appId = $_POST['appId']; 
    
    if (empty($roomName)) {
        $error = "Room name is required";
    } else {
        // Insert new room
        $sql = "INSERT INTO meet_room (roomName, appId) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $roomName, $appId);
        
        if ($stmt->execute()) {
            $message = "Meeting room added successfully";
            // Reset form
            $roomName = '';
            $appId = '';
        } else {
            $error = "Error adding meeting room: " . $conn->error;
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Meeting Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Meeting Room</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="roomName" name="roomName" value="<?php echo htmlspecialchars($roomName ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="appId" class="form-label">Meeting Token</label>
                <select class="form-select" id="appId" name="appId" required>
                    <option value="">Select a token</option>
                    <?php if ($tokens && $tokens->num_rows > 0): ?>
                        <?php while($token = $tokens->fetch_assoc()): ?>
                            <option value="<?php echo $token['appId']; ?>" <?php echo (isset($appId) && $appId == $token['appId']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($token['name']); ?> (AppID: <?php echo $token['appId']; ?>)
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Room</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>