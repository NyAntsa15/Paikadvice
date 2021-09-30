<?php 
 	class Forum extends Dbh
 	{
		protected function repondre($idforum,$idrepondeur,$texte,$idcateg)
		{
			$sql="INSERT into Reponse_Forum (idForum,Heure_Reponse,idRepondeur,Texte,idCategorie) values (?,now(),?,?,?)";
			$stmt = $this->dbconnect()->prepare($sql);
		    $stmt->execute([$idforum,$idrepondeur,$texte,$idcateg]);
		}
		protected function suppr_reponse($idreponse)
		{
			$sql="DELETE from Reponse_Forum where idReponse=?";
			$stmt = $this->dbconnect()->prepare($sql);
		   $stmt->execute([$idreponse]);
		}													
		protected function pub_forum($idlanceur,$texte,$idcateg)
		{
			$sql="INSERT into Forum (idLanceur,HeureLancement,Texte,idCategorie) values(?,now(),?,?)";
			$stmt = $this->dbconnect()->prepare($sql);
		   $stmt->execute([$idlanceur,$texte,$idcateg]);
		}
        protected function getForum() {
            $sql = "SELECT * FROM 'Forum'";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
 	}