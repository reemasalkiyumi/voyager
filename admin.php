<?php
include 'db.php'; // Make sure db.php exists and $conn is defined

// Handle Add Guide
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $lang = mysqli_real_escape_string($conn, trim($_POST['lang']));
    $country = mysqli_real_escape_string($conn, trim($_POST['country']));
    $rate = (int)$_POST['rate'];

    $sql = "INSERT INTO guides (name, language, country, rate) VALUES ('$name', '$lang', '$country', $rate)";
    if (mysqli_query($conn, $sql)) {
        $addMsg = "<div class='alert alert-success text-center mt-3'>✔️ Guide successfully added!</div>";
    } else {
        $addMsg = "<div class='alert alert-danger text-center mt-3'>❌ Failed to add guide: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voyager | Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #f4f1ec; }
        .travel-title { color: #2f5d50; }
        .btn-travel { background-color: #2f5d50; border: none; }
        .btn-travel:hover { background-color: #244a40; }
        .form-card { background-color: #ffffff; }
        .badge-travel { background-color: #3a7d44; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg p-4 border-0 form-card">
        <h2 class="text-center mb-4 travel-title">Add New Travel Guide ✈️</h2>

        <?php if (!empty($addMsg)) echo $addMsg; ?>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Guide Name" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="lang" class="form-control form-control-lg" placeholder="Language(s)" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="country" class="form-control form-control-lg" placeholder="Country" required>
            </div>
            <div class="col-md-6">
                <input type="number" name="rate" class="form-control form-control-lg" max="5" placeholder="Rate / 5" required>
            </div>
            <div class="col-12 d-grid">
                <button type="submit" name="add" class="btn btn-travel btn-lg text-white">Add Guide</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
