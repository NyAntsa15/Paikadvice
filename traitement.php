<?php
    require('includes/autoloader.inc.php');
    session_start();
    $taches = new Taches();
    if (isset($_GET['ajout'])) {
        $taches->ajout_tache($_SESSION['idV'],$_POST['date'],$_POST['texte'],$_POST['tache']);
        header('Location: Vulgarisateur.php');    
    }
    $taches->suppr_tache($_GET['id']);
    header('Location: Vulgarisateur.php');
 
    