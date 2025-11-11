<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?error=Access+Denied");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="alert alert-primary">
    <h3>👋 Welcome, Admin <?php echo htmlspecialchars($_SESSION['name']); ?></h3>
    <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
  </div>

  <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
