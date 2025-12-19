<?php 
include 'db.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Voyager | Search Guides</title>
</head>
<body>
<div class="container">
    <h2>Explore Our Travel Guides</h2>
    
    <form method="POST" style="margin-bottom: 30px;">
        <input type="text" name="search_term" placeholder="Search by Country..." required>
        <button type="submit" name="search">Find My Guide</button>
    </form>

    <?php
    if (isset($_POST['search'])) {
        $term = mysqli_real_escape_string($conn, $_POST['search_term']);
        $query = "SELECT * FROM guides WHERE country LIKE '%$term%'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Guide Name</th><th>Language</th><th>Country</th><th>Rating</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td><strong>{$row['name']}</strong></td>
                        <td>{$row['language']}</td>
                        <td>{$row['country']}</td>
                        <td><span class='rate-badge'>{$row['rate']} / 54</span></td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red;'>No guides found for '$term'. Try searching for 'France' or 'Japan'!</p>";
        }
    }
    ?>
</div>
</body>
</html>