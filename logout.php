<?php
session_start();
session_destroy();
header("Location: login.php");
?>
<?php
session_start();
session_destroy(); // هەمی سێشنان ژ ناڤ ببرە
header("Location: index.php"); // بزڤڕە پەیجێ سەرەکی
exit();
?>