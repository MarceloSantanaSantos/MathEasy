<?php
    session_start();
    unset($_SESSION['idProf']);
    unset($_SESSION['idAluno']);
    header("location: ../../index.php");
?>