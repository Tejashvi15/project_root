<?php
require_once '../db_connect.php';

$message = $error = '';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: feedback_management.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch current feedback record
$sql = "SELECT id, name, email, feedback, ratings, date FROM meet_feedback WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    $error = "Error preparing statement: " . $conn->error;
} else {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: feedback_management.php");
        exit();
    }

    $record_data = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Meeting Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Meeting Feedback</h1>

    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?php echo htmlspecialchars($record_data['name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($record_data['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="feedback" class="form-label">Feedback</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="5" required><?php echo htmlspecialchars($record_data['feedback']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="ratings" class="form-label">Ratings</label>
            <input type="number" class="form-control" id="ratings" name="ratings" min="1" max="5"
                   value="<?php echo htmlspecialchars($record_data['ratings']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <p class="form-control-plaintext"><?php echo htmlspecialchars($record_data['date']); ?></p>
        </div>

        <button type="submit" class="btn btn-primary">Update Feedback</button>
        <a href="feedback_management.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
