<?php
    session_start();
    unset($_SESSION['idProf']);
    header("location: ../../index.php");
?>