<?php 
    require('includes/autoloader.inc.php');
    session_start();
    $forum = new Forum();
    $forum->pub_forum($_SESSION['idV'], $_POST['text_forum'], $_SESSION['idC']);
    header('Location: Vulgarisateur.php');
