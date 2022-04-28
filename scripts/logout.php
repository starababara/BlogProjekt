<?php
    session_start();
    if(!isset($_SESSION['loged']))
    {
        header("Location: login.php");
    }
    else
    {
        if(isset($_POST['submit']))
        {
            unset($_SESSION['loged']);
            header("Location: login.php");
        }
    }
?>