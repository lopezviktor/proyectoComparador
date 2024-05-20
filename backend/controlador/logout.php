<?php
session_start();
session_unset();
echo "Debug: Variables de sesión eliminadas.";
session_destroy();
echo "Debug: Sesión destruida.";

header("Location: ../../frontend/html/index.php");

exit();
?>