<?php
// add_token.php - Add a new meeting token
require_once '../db_connect.php';

$message = $error = '';
$name = $appId = $token = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $appId = trim($_POST['appId']);
    $token = trim($_POST['token']);
    
    if (empty($name) || empty($appId) || empty($token)) {
        $error = "All fields are required";
    } else {
        // Insert new token
        $sql = "INSERT INTO meet_token (name, appId, token) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $appId, $token);
        
        if ($stmt->execute()) {
            $message = "Meeting token added successfully";
            // Reset form
            $name = $appId = $token = '';
        } else {
            $error = "Error adding meeting token: " . $conn->error;
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
    <title>Add Meeting Token</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Meeting Token</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Token Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="appId" class="form-label">App ID</label>
                <input type="text" class="form-control" id="appId" name="appId" value="<?php echo htmlspecialchars($appId); ?>" required>
                <div class="form-text">Format: vpaas-magic-cookie-XXXXXXXXXXXXX</div>
            </div>
            
            <div class="mb-3">
                <label for="token" class="form-label">Token</label>
                <textarea class="form-control" id="token" name="token" rows="5" required><?php echo htmlspecialchars($token); ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Token</button>
            <a href="token_management.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
