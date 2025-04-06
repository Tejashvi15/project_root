<?php
require_once '../db_connect.php';

$message = $error = '';
$name = $email = $feedback = $ratings = $record = '';
$room_id = '';

$sql = "SELECT id, roomName, appId FROM meet_room ORDER BY roomName";
$rooms = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $feedback = trim($_POST['feedback']);
    $ratings = trim($_POST['rating']);
    $record = trim($_POST['record']);
    $date = date('Y-m-d'); 

    if (empty($record)) {
        $error = "Record content is required.";
    } else {
        $sql = "INSERT INTO meet_feedback (id, name, email, feedback, ratings, record, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $room_id, $name, $email, $feedback, $ratings, $record, $date);

        if ($stmt->execute()) {
            $message = "Meeting feedback added successfully.";
            $room_id = $name = $email = $feedback = $ratings = $record = '';
        } else {
            $error = "Error: " . $conn->error;
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
    <title>Add Meeting Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Add New Meeting Feedback</h1>

    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="id" class="form-label">Meeting Room</label>
            <select class="form-select" id="id" name="id" required>
                <option value="">Select a room</option>
                <?php if ($rooms && $rooms->num_rows > 0): ?>
                    <?php while($room = $rooms->fetch_assoc()): ?>
                        <option value="<?php echo $room['id']; ?>" <?php echo ($room_id == $room['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($room['roomName']); ?> (AppID: <?php echo $room['appId']; ?>)
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Participant Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Participant Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>

        <div class="mb-3">
            <label for="feedback" class="form-label">Feedback</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="3" required><?php echo htmlspecialchars($feedback); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Ratings (1 to 5)</label>
            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" value="<?php echo htmlspecialchars($ratings); ?>" required>
        </div>

        <div class="mb-3">
            <label for="record" class="form-label">Record Content</label>
            <textarea class="form-control" id="record" name="record" rows="5" required><?php echo htmlspecialchars($record); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Feedback</button>
        <a href="feedback_management.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
