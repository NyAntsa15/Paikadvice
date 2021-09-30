<?php 
 	class Forum extends Dbh
 	{
		public function repondre($idforum,$idrepondeur,$texte,$idcateg)
		{
			$sql="INSERT into Reponse_Forum (idForum,Heure_Reponse,idRepondeur,Texte,idCategorie) values ($idforum, now(),$idrepondeur,$texte,$idcateg)";
			$stmt = $this->dbconnect()->exec($sql);
		}
		public function suppr_reponse($idreponse)
		{
			$sql="DELETE from Reponse_Forum where idReponse='$idreponse'";
			$stmt = $this->dbconnect()->exec($sql);
		}													
		public function pub_forum($idlanceur,$texte,$idcateg)
		{
			$sql="INSERT into Forum (idLanceur,HeureLancement,Texte,idCategorie) values('$idlanceur',now(),'$texte','$idcateg')";
			echo $sql;
			$stmt = $this->dbconnect()->exec($sql);
		}
        public function getForum1() {
            $sql = "SELECT Agri.Nom,Forum.Texte,Forum.HeureLancement,Categorie.nom as n FROM Forum join Agri on Forum.idLanceur= Agri.idAgri join Categorie on Forum.idCategorie=Categorie.idCategorie  where Forum.idCategorie=1 ";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
		public function getForum2() {
            $sql = "SELECT Vulg.Nom,Forum.Texte,Forum.HeureLancement,Categorie.nom as n FROM Forum join Vulg on Forum.idLanceur= Vulg.idVulg join Categorie on Forum.idCategorie=Categorie.idCategorie where Forum.idCategorie=2   ";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
 	}