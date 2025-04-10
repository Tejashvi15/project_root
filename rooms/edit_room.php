<?php
// edit_room.php - Edit an existing meeting room
require_once '../db_connect.php';

$message = $error = '';
$roomName = $token_id = '';

// Get room ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];

// Fetch all tokens for dropdown
$sql = "SELECT id, name FROM meet_token ORDER BY name";
$tokens = $conn->query($sql);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = trim($_POST['roomName']);
    $token_id = $_POST['token_id'];
    
    if (empty($roomName)) {
        $error = "Room name is required";
    } else {
        // Update room
        $sql = "UPDATE meet_room SET roomName = ?, meet_token_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $roomName, $token_id, $id);
        
        if ($stmt->execute()) {
            $message = "Meeting room updated successfully";
        } else {
            $error = "Error updating meeting room: " . $conn->error;
        }
        
        $stmt->close();
    }
} else {
    // Fetch current room data
    $sql = "SELECT roomName, meet_token_id FROM meet_room WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $roomName = $row['roomName'];
        $token_id = $row['meet_token_id'];
    } else {
        $error = "Room not found";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meeting Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Meeting Room</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="roomName" name="roomName" value="<?php echo htmlspecialchars($roomName); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="token_id" class="form-label">Meeting Token</label>
                <select class="form-select" id="token_id" name="token_id" required>
                    <option value="">Select a token</option>
                    <?php if ($tokens && $tokens->num_rows > 0): ?>
                        <?php while($token = $tokens->fetch_assoc()): ?>
                            <option value="<?php echo $token['id']; ?>" <?php echo ($token_id == $token['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($token['name']); ?> (ID: <?php echo $token['id']; ?>)
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Room</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
