<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ====== ADDED: DB connection ======
require_once "db.php";
// =================================

// Detect POST request
$isPost = ($_SERVER["REQUEST_METHOD"] === "POST");

// Read POST safely
$email    = htmlspecialchars($_POST['email'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

// Mask password for display
$maskedPassword = ($password !== "") ? str_repeat("•", strlen($password)) : "";

// ====== ADDED: SQL LOGIN CHECK (works with hashed passwords) ======
$loginOK = false;
$dbError = "";

if ($isPost && $email !== "" && $password !== "") {

  // Get the stored password hash for this email
  $stmt = mysqli_prepare($conn, "SELECT password FROM travelers WHERE email = ? LIMIT 1");

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($res && ($row = mysqli_fetch_assoc($res))) {
      $storedHash = $row["password"];

      // Verify typed password against stored hash
      if (password_verify($password, $storedHash)) {
        $loginOK = true;
      }
    }

    mysqli_stmt_close($stmt);
  } else {
    $dbError = "Prepare failed: " . mysqli_error($conn);
  }
}
// ====== END SQL PART ======
?>

<!DOCTYPE html>
<html>
<head>
  <title>Voyager | Login Result</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f4f1ec;
    }
    .travel-title {
      color: #2f5d50;
    }
    .btn-travel {
      background-color: #2f5d50;
      border: none;
    }
    .btn-travel:hover {
      background-color: #244a40;
    }
    .form-card {
      background-color: #ffffff;
    }
    .table th {
      width: 35%;
    }
  </style>
</head>

<body>

<div class="container mt-5">
  <div class="card shadow-lg p-4 border-0 form-card">

    <h2 class="text-center mb-4 travel-title">Login Submitted Data </h2>

    <?php if ($isPost) { ?>

      <?php if ($loginOK) { ?>
        <div class="alert alert-success text-center">
          ✔️ Login successful! Password matches database.
        </div>
      <?php } else { ?>
        <div class="alert alert-danger text-center">
          ❌ Invalid email or password.
          <?php if ($dbError !== "") echo "<br>" . htmlspecialchars($dbError); ?>
        </div>
      <?php } ?>

      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <tr>
            <th>Email</th>
            <td><?php echo $email; ?></td>
          </tr>
          <tr>
            <th>Password</th>
            <td><?php echo $maskedPassword; ?></td>
          </tr>
        </table>
      </div>

      <div class="d-grid mt-3">
        <a href="login.html" class="btn btn-travel btn-lg text-white">
          Back to Login
        </a>
      </div>

    <?php } else { ?>

      <div class="alert alert-warning text-center">
        ⚠️ No login data received. Please submit the login form first.
      </div>

      <div class="d-grid mt-3">
        <a href="login.html" class="btn btn-travel btn-lg text-white">
          Go to Login
        </a>
      </div>

    <?php } ?>

  </div>
</div>

</body>
</html>
