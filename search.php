<?php
include 'db.php'; 

$searchResults = '';
if (isset($_POST['search'])) {
    $term = mysqli_real_escape_string($conn, trim($_POST['search_term']));
    $query = "SELECT * FROM guides WHERE country LIKE '%$term%'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $searchResults .= "
        <div class='table-responsive mt-4'>
        <table class='table table-bordered table-hover text-center align-middle'>
            <thead>
                <tr>
                    <th>Guide Name</th>
                    <th>Language</th>
                    <th>Country</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults .= "<tr>
                    <td><strong>{$row['name']}</strong></td>
                    <td>{$row['language']}</td>
                    <td>{$row['country']}</td>
                    <td>
                        <span class='badge badge-travel fs-6 text-white'>
                            {$row['rate']} / 5
                        </span>
                    </td>
                  </tr>";
        }

        $searchResults .= "</tbody></table></div>";
    } else {
        $searchResults = "<div class='alert alert-warning text-center mt-3'>
                            ⚠️ No guides found for <strong>$term</strong>. Try Italy, Japan, or Spain 🌏
                          </div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voyager | Search Guides</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #f4f1ec; }
        .travel-title { color: #2f5d50; }
        .btn-travel { background-color: #2f5d50; border: none; }
        .btn-travel:hover { background-color: #244a40; }
        .table thead { background-color: #6b4f3f; color: white; }
        .badge-travel { background-color: #3a7d44; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg p-4 border-0">
        <h2 class="text-center mb-4 travel-title">🌍 Explore Our Travel Guides</h2>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-9">
                <input type="text" name="search_term" class="form-control form-control-lg" placeholder="Search by Country..." required>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" name="search" class="btn btn-travel btn-lg text-white">Find My Guide</button>
            </div>
        </form>

        <?php
        // Display search results or message
        echo $searchResults;
        ?>
    </div>
</div>
</body>
</html>
