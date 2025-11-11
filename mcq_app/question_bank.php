<?php
session_start();
require_once 'db_connect.php';

// Only allow admins
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?error=Access+Denied");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Question Bank - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    .btn-gradient {
      background: linear-gradient(90deg, #007bff, #6610f2);
      color: #fff;
      border: none;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h3 class="text-center mb-3">🧠 Create Question Bank</h3>

        <form action="question_bank_action.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Question Bank Title</label>
            <input type="text" name="title" class="form-control" placeholder="e.g. JavaScript Basics" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Enter a short description..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Total Time (in minutes)</label>
            <input type="number" name="time_minutes" class="form-control" min="1" required>
          </div>

          <button type="submit" class="btn btn-gradient w-100 py-2">Create Question Bank</button>
        </form>

        <div class="text-center mt-3">
          <a href="dashboard_admin.php" class="btn btn-outline-secondary btn-sm">⬅ Back to Dashboard</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
