<?php 
include 'db.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voyager | Search Guides</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4 text-primary">Explore Our Travel Guides 🌍</h2>
        
        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-9">
                <input type="text" name="search_term" class="form-control form-control-lg"
                       placeholder="Search by Country..." required>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" name="search" class="btn btn-primary btn-lg">
                    Find My Guide
                </button>
            </div>
        </form>

        <?php
        if (isset($_POST['search'])) {
            $term = mysqli_real_escape_string($conn, $_POST['search_term']);
            $query = "SELECT * FROM guides WHERE country LIKE '%$term%'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                echo "
                <div class='table-responsive'>
                <table class='table table-bordered table-hover align-middle'>
                    <thead class='table-dark text-center'>
                        <tr>
                            <th>Guide Name</th>
                            <th>Language</th>
                            <th>Country</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='text-center'>
                            <td><strong>{$row['name']}</strong></td>
                            <td>{$row['language']}</td>
                            <td>{$row['country']}</td>
                            <td>
                                <span class='badge bg-success fs-6'>
                                    {$row['rate']} / 5
                                </span>
                            </td>
                          </tr>";
                }

                echo "</tbody></table></div>";
            } else {
                echo "<div class='alert alert-danger text-center'>
                        No guides found for <strong>$term</strong>. Try Japan or Italy!
                      </div>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
