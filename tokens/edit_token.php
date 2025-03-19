<?php
// edit_token.php - Edit an existing meeting token
require_once '../db_connect.php';

$message = $error = '';
$name = $appId = $token = '';
$token_id = 0;

// Get token ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: token_management.php");
    exit();
}

$token_id = intval($_GET['id']);

// Fetch current token data
$sql = "SELECT * FROM meet_token WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $token_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: token_management.php?error=Token+not+found");
    exit();
}

$token_data = $result->fetch_assoc();
$stmt->close();

// Pre-fill form with current data
$name = $token_data['name'];
$appId = $token_data['appId'];
$token = $token_data['token'];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    if (empty($_POST['name'])) {
        $error = "Name is required";
    } else if (empty($_POST['appId'])) {
        $error = "App ID is required";
    } else if (empty($_POST['token'])) {
        $error = "Token is required";
    } else {
        // Update token in database
        $name = trim($_POST['name']);
        $appId = trim($_POST['appId']);
        $token = trim($_POST['token']);
        
        $sql = "UPDATE meet_token SET name = ?, appId = ?, token = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $appId, $token, $token_id);
        
        if ($stmt->execute()) {
            $message = "Token updated successfully";
        } else {
            $error = "Error updating token: " . $conn->error;
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
    <title>Edit Meeting Token</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Edit Meeting Token</h1>
                
                <?php if ($message): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                                <div class="form-text">A descriptive name for this token (e.g. "Main Account")</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="appId" class="form-label">App ID</label>
                                <input type="text" class="form-control" id="appId" name="appId" value="<?php echo htmlspecialchars($appId); ?>" required>
                                <div class="form-text">The Jitsi Meet App ID (e.g. "vpaas-magic-cookie-...")</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="token" class="form-label">Token</label>
                                <textarea class="form-control" id="token" name="token" rows="5" required><?php echo htmlspecialchars($token); ?></textarea>
                                <div class="form-text">The JWT token for authentication</div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="token_management.php?id=<?php echo $token_id; ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Token</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="token_management.php" class="btn btn-link">Back to Token Management</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>