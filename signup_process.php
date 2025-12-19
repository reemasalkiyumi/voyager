<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
      <div class="alert alert-success text-center">
        ✔️ Form submitted successfully!
      </div>

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
