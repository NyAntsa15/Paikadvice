<?php 
    class Taches extends Vulg {
		public function ajout_tache($idEnvoyeur,$date,$texte,$typetache)
		{	
			$sql="INSERT into Plan(idEnvoyeur,date_planification,texte,idTypeTache) Values('$idEnvoyeur','$date','$texte','$typetache')";
			 $stmt = $this->dbconnect()->exec($sql);
		}
		public function suppr_tache($idplan)
		{
			$sql="DELETE from Plan where idTache='$idplan'";
			$stmt = $this->dbconnect()->exec($sql);
		}
		public function getTaches($idUser) {
            $sql = "SELECT Plan.texte, Plan.date_planification, TypeTache.TypeTache, Plan.idTache FROM Plan JOIN TypeTache on Plan.idTypeTache = TypeTache.idTypeTache WHERE idEnvoyeur = '$idUser'";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
	}