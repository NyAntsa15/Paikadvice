<?php 
    class Taches extends Vulg {
		public function ajout_tache($idEnvoyeur,$texte,$typetache)
		{	
			$sql="INSERT into Plan(idEnvoyeur,date_planification,texte,idTypeTache) Values(?,now(),?,?)";
			 $stmt = $this->dbconnect()->prepare($sql);
			 $stmt->execute([$idEnvoyeur, $texte, $typetache]);
		}
		public function suppr_tache($idplan)
		{
			$sql="DELETE from Plan where idTache=$idplan";
			$stmt = $this->dbconnect()->prepare($sql);
			$stmt->execute([$idplan]);
		}
	}