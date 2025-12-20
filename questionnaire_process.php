<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$isPost = ($_SERVER["REQUEST_METHOD"] === "POST");

function h($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

$fullName = h($_POST["fullName"] ?? "");
$email = h($_POST["email"] ?? "");
$siteRating = h($_POST["siteRating"] ?? "");
$favDest = h($_POST["favDest"] ?? "");
$suggestDest = h($_POST["suggestDest"] ?? "");
$notes = h($_POST["notes"] ?? "");
$visitFrequency = h($_POST["visitFrequency"] ?? "");

// Fix for interests array
$interestsArr = $_POST["interests"] ?? [];
if (!is_array($interestsArr)) {
    $interestsArr = [];
}
$interestsSafe = array_map(function($x){ 
    return htmlspecialchars($x, ENT_QUOTES, 'UTF-8'); 
}, $interestsArr);
$interestsText = (count($interestsSafe) > 0) ? implode(", ", $interestsSafe) : "None";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Voyager | Feedback Result</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body { 
      background-color: #f4f1ec; 
      padding-top: 20px;
    }
    .travel-title { 
      color: #2f5d50; 
    }
    .form-card { 
      background-color: #ffffff; 
    }
    .badge-travel { 
      background-color: #3a7d44; 
      padding: 5px 10px;
      font-size: 0.9rem;
    }
    .table thead { 
      background-color: #2f5d50; 
      color: #fff; 
    }
    .btn-success {
      background-color: #2f5d50;
      border-color: #2f5d50;
    }
    .btn-success:hover {
      background-color: #1f4033;
      border-color: #1f4033;
    }
  </style>
</head>

<body>
<div class="container mt-5">
  <div class="card shadow-lg p-4 border-0 form-card">
    <h2 class="text-center mb-4 travel-title">Voyager Feedback Result ✈️</h2>

    <?php if (!$isPost) { ?>
      <div class="alert alert-warning text-center">
        ⚠️ No data received. Please submit the questionnaire form first.
      </div>
      <div class="d-grid">
        <a class="btn btn-success btn-lg" href="questionnaire.html">Back to Questionnaire</a>
      </div>
    <?php } else { ?>
      <div class="alert alert-success text-center">
        ✔️ Feedback submitted successfully! Thank you for your input.
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead>
            <tr>
              <th style="width: 35%;">Field</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Full Name</strong></td>
              <td><?php echo $fullName; ?></td>
            </tr>
            <tr>
              <td><strong>Email</strong></td>
              <td><?php echo $email; ?></td>
            </tr>
            <tr>
              <td><strong>Website Rating</strong></td>
              <td><?php echo $siteRating; ?> / 10</td>
            </tr>
            <tr>
              <td><strong>Favorite Destination</strong></td>
              <td><?php echo $favDest; ?></td>
            </tr>
            <tr>
              <td><strong>Suggested Destination</strong></td>
              <td><?php echo $suggestDest; ?></td>
            </tr>
            <tr>
              <td><strong>Travel Interests</strong></td>
              <td>
                <?php if (count($interestsSafe) > 0): ?>
                  <?php foreach ($interestsSafe as $interest): ?>
                    <span class="badge text-white badge-travel me-1"><?php echo $interest; ?></span>
                  <?php endforeach; ?>
                <?php else: ?>
                  <span class="text-muted">None selected</span>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td><strong>Visit Frequency</strong></td>
              <td><?php echo $visitFrequency; ?></td>
            </tr>
            <tr>
              <td><strong>Notes / Suggestions</strong></td>
              <td><?php echo nl2br($notes); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="d-grid mt-4">
        <a class="btn btn-success btn-lg" href="questionnaire.html">Submit Another Response</a>
      </div>
    <?php } ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>