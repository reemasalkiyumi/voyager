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

$interestsArr = $_POST["interests"] ?? []; // interests[]
if (!is_array($interestsArr)) $interestsArr = [];
$interestsSafe = array_map(function($x){ return htmlspecialchars($x, ENT_QUOTES, 'UTF-8'); }, $interestsArr);
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
    body { background-color: #f4f1ec; }
    .travel-title { color: #2f5d50; }
    .form-card { background-color: #ffffff; }
    .badge-travel { background-color: #3a7d44; }
    .table thead { background-color: #2f5d50; color: #fff; }
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
        ✔️ Feedback submitted successfully!
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
            <tr><td>Full Name</td><td><?php echo $fullName; ?></td></tr>
            <tr><td>Email</td><td><?php echo $email; ?></td></tr>
            <tr><td>Website Rating</td><td><?php echo $siteRating; ?></td></tr>
            <tr><td>Favorite Destination</td><td><?php echo $favDest; ?></td></tr>
            <tr><td>Suggested Destination</td><td><?php echo $suggestDest; ?></td></tr>
            <tr><td>Interests</td><td><span class="badge text-white badge-travel"><?php echo $interestsText; ?></span></td></tr>
            <tr><td>Visit Frequency</td><td><?php echo $visitFrequency; ?></td></tr>
            <tr><td>Notes</td><td><?php echo nl2br($notes); ?></td></tr>
          </tbody>
        </table>
      </div>

      <div class="d-grid mt-3">
        <a class="btn btn-success btn-lg" href="questionnaire.html">Back to Questionnaire</a>
      </div>
    <?php } ?>
  </div>
</div>
</body>
</html>
