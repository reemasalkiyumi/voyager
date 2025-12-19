<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Voyager | Admin Portal</title>
</head>
<body>
<div class="container">
    <h2>Add New Destination Listing</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="lang" placeholder="Language" required>
        <input type="text" name="country" placeholder="Country" required>
        <input type="number" name="rate" max="54" placeholder="Rate / 54" required>
        <button type="submit" name="add">Add to Catalog</button>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $lang = mysqli_real_escape_string($conn, $_POST['lang']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $rate = (int)$_POST['rate'];

        $sql = "INSERT INTO guides (name, language, country, rate) VALUES ('$name', '$lang', '$country', '$rate')";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green; margin-top:10px;'>✔️ Destination successfully added!</p>";
        }
    }
    ?>

    <h2 style="margin-top:50px;">Delete a Listing</h2>
    <p style="font-size: 0.9em; color: #666;">Enter the Unique ID to remove a record from Voyager.</p>
    <form method="POST">
        <input type="number" name="guide_id" placeholder="Record ID (e.g. 1)" required>
        <button type="submit" name="delete" style="background: #e63946;">Remove Permanently</button>
    </form>

    <?php
    if (isset($_POST['delete'])) {
        $id = (int)$_POST['guide_id'];
        $sql = "DELETE FROM guides WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:red; margin-top:10px;'>🗑️ Record #$id has been removed.</p>";
        }
    }
    ?>
</div>
</body>
</html>