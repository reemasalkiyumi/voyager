<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Voyager | Admin Portal</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

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
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-lg p-4 border-0 form-card">
        <h2 class="text-center mb-4 travel-title">Delete Travel Guide 🗑️</h2>
        
        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-12">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Guide Name to Delete" required>
            </div>
            <div class="col-12 d-grid">
                <button type="submit" name="delete" class="btn btn-travel btn-lg text-white">Delete Guide</button>
            </div>
        </form>

        <?php
        if (isset($_POST['delete'])) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);

           
            $sql = "DELETE FROM guides WHERE name='$name'";
            if (mysqli_query($conn, $sql)) {
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<div class='alert alert-success text-center mt-3'>
                            ✔️ Guide '$name' successfully deleted!
                          </div>";
                } else {
                    echo "<div class='alert alert-warning text-center mt-3'>
                            ⚠️ No guide found with the name '$name'.
                          </div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center mt-3'>
                        ❌ Failed to delete guide.
                      </div>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
