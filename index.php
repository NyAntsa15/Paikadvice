<?php 
require('includes/autoloader.inc.php');	

$stat = new Statistique();
$nb_per_region = $stat->nb_per_region();
$age_per_person = $stat->age_per_person();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<meta http-equiv="cache-control" content="no-cache,no-store,must-revalidate">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="0">
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
		<div class="itablink1" ><button id="tablink2" class="tablink" onclick="openPage('nav2', this)" >Vulgarisateurs</button></div>
		<div class="itablink2" ><button id="tablink3" class="tablink" onclick="openPage('nav3', this)">Découvertes</button></div>
		<div class="itablink3" ><button id="tablink4" class="tablink" onclick="openPage('nav4', this)">Statistiques</button></div>
		<div class="itablink4" ><button id="tablink5" class="tablink" onclick="openPage('nav5', this)">A propos</button></div>
		<div class="itablink5" ><button id="tablink6" class="tablink" onclick="openPage('nav6', this)">Sign up</button></div>
	</div>
	<div class="sign" id="sign1" style="position:fixed; border-style:solid;border-color:#f1f2f6;"><a href="#" ><p>Sign in</p></a></div>
	<div id="izy" style="position: fixed;">
		<p style="font-size:20px;">Formulaire</p>
		<hr/>
		<form action="Verification.php" method="POST">
			<p><input type="email" name="email" placeholder="E-mail" required></p>
			<p><input type="password" name="password" placeholder="Password" required></p>
			<p><div>Vulgarisateur:</div><div style="margin-top:-25px;margin-left:35px;"><input type="checkbox" name="oui" value="vulgarisateur"></div></p>
			<p ><button type="submit" style="">Sign in</button></p>
		</form>
		<button class="cancel" onclick="document.getElementById('izy').style.display='none'">Cancel</button>
	</div>
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
		<div style="padding: 15px;margin-top: 10px;border-radius: 15px;">

		<h3 style="text-decoration:underline;"><?php echo $all_new['Nom']; ?> <?php echo $all_new['Prenom']; ?></h3>
		<p>Publié le: <?php echo $all_new['date_envoi']; ?><p>	
		<p><img src="assets/images/<?php echo $all_new['nom_image']; ?>" style="border-radius: 15px;"width=200px height=200px></p>
		<p><?php echo $all_new['texte']; ?><p>
			<hr/>
		</div>		
	<?php } ?>
</div>
<div class="affichage" id="nav2" ><h2>Vulgarisateurs</h2><hr/>
<?php 
		$vulgax=new Vulg();
		$show_vulgax=$vulgax->getVulg();
	?>
	<?php foreach($show_vulgax as $show_vulgaxx){ ?>

			<p><img src="assets/images/<?php echo $show_vulgaxx['nom_image']; ?>" width=100px height=100px style="border-radius: 15px;"></p>
			<p><h3><?php echo $show_vulgaxx['Nom']." ".$show_vulgaxx['Prenom']; ?></h3></p>
			<p>Qualification: <?php echo $show_vulgaxx['Qualification']; ?><p>
			<p>Spécialité: <?php echo $show_vulgaxx['Specialite']; ?><p>
			<p>Expérience: <?php echo $show_vulgaxx['Experience']; ?><p>
			<p>Horaire de travail: <?php echo $show_vulgaxx['horaire']; ?><p>
			<p>Contact: <?php echo $show_vulgaxx['Numero_de_telephone']; ?><p>
			<p>Adresse E-mail:<?php echo $show_vulgaxx['email']; ?><p>
			<hr/>		
	<?php } ?>
</div>
<div class="affichage" id="nav3" ><h2>Découvertes</h2><hr/>
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
<div class="affichage" id="nav4" ><h2>Statistiques</h2><hr/>
	<div>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	['Region', 'Nombre de personne'],

        <?php for($i=0 ; $i<count($nb_per_region) ; $i++)
		{
			if($i!=count($nb_per_region)-1)
			{?>
          		['<?php echo($nb_per_region[$i]['Region']);  ?>', <?php echo($nb_per_region[$i]['nb']); ?>],
		<?php }
			else
			{?>
          		['<?php echo($nb_per_region[$i]['Region']);  ?>', <?php echo($nb_per_region[$i]['nb']); ?>]
		<?php } ?>
      	<?php } ?>

        ]);

        var data2 = google.visualization.arrayToDataTable([
        	['Age', 'Nombre de personne'],

        <?php for($i=0 ; $i<count($age_per_person) ; $i++)
		{
			if($i!=count($age_per_person)-1)
			{?>
          		['<?php echo($age_per_person[$i]['age']).' '.'ans';  ?>',     <?php echo($age_per_person[$i]['nb']); ?>],
		<?php }
			else
			{?>
          		['<?php echo($age_per_person[$i]['age']).' '.'ans';  ?>',     <?php echo($age_per_person[$i]['nb']); ?>]
		<?php } ?>
      	<?php } ?>

        ]);

        var options = {
          title: "Camembert du nombre d'agriculteur par région"
        };

        var options2 = {
          title: "Camembert de l'age par personne"
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);




        var data3 = google.visualization.arrayToDataTable([
        ["Region", "Nombre de personnes", { role: "style" } ],
        <?php for($i=0 ; $i<count($nb_per_region) ; $i++)
			{
			if($i!=count($nb_per_region)-1)
			{?>
        ["<?php echo($nb_per_region[$i]['Region']);  ?>", <?php echo($nb_per_region[$i]['nb']); ?>, "green"],
      <?php } 
      else
      {?>
      	["<?php echo($nb_per_region[$i]['Region']);  ?>", <?php echo($nb_per_region[$i]['nb']); ?>, "green"]
      <?php } ?>
      	<?php } ?>

      ]);

      var view = new google.visualization.DataView(data3);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options3 = {
        title: "Nombre d'agriculteur par région",
        width: 220,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart3 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart3.draw(view, options3);

      var data4 = google.visualization.arrayToDataTable([
        ["Age", "Nombre de personnes", { role: "style" } ],
        <?php for($i=0 ; $i<count($age_per_person) ; $i++)
			{
			if($i!=count($age_per_person)-1)
			{?>
        ["<?php echo($age_per_person[$i]['age']).' '.'ans';  ?>", <?php echo($age_per_person[$i]['nb']); ?>, "green"],
      <?php } 
      else
      {?>
      	["<?php echo($age_per_person[$i]['age']).' '.'ans';  ?>", <?php echo($age_per_person[$i]['nb']); ?>, "green"]
      <?php } ?>
      	<?php } ?>

      ]);

      var view2 = new google.visualization.DataView(data4);
      view2.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options4 = {
        title: "Nombre d'agriculteur selon l'age",
        width: 220,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart4 = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
      chart4.draw(view2, options4);

      }


    </script>
	<div id="piechart" style="auto; height: auto;"></div>
	<div id="piechart2" style="width: auto; height: auto;"></div>
	<div id="columnchart_values" style="width: auto; height: auto;"></div>
	<br/><br/><br/> 
	<div id="columnchart_values2" style="width: auto; height: auto;"></div>
	</div>
</div>
<div class="affichage" id="nav5" ><h2>A propos</h2><hr/>
<p>Le système de service de conseil et de vulgarisation agricoles (SCVA) en Afrique fut négligé et sous-développé durant des années. Cela n’a fait qu’empirer le manque de productivité agricole et a accentué la pauvreté rurale.
Ainsi nous proposons sur ce site une solution face à ce problème. Nos cibles en question sont les vulgarisateurs, les agriculteurs et l’Etat. Il s’agit d’un site d’échange d’informations entre ces derniers avec facilité dont lequel nous avons une section message, forum, journal, découvertes et tâches aisément accessible pour tous. De plus nous suivons la norme de données internationales par la triade CIA, c’est-à-dire de la confidentialité, de l’intégrité et de la disponibilité des données à tout moment.
Vous y trouverez des fonctionnalités en accord avec les technologies de dernier cri telles les données statistiques pour envisager une décision quasiment assurée qui peuvent-être encore collectées pour des études approfondies ; et tout cela avec simplicité.

Qui sommes-nous ? Nous étudions l’informatique en première année à l’IT University. Nous croyons que nous avons tous un rôle à jouer dans l’éradication du sous-développement. D’où notre initiative à proposer une solution technologique abordable visant à augmenter la productivité agricole et à atténuer la pauvreté. 
</p>
</div>
<!--Redaction Momo-->
<div class="affichage" id="nav6" ><h2>Sign up</h2><hr/>
<!-- Css -->
<div>
<h3 style="background-color:#0e171e;color:white;height: 35px;padding-top: 10px;padding-left: 10px;border-radius: 15px;">1-Agriculteur</h3>
<form action="index.php" method="POST" enctype="multipart/form-data">
	<p>Nom: <input type="text" name="nom" required></p>
	<p>Prénom: <input type="text" name="prenom" required></p>
	<p>Date de naissance: <input type="date" name="date_d" required></p>
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
	<?php 
		if(isset($_GET['erreurEmail'])){
				echo "<p>"."Vérifier votre adresse E-mail s'il vous plaît"."</p>"; 	 
			}
	?>
	<p>Mot de passe: <input type="password" name="mdp" required></p>
	<?php
		if(isset($_GET['erreurPwd'])){
			echo "<p>"."Votre mot de passe doit contenir au moin 8 caractères et contenir des majuscules, minuscules et des chiffres"."</p>";
		}
		?>
	<p><input type="hidden" name="MAX_FILE_SIZE" value="20000000"></p>
	<p>Photo de profil: <input type="file" name="image"></p>
	<p><input type="submit" value="S'inscrire"></p>
</form>
</div>
<div>
<h3 style="background-color:#0e171e;color:white;height: 35px;padding-top: 10px;padding-left: 10px;border-radius: 15px;">2-Vulgarisateur</h3>
<form action="index.php" method="POST" enctype="multipart/form-data">
	<p>Nom: <input type="text" name="nom" required></p>
	<p>Prénom: <input type="text" name="prenom" required></p>
	<p>Adresse de travail: <input type="text" name="add" required></p>
	<p>Date de naissance: <input type="date" name="date_d" required></p>
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
	<p>Date de la dernière formation: <input type="date" name="date_de_f" required></p>
	<p>Lieu de la formation: <input type="text" name="lieu_de_f" required></p>
	<p>Spécialité: <input type="text" name="spec" required></p>
	<p>Qualifications: <input type="text" name="qual" required></p>
	<p>Expériences: <input type="text" name="xp" required></p>
	<p>Horaires: <input type="text" name="horaire" required></p>
	<p>Numéro de téléphone: <input type="tel" name="num" required></p>
	<p>E-mail: <input type="email" name="mail" required></p>
	<?php 
		if(isset($_GET['erreurEmail'])){
				echo "<p>"."Vérifier votre adresse E-mail s'il vous plaît"."</p>"; 	 
			}
	?>
	<p>Mot de passe: <input type="password" name="mdp" required></p>
	<?php
		if(isset($_GET['erreurPwd'])){
			echo "<p>"."Votre mot de passe doit contenir au moin 8 caractères et contenir des majuscules, minuscules et des chiffres"."</p>";
		}
	?>
	<p><input type="hidden" name="MAX_FILE_SIZE" value="20000000"></p>
	<p>Photo de profil: <input type="file" name="image"></p>
	<p><input type="submit" value="S'inscrire"></p>
</form>
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
    <li><a href='#' class="generic-anchor footer-list-anchor" >Amélioration du site</a></li>
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