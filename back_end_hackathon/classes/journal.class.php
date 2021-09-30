<?php 
 	class Journal extends Vulg {
 		protected function suppr_journal($idjournal) {
 			$sql="DELETE from Journal where idJournal=?";
 			$stmt = $this->dbconnect()->prepare($sql);
			$stmt->execute([$idjournal]);
 		}
 		protected function modif_journal($texte,$image,$idjournal) {
 			$sql="UPDATE Journal set 'texte'=?,nom_image='?'where idJournal=?";
 			$stmt = $this->dbconnect()->prepare($sql);
			$stmt->execute([$texte,$image,$idjournal]);
 		}
 		protected function publier($idenvoyeur,$texte,$image) {
 			$sql="insert into Journal(idEnvoyeur,date_envoi,texte,nom_image)values(?,now(),?,?)";
 			$stmt = $this->dbconnect()->prepare($sql);
			$stmt->execute([$idenvoyeur,$texte,$image]);
 		}
		protected function getJournal() {
			$sql = 'SELECT * FROM Journal';
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
		}
 }