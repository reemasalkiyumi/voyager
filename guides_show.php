<?php
require_once "db.php";

function h($v) {
  return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

/* 1) Class represents ONE record (row) in guides table */
class Guide {
  public int $id;
  public string $name;
  public string $language;
  public string $country;
  public int $rate;

  public function __construct(int $id, string $name, string $language, string $country, int $rate) {
    $this->id = $id;
    $this->name = $name;
    $this->language = $language;
    $this->country = $country;
    $this->rate = $rate;
  }
}

/* 3) Function iterates over the array of objects and prints an XHTML table */
function renderGuidesTable(array $guides): void {
  echo '<table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%;">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>ID</th><th>Name</th><th>Language(s)</th><th>Country</th><th>Rate</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  if (count($guides) === 0) {
    echo '<tr><td colspan="5">No guides found.</td></tr>';
  } else {
    foreach ($guides as $g) {
      echo '<tr>';
      echo '<td>' . h($g->id) . '</td>';
      echo '<td>' . h($g->name) . '</td>';
      echo '<td>' . h($g->language) . '</td>';
      echo '<td>' . h($g->country) . '</td>';
      echo '<td>' . h($g->rate) . ' / 5</td>';
      echo '</tr>';
    }
  }

  echo '</tbody>';
  echo '</table>';
}

/* 2) SQL SELECT + array of objects */
$res = mysqli_query($conn, "SELECT id, name, language, country, rate FROM guides ORDER BY id DESC");

$guides = [];
if ($res && mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $guides[] = new Guide(
      (int)$row["id"],
      (string)$row["name"],
      (string)$row["language"],
      (string)$row["country"],
      (int)$row["rate"]
    );
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>Voyager | Tour Guides</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="font-family: Arial, sans-serif; background:#f4f1ec; margin:0; padding:0;">
  <div style="max-width: 1000px; margin: 40px auto; background:#fff; padding: 24px; border-radius: 10px;">
    <h2 style="color:#2f5d50; margin-top:0;">Voyager — Tour Guides</h2>
    <p style="color:#666; margin-top:0;">(This page satisfies: class + array of objects + function + XHTML table)</p>

    <?php renderGuidesTable($guides); ?>

<p style="margin-top:18px;">
  <a href="guide.html"
     style="display:inline-block;
            padding:10px 18px;
            background:#2f5d50;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;">
    ← Back
  </a>
    </p>
  </div>
</body>
</html>
