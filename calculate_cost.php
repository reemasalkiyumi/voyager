<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$isPost = ($_SERVER["REQUEST_METHOD"] === "POST");


$guide  = htmlspecialchars($_POST["guide"] ?? "");
$rate   = isset($_POST["rate"]) ? (float)$_POST["rate"] : 0;
$hours  = isset($_POST["hours"]) ? (int)$_POST["hours"] : 0;
$people = isset($_POST["people"]) ? (int)$_POST["people"] : 0;
$age    = isset($_POST["age"]) ? (int)$_POST["age"] : 0;

// Validate
$valid = $isPost && ($guide !== "") && ($rate > 0) && ($hours > 0) && ($people > 0) && ($age > 0);


$baseCost = $rate * $hours * $people;

$groupDiscountApplied  = ($people > 5);
$seniorDiscountApplied = ($age > 60);

$finalCost = $baseCost;
if ($groupDiscountApplied)  { $finalCost *= 0.90; } // 10% off
if ($seniorDiscountApplied) { $finalCost *= 0.85; } // 15% off

function money($n) {
  return number_format((float)$n, 2);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Voyager | Cost Calculation Result</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { background-color: #f4f1ec; }
    .travel-title { color: #2f5d50; }
    .btn-travel { background-color: #2f5d50; border: none; }
    .btn-travel:hover { background-color: #244a40; }
    .form-card { background-color: #ffffff; }
    .badge-travel { background-color: #3a7d44; }
    .table th { width: 40%; }
  </style>
</head>

<body>
<div class="container mt-5">
  <div class="card shadow-lg p-4 border-0 form-card">
    <h2 class="text-center mb-4 travel-title">Cost Calculation Result 🧮</h2>

    <?php if ($valid) { ?>

      <div class="alert alert-success text-center">
        ✔️ Calculation completed successfully!
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <tr><th>Guide</th><td><?php echo $guide; ?></td></tr>
          <tr><th>Rate ($/hr)</th><td><?php echo money($rate); ?></td></tr>
          <tr><th>Hours</th><td><?php echo $hours; ?></td></tr>
          <tr><th>People</th><td><?php echo $people; ?></td></tr>
          <tr><th>Oldest Age</th><td><?php echo $age; ?></td></tr>

          <tr><th>Base Cost</th><td>$<?php echo money($baseCost); ?></td></tr>

          <tr>
            <th>Group Discount (people > 5)</th>
            <td><?php echo $groupDiscountApplied ? '<span class="badge text-white badge-travel">Applied</span>' : 'Not applied'; ?></td>
          </tr>

          <tr>
            <th>Senior Discount (age > 60)</th>
            <td><?php echo $seniorDiscountApplied ? '<span class="badge text-white badge-travel">Applied</span>' : 'Not applied'; ?></td>
          </tr>

          <tr>
            <th><strong>Final Cost</strong></th>
            <td><strong>$<?php echo money($finalCost); ?></strong></td>
          </tr>
        </table>
      </div>

      <div class="d-grid mt-3">
        <a href="calculationsGuides.html" class="btn btn-travel btn-lg text-white">
          Back to Calculator
        </a>
      </div>

    <?php } else { ?>

      <div class="alert alert-warning text-center">
        ⚠️ No valid form data received. Please fill the calculator form and submit it.
      </div>

      
      <pre class="bg-light p-3 rounded"><?php print_r($_POST); ?></pre>

      <div class="d-grid mt-3">
        <a href="calculationsGuides.html" class="btn btn-travel btn-lg text-white">
          Go to Calculator
        </a>
      </div>

    <?php } ?>
  </div>
</div>
</body>
</html>
