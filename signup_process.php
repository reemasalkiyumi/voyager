<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Read POST safely
$firstName = htmlspecialchars($_POST["firstName"] ?? "");
$lastName  = htmlspecialchars($_POST["lastName"] ?? "");
$email     = htmlspecialchars($_POST["email"] ?? "");
$password  = htmlspecialchars($_POST["password"] ?? "");
$terms     = isset($_POST["terms"]) ? "Accepted" : "Not accepted";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>Sign Up Result</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
  <h2>Sign Up Submitted Data</h2>

  <table border="1" cellpadding="6" cellspacing="0">
    <tr>
      <th>First Name</th>
      <td><?php echo $firstName; ?></td>
    </tr>
    <tr>
      <th>Last Name</th>
      <td><?php echo $lastName; ?></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><?php echo $email; ?></td>
    </tr>
    <tr>
      <th>Password</th>
      <td><?php echo $password; ?></td>
    </tr>
    <tr>
      <th>Terms</th>
      <td><?php echo $terms; ?></td>
    </tr>
  </table>

</body>
</html>
