<?php
// register.php
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Register - MCQ System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
          <h4>User / Admin Registration</h4>
        </div>
        <div class="card-body">
          <form action="register_action.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Register As</label>
              <select name="role" id="role" class="form-select" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <a href="login.php">Already have an account? Login</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
