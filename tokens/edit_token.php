<?php

require_once '../db_connect.php';

$message = $error = '';
$name = $appId = $token = $user_joined = $user_info = $reset_date = $is_used = $email = '';
$token_id = 0;


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: token_management.php");
    exit();
}

$token_id = intval($_GET['id']);


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


$name = $token_data['name'];
$appId = $token_data['appId'];
$token = $token_data['token'];
$user_joined = $token_data['user_joined'];
$user_info = $token_data['user_info'];
$reset_date = $token_data['reset_date'];
$is_used = $token_data['is_used'];
$email = $token_data['email'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $appId = trim($_POST['appId']);
    $token = trim($_POST['token']);
    $user_joined = trim($_POST['user_joined']);
    $user_info = trim($_POST['user_info']);
    $reset_date = trim($_POST['reset_date']);
    $is_used = trim($_POST['is_used']);
    $email = trim($_POST['email']);

  
    if (empty($name) || empty($user_joined) || empty($user_info) || empty($reset_date) || empty($is_used) || empty($appId) || empty($email) || empty($token)) {
        $error = "All fields are required";
    } else {
       
        $sql = "UPDATE meet_token SET name = ?, user_joined = ?, user_info = ?, reset_date = ?, is_used = ?, appId = ?, email = ?, token = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $name, $user_joined, $user_info, $reset_date, $is_used, $appId, $email, $token, $token_id);

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
                                <label for="name" class="form-label">Token Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="user_joined" class="form-label">User Joined</label>
                                <input type="text" class="form-control" id="user_joined" name="user_joined" value="<?php echo htmlspecialchars($user_joined); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="user_info" class="form-label">User Info</label>
                                <textarea class="form-control" id="user_info" name="user_info" rows="3" required><?php echo htmlspecialchars($user_info); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="reset_date" class="form-label">Reset Date</label>
                                <input type="text" class="form-control" id="reset_date" name="reset_date" value="<?php echo htmlspecialchars($reset_date); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="is_used" class="form-label">Is Used</label>
                                <input type="text" class="form-control" id="is_used" name="is_used" value="<?php echo htmlspecialchars($is_used); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="appId" class="form-label">App ID</label>
                                <input type="text" class="form-control" id="appId" name="appId" value="<?php echo htmlspecialchars($appId); ?>" required>
                                <div class="form-text">Format: vpaas-magic-cookie-XXXXXXXXXXXXX</div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="token" class="form-label">Token</label>
                                <input type="text" class="form-control" id="token" name="token" value="<?php echo htmlspecialchars($token); ?>" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="token_management.php" class="btn btn-secondary">Cancel</a>
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
