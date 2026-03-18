<?php
// auth/logout.php
// Responsible: Pasang Lama (Team Lead)
session_start();
session_destroy();
header('Location: ../auth/login.php');
exit();
?>