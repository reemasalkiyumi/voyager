<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ====== ADDED: DB connection (SQL part) ======
require_once "db.php";
// ============================================

// Detect if this page was reached by POST submit
$isPost = ($_SERVER["REQUEST_METHOD"] === "POST");

// Read POST safely
$firstName = htmlspecialchars($_POST["firstName"] ?? "");
$lastName  = htmlspecialchars($_POST["lastName"] ?? "");
$email     = htmlspecialchars($_POST["email"] ?? "");
$password  = htmlspecialchars($_POST["password"] ?? "");
$terms     = isset($_POST["terms"]) ? "Accepted" : "Not accepted";

// Mask password for display (recommended)
$maskedPassword = ($password !== "") ? str_repeat("•", strlen($password)) : "";

// ====== ADDED: SQL INSERT into travelers (no UI changes) ======
$saved = false;
$dbError = "";

if ($isPost) {
  // basic validation
  $validInput = ($firstName !== "" && $lastName !== "" && $email !== "" && $password !== "" && $terms === "Accepted");

  if ($validInput) {
    // 1) Check if email already exists
    $check = mysqli_prepare($conn, "SELECT 1 FROM travelers WHERE email = ? LIMIT 1");
    if ($check) {
      mysqli_stmt_bind_param($check, "s", $email);
      mysqli_stmt_execute($check);
      mysqli_stmt_store_result($check);
      $exists = (mysqli_stmt_num_rows($check) > 0);
      mysqli_stmt_close($check);

      if ($exists) {
        $dbError = "This email is already registered.";
      } else {
        // 2) Insert traveler (NOW: name, email, password, rating)
        $fullName = trim($firstName . " " . $lastName);
        $rating = 0;

        // store password securely
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $ins = mysqli_prepare($conn, "INSERT INTO travelers (name, email, password, rating) VALUES (?, ?, ?, ?)");
        if ($ins) {
          mysqli_stmt_bind_param($ins, "sssi", $fullName, $email, $passwordHash, $rating);
          $saved = mysqli_stmt_execute($ins);
          if (!$saved) {
            $dbError = "Insert failed: " . mysqli_error($conn);
          }
          mysqli_stmt_close($ins);
        } else {
          $dbError = "Prepare failed: " . mysqli_error($conn);
        }
      }
    } else {
      $dbError = "Prepare failed: " . mysqli_error($conn);
    }
  } else {
    if ($terms !== "Accepted") {
      $dbError = "You must accept the terms.";
    } else {
      $dbError = "Missing required fields.";
    }
  }
}
// ====== END SQL part ======
?>
<!DOCTYPE html>
<html>
<head>
  <title>Voyager | Sign Up Result</title>

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
    .badge-travel {
      background-color: #3a7d44;
    }
    .table th {
      width: 35%;
    }
  </style>
</head>

<body>

<div class="container mt-5">
  <div class="card shadow-lg p-4 border-0 form-card">
    <h2 class="text-center mb-4 travel-title">Sign Up Submitted Data ✨</h2>

    <?php if ($isPost) { ?>

      <?php if ($saved) { ?>
        <div class="alert alert-success text-center">
          ✔️ Form submitted successfully! (Saved in MySQL)
        </div>
      <?php } else { ?>
        <div class="alert alert-warning text-center">
          ⚠️ Form submitted, but not saved in database. <?php echo htmlspecialchars($dbError); ?>
        </div>
      <?php } ?>

      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <tr>
            <th>First Name</th>
            <td><?php echo $firstName; ?></td>
          </tr>
          <tr>
            <th>Last Name</th>
            <td><?php echo $lastName; ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo $email; ?></td>
          </tr>
          <tr>
            <th>Password</th>
            <td><?php echo $maskedPassword; ?></td>
          </tr>
          <tr>
            <th>Terms</th>
            <td>
              <span class="badge text-white badge-travel"><?php echo $terms; ?></span>
            </td>
          </tr>
        </table>
      </div>

      <div class="d-grid mt-3">
        <a href="signup.html" class="btn btn-travel btn-lg text-white">Back to Sign Up</a>
      </div>

    <?php } else { ?>
      <div class="alert alert-warning text-center">
        ⚠️ No form data received. Please submit the sign up form first.
      </div>

      <div class="d-grid mt-3">
        <a href="signup.html" class="btn btn-travel btn-lg text-white">Go to Sign Up</a>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>
