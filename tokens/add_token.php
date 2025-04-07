<?php

require_once '../db_connect.php';

$message = $error = '';
$name = $appId = $token = $user_joined = $user_info = $reset_date = $is_used = $email = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $appId = trim($_POST['appId']);
    $token = trim($_POST['token']);
    $user_joined = trim($_POST['user_joined']);
    $user_info = trim($_POST['user_info']);
    $reset_date = trim($_POST['reset_date']);
    $is_used = trim($_POST['is_used']);
    $email = trim($_POST['email']);
    
    if (empty($name) || empty($appId) || empty($token) || empty($user_info) || empty($user_joined) || empty($reset_date) || empty($is_used) || empty($email)) {
        $error = "All fields are required";
    } else {

        $sql = "INSERT INTO meet_token (name, user_joined, user_info, reset_date, is_used, email, appId, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $name, $user_joined, $user_info, $reset_date, $is_used, $email, $appId, $token);
        
        if ($stmt->execute()) {
            $message = "Meeting token added successfully";
            $name = $appId = $token = $user_joined = $user_info = $reset_date = $is_used = $email = '';
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
                <div class="form-text">Enter a descriptive name for this token</div>
            </div>
            
            <div class="mb-3">
                <label for="user_joined" class="form-label">User Joined</label>
                <input type="number" class="form-control" id="user_joined" name="user_joined" value="<?php echo htmlspecialchars($user_joined); ?>" min="0" required>
                <div class="form-text">Enter the number of users that have joined</div>
            </div>

            <div class="mb-3">
                <label for="user_info" class="form-label">User Info</label>
                <textarea class="form-control" id="user_info" name="user_info" rows="3" required><?php echo htmlspecialchars($user_info); ?></textarea>
                <div class="form-text">Enter user information details</div>
            </div>

            <div class="mb-3">
                <label for="reset_date" class="form-label">Reset Date</label>
                <input type="date" class="form-control" id="reset_date" name="reset_date" value="<?php echo htmlspecialchars($reset_date); ?>" required>
                <div class="form-text">Select the token reset date</div>
            </div>

            <div class="mb-3">
                <label for="is_used" class="form-label">Is Used</label>
                <select class="form-select" id="is_used" name="is_used" required>
                    <option value="" disabled <?php echo empty($is_used) ? 'selected' : ''; ?>>-- Select Status --</option>
                    <option value="yes" <?php echo ($is_used == 'yes') ? 'selected' : ''; ?>>Yes</option>
                    <option value="no" <?php echo ($is_used == 'no') ? 'selected' : ''; ?>>No</option>
                    <option value="pending" <?php echo ($is_used == 'pending') ? 'selected' : ''; ?>>Pending</option>
                </select>
                <div class="form-text">Select whether this token has been used</div>
            </div>

            <div class="mb-3">
                <label for="appId" class="form-label">App ID</label>
                <input type="text" class="form-control" id="appId" name="appId" value="<?php echo htmlspecialchars($appId); ?>" pattern="vpaas-magic-cookie-[a-zA-Z0-9]+" required>
                <div class="form-text">Format: vpaas-magic-cookie-XXXXXXXXXXXXX</div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <div class="form-text">Enter the email address associated with this token</div>
            </div>
            
            <div class="mb-3">
                <label for="token" class="form-label">Token</label>
                <textarea class="form-control" id="token" name="token" rows="3" required><?php echo htmlspecialchars($token); ?></textarea>
                <div class="form-text">Enter the authentication token</div>
            </div>

            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn btn-primary">Add Token</button>
                <a href="token_management.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>