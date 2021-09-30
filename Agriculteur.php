<?php 
require('includes/autoloader.inc.php');
session_start();
$_SESSION['idC']=1;
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $agr = new Agri();
    $up=new Upload();
    $agr->update_agri_info($_POST['region'], $_POST['num'], $_POST['mail'], $_POST['mdp'], $up->upload_photo($_FILES),$_SESSION['idA']); 
    header("Location: ".$_SERVER['SCRIPT_NAME']."?success");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
	<title>Paikadvice</title>
	<link rel="icon" type="image/png" href="image/Paikadvice.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div id="principal">
	<div class="navigation_bar" style="background-image:url('image/fond.jpg')"></div>
	<center><div class="search">
		<form action="traitrecherche.php" method="get">
			<input class="search-zone" type="text" name="search" placeholder="Votre recherche ...">
			<button type="submit" class="search-btn"><img src="image/loupe.png"></button>
		</form>
	</div></center>	

	<div id="tablink-container">
		<div ><button id="tablink1" class="tablink" onclick="openPage('nav1', this)" >Actualités</button></div>
		<div class="itablink1" ><button id="tablink2" class="tablink" onclick="openPage('nav2', this)" >Forum</button></div>
		<div class="itablink2" ><button id="tablink3" class="tablink" onclick="openPage('nav3', this)">Vulgarisateurs</button></div>
		<div class="itablink3" ><button id="tablink4" class="tablink" onclick="openPage('nav4', this)">Message</button></div>
		<div class="itablink4" ><button id="tablink5" class="tablink" onclick="openPage('nav5', this)">Decouvertes</button></div>
		<div class="itablink5" ><button id="tablink6" class="tablink" onclick="openPage('nav6', this)">Modifier profil</button></div>
	</div>
	<div class="sign" id="sign1" style="position:fixed; border-style:solid;border-color:#f1f2f6;"><a href="deconnexion.php" ><p>Sign out</p></a></div>
<script type="text/javascript">
	document.getElementById('sign1').onclick = function(e) {
    if(e.target != document.getElementById('sign1')){
    	document.getElementById('izy').style.display='block';          
    } 
	}
</script>
<div class="affichage" id="nav1" ><h2>Actualités</h2><hr/>
<?php 
	$nws=new News();
	$all_news = $nws->getNews();
?>
	<?php foreach($all_news as $all_new){ ?>
		<p><?php echo $all_new['Nom']; ?> <?php echo $all_new['Prenom']; ?><p>	
		<p>Description: <?php echo $all_new['texte']; ?><p>
		<p><img src="assets/images/<?php echo $all_new['nom_image']; ?>" width=200px height=200px></p>
		<p>Publié le: <?php echo $all_new['date_envoi']; ?><p>
		<br>				
	<?php } ?>
</div>
<div class="affichage" id="nav2" ><h2>Forum</h2><hr/>
<h3>Publier dans Forum</h3>
	<form action="traitement_forum(1).php" method="POST">
		<p><input type="text" name="text_forum" placeholder="Ecrire, c'est participer!"></p>
		<p><input type="submit" value="Poster"></p>
	</form>
	<h3>Les publications disponibles dans Forum</h3>
	<?php
		$forum = new Forum();
		$all_forums = $forum->getForum1(); 
		$all_forumss = $forum->getForum2(); 
	?>
	
	<?php foreach($all_forums as $all_forum) { ?>
		<p>*<?php echo $all_forum['Nom'];"(" ?>
		(<?php echo $all_forum['n']; ?>) <?php echo $all_forum['HeureLancement']; ?></p>
		<p><?php echo $all_forum['Texte']; ?></p>
		
	<?php } ?>
	<?php foreach($all_forumss as $all_forumm) { ?>
		<p>*<?php echo $all_forumm['Nom']; ?>
		(<?php echo $all_forumm['n']; ?>) <?php echo $all_forumm['HeureLancement']; ?></p>
		<p><?php echo $all_forumm['Texte']; ?></p>
		
	<?php } ?>
</div>
<div class="affichage" id="nav3" ><h2>Vulgarisateurs</h2><hr/>
	<?php 
		$vulgax=new Vulg();
		$show_vulgax=$vulgax->getVulg();
	?>
	<?php foreach($show_vulgax as $show_vulgaxx){ ?>
			<p><img src="assets/images/<?php echo $show_vulgaxx['nom_image']; ?>" width=100px height=100px></p>
			<p>Nom: <?php echo $show_vulgaxx['Nom']; ?><p>
			<p>Prenom: <?php echo $show_vulgaxx['Prenom']; ?><p>
			<p>Qualification: <?php echo $show_vulgaxx['Qualification']; ?><p>
			<p>Spécialité: <?php echo $show_vulgaxx['Specialite']; ?><p>
			<p>Expérience: <?php echo $show_vulgaxx['Experience']; ?><p>
			<p>Horaire de travail: <?php echo $show_vulgaxx['horaire']; ?><p>
			<p>Contact: <?php echo $show_vulgaxx['Numero_de_telephone']; ?><p>
			<p>Adresse E-mail:<?php echo $show_vulgaxx['email']; ?><p>
			<br>				
	<?php } ?>
</div>
<div class="affichage" id="nav4" ><h2>Message</h2><hr/></div>
<div class="affichage" id="nav5" ><h2>Decouvertes</h2><hr/>
<?php 
		 $decouvr=new Decouverte();
		 $show_decouvrs=$decouvr->getDecouverte();
		?>
		<?php foreach($show_decouvrs as $show_decouvr) { ?>	
			<p><?php echo $show_decouvr['Texte_description'] ?></p>
			<p><img src="assets/images/<?php echo $show_decouvr['nom_multimedia']; ?>" width=200px height=200px></p>
			<br>
		<?php } ?>
</div>
<div class="affichage" id="nav6" ><h2>Modifier profil</h2><hr/>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST" enctype="multipart/form-data">
	<p>Région: <select name="region" id="regional" required>
	<option value=""></option>
	<option value="Diana">Diana</option>
	<option value="Sava">Sava</option>
	<option value="Itasy">Itasy</option>
	<option value="Analamanga">Analamanga</option>
	<option value="Vakinankaratra">Vakinankaratra</option>
	<option value="Bongolava">Bongolava</option>
	<option value="Sofia">Sofia</option>
	<option value="Boeny">Boeny</option>
	<option value="Betsiboka">Betsiboka</option>
	<option value="Melaky">Melaky</option>
	<option value="Alaotra-Mangoro">Alaotra-Mangoro</option>
	<option value="Atsinanana">Atsinanana</option>
	<option value="Analanjirofo">Analanjirofo</option>
	<option value="Amoron i Mania">Amoron i Mania</option>
	<option value="Haute Matsiatra">Haute Matsiatra</option>
	<option value="Vatovavy">Vatovavy</option>
	<option value="Fitovinany">Fitovinany</option>
	<option value="Atsimo-Atsinanana">Atsimo-Atsinanana</option>
	<option value="Ihorombe">Ihorombe</option>
	<option value="Menabe">Menabe</option>
	<option value="Atsimo-Andrefana">Atsimo-Andrefana</option>
	<option value="Androy">Androy</option>
	<option value="Anôsy">Anôsy</option>
	</select></p>
	<p>Numéro de téléphone: <input type="text" name="num"></p>
	<p>E-mail: <input type="email" name="mail" required></p>
	<p>Mot de passe: <input type="password" name="mdp" required></p>
	<p><input type="hidden" name="MAX_FILE_SIZE" value="20000000"></p>
	<p>Photo de profil: <input type="file" name="image"></p>
	<p><input type="submit" value="Confirmer"></p>
</form>
    <?php 
		if (isset($_GET['success'])) {
			echo "Modification effectué avec succès";
		}
	?>
<div>
<h3 style=""></h3>
</div>
<div>
<h3 style=""></h3>

</div>
</div>
<div id="footer" style="background-color:#0e171e;color:white;height:auto;width:100%;">
	
	<main style="color:white;">
    Paikadvice</main><hr/>
  </main>
  <!--code footer-->
<footer class="flex-rw" style="background-color:#0e171e;">
  <ul class="footer-list-top" style="padding-left:0px;">
    <li><img src="image/Paikadvice.png" style="width:30%;margin-top:40px;"></li>
  </ul>
  <ul class="footer-list-top" style="padding-left:0px;">
    <li>
      <h4 class="footer-list-header">Support</h4></li>
    <li><a href='#' class="generic-anchor footer-list-anchor" >Amélioration de la site</a></li>
    <li><a href='#' class="generic-anchor footer-list-anchor">Rapport de bug</a></li>
    <li><a href='#' class="generic-anchor footer-list-anchor">A propos</a></li>
    <li><a href='#' class="generic-anchor footer-list-anchor">Contact</a></li>
  </ul>
  <ul class="footer-list-top" style="padding-left:0px;">
    <li id='help'>
      <h4 class="footer-list-header">Application</h4></li>
    <li><a href='#' class="generic-anchor footer-list-anchor">Télécharger Paikadvice</a></li>
    <li><a href='#' class="generic-anchor footer-list-anchor">Tutoriel</a></li>
  </ul>
  <section class="footer-bottom-section flex-rw">
<div class="footer-bottom-wrapper" style="font-size:20px;">   
<i class="fa fa-copyright" role="copyright">
 
</i> 2021 GasyScript <address class="footer-address" role="company address">Madagascar, Antananarivo</address><span class="footer-bottom-rights"> - All Rights Reserved - </span>
    </div>
  </section>
</footer>
<!--code footer-->
</div>
</div>
<script type="text/javascript">
	  document.getElementById('tablink1').click();
  function openPage(tabName, elmnt) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("affichage");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    tablinks[i].style.opacity="";
  }
  document.getElementById(tabName).style.display = "block";
  elmnt.style.opacity =1;
}
</script>
</body>
</html>