<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor') {
    header("Location: ../login.php");
    exit;
}
?>
<html>

<body>
    <p>CONTOH</p>
    <a href="../logout.php">Logout</a>
</body>

</html>