<?php
    session_start();
    //echo "$_SESSION[login]";
    session_destroy();
    header('location: index.php');
?>
