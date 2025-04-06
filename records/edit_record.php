<?php

require_once '../db_connect.php';

$message = $error = '';


if (!isset($_GET['id'])) {
    header("Location: record_management.php");
    exit();
}

$id = $_GET['id'];


$sql = "SELECT id, record, appId, date FROM meet_records WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    $error = "Error preparing statement: " . $conn->error;
} else {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: record_management.php");
        exit();
    }

    $record_data = $result->fetch_assoc();
    $stmt->close();
}


$sql_rooms = "SELECT DISTINCT appId FROM meet_records"; 
$rooms = $conn->query($sql_rooms);

if ($rooms === false) {
    $error = "Error fetching meeting rooms: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meeting Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Meeting Record</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <div class="mb-3">
                <label for="appId" class="form-label">Meeting Room</label>
                <select class="form-select" id="appId" name="appId" required>
                    <option value="">Select a appId</option>
                    <?php if ($rooms && $rooms->num_rows > 0): ?>
                        <?php while($room = $rooms->fetch_assoc()): ?>
                            <option value="<?php echo $room['appId']; ?>" <?php echo ($record_data['appId'] == $room['appId']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($room['appId']); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="record" class="form-label">Record Content</label>
                <textarea class="form-control" id="record" name="record" rows="5" required><?php echo htmlspecialchars($record_data['record']); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Created Date</label>
                <p class="form-control-plaintext"><?php echo $record_data['date']; ?></p>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Record</button>
            <a href="record_management.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
