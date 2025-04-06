<?php

require_once '../db_connect.php';

$message = $error = '';

$sql = "SELECT roomName, appId FROM meet_room ORDER BY roomName";
$rooms = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $record = trim($_POST['record']);
    $appId = $_POST['appId'];
    $date = date('Y-m-d'); 
    
    if (empty($record)) {
        $error = "Record content is required";
    } else {
        // Insert new record
        $sql = "INSERT INTO meet_records (record, appId, date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $record, $appId, $date);
        
        if ($stmt->execute()) {
            $message = "Meeting record added successfully";
            
            $record = '';
            $appId = '';
        } else {
            $error = "Error adding meeting record: " . $conn->error;
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
    <title>Add Meeting Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Meeting Record</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="appId" class="form-label">Meeting Room</label>
                <select class="form-select" id="appId" name="appId" required>
                    <option value="">Select a room</option>
                    <?php if ($rooms && $rooms->num_rows > 0): ?>
                        <?php while($room = $rooms->fetch_assoc()): ?>
                            <option value="<?php echo $room['appId']; ?>" <?php echo (isset($appId) && $appId == $room['appId']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($room['roomName']); ?> (AppID: <?php echo $room['appId']; ?>)
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="record" class="form-label">Record Content</label>
                <textarea class="form-control" id="record" name="record" rows="5" required><?php echo htmlspecialchars($record ?? ''); ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Record</button>
            <a href="record_management.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>