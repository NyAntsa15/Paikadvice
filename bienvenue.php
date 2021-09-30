<?php
require('includes/autoloader.inc.php'); 
$usr = new User();
$up=new Upload();
if(isset($_GET['agri'])){
    $ag=new Agri();
    if ($ag->verif_mail($_POST['mail']) == 0) {
        header('Location: index.php?erreurEmail');
    }
    if ($ag->verif_pwd($_POST['mdp']) == 0) {
        header('Location: index.php?erreurPwd');
    }
    $ag->sign_up($_POST['nom'],$_POST['prenom'],$_POST['date_d'],$_POST['region'],$_POST['num'],$_POST['mail'],$_POST['mdp'],$up->upload_photo($_FILES));
}
if(isset($_GET['vulg'])){
    $vulg=new Vulg();
    $vulg->sign_up($_POST['nom'],$_POST['prenom'],$_POST['date_d'],$_POST['add'],$_POST['region'],$_POST['date_de_f'],$_POST['lieu_de_f'],$_POST['spec'],$_POST['qual'],$_POST['num'],$_POST['mail'],$_POST['mdp'],$_POST['xp'],$up->upload_photo($_FILES),$_POST['horaire']);
}

$redirection="";
if(isset($_GET['ok']))
{
    $redirection = "Vulgarisateur.php";
}
if(isset($_GET['non']))
{
    $redirection = "Agriculteur.php";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="css/js-image-slider.js" type="text/javascript"></script>
    <link href="css/generic.css" rel="stylesheet" type="text/css" />
    <title>Bienvenue</title>
</head>
<body>
    <div class="div1"><h2>Bienvenue sur Paikadvice</h2>
       
    </div>
    <div id="sliderFrame">
        <div id="slider">
            <img src="image/recherche.jpg" alt="Entrez pour ce que vous voulez rechercher"/>
            <img src="image/sign_in.jpg" alt="Entrez votre mail et votre mot de passe, précisez si vouz êtes ou non un vulgarisateur"/>
            <img src="image/footer.jpg" alt="Cliquez sur les liens qui vous redirigeront vers les pages spécifiées" />
            <img src="image/sign_agri.jpg" alt="Pour s'inscrire en tant qu'agriculteur, il suffit de completer les cases et de choisir une photo de profil" />
            <img src="image/sign_vulg.jpg" alt="De même pour s'inscrire en tant que vulgarisateur" />
            <img src="image/navbar_agri.jpg" alt="Pour faciliter la navigation à travers les pages (vulgarisateur)" />
            <img src="image/navbar_vulg.jpg" alt="Pour faciliter la navigation à travers les pages (agriculteur)" />

        </div>
    </div>
    <div class="div2">
        <h2>Paikadvice</h2>
        <a href="<?php echo $redirection; ?>">Passer le tutoriel</a>
    </div>
</body>
</html>