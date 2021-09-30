<?php 
 	class Journal extends Vulg {
 		public function suppr_journal($idjournal) {
 			$sql="DELETE from Journal where idJournal='$idjournal'";
 			$stmt = $this->dbconnect()->exec($sql);
 		}
 
 		public function publier($idenvoyeur,$texte,$image) {
 			$sql="insert into Journal(idEnvoyeur,date_envoi,texte,nom_image)values('$idenvoyeur',now(),'$texte','$image')";
 			$stmt = $this->dbconnect()->exec($sql);
 		}
		public function getJournal($idenvoyeur) {
			$sql = "SELECT * FROM Journal WHERE idEnvoyeur= '$idenvoyeur'";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
		}
 }