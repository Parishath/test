<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Already logged in → redirect
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_user.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - MCQ Test System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #6610f2);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }
    .login-card {
      background: #fff;
      color: #333;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      padding: 30px;
      width: 400px;
      animation: slideIn 0.8s ease;
    }
    @keyframes slideIn {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #6610f2;
    }
    .btn-primary {
      background: linear-gradient(90deg, #007bff, #6610f2);
      border: none;
    }
  </style>
</head>
<body>

<div class="login-card">
  <h3 class="text-center mb-4">🔐 Login</h3>

  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger py-2 text-center"><?php echo htmlspecialchars($_GET['error']); ?></div>
  <?php endif; ?>

  <form action="login_action.php" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Login</button>
  </form>

  <div class="text-center mt-3">
    <small>Don't have an account? <a href="register.php">Register</a></small>
  </div>
</div>

</body>
</html>
