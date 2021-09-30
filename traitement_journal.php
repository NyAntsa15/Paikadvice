<?php
    require('includes/autoloader.inc.php');	
    session_start();
    if (isset($_GET['id'])) {
        $journ = new Journal();
        $journ->suppr_journal($_GET['id']);
        header('Location: Vulgarisateur.php');
    }
    $jrnl = new Journal();
    $up=new Upload();
    $jrnl->publier($_SESSION['idV'],$_POST['texte'],$up->upload_photo($_FILES));
    header('Location: Vulgarisateur.php');
    