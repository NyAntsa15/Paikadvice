<?php
    class Notification extends Dbh {
		public function notif_mess($id,$idcateg){
			$sql="SELECT * from Message where idRecepteur=$id and idCategorie=$idcateg and heure_vu=null ";
			$count= $this->dbconnect()->query($sql);
			$nb=$count->rowCount();
			if($nb!=0)
				{ $ok=1;}
			else{ $ok=0;}
			return $ok;
		}
		public function notif_news(){
			$sql="SELECT idJournal from Journal where SELECT UNIX_TIMESTAMP(CURDATE())-UNIX_TIMESTAMP(date_envoi) as diff < 86400'";
			$count= $this->dbconnect()->query($sql);
			$nb=$count->rowCount();
			if($nb!=0)
				{ $ok=1;}
			else{ $ok=0;}
			return $ok;
		}
		public function notif_forum(){
			$sql="SELECT idForum from Forum where SELECT UNIX_TIMESTAMP(CURDATE())-UNIX_TIMESTAMP(HeureLancement) as diff < 86400";
			$count= $this->dbconnect()->query($sql);
			$nb=$count->rowCount();
			if($nb!=0)
				{ $ok=1;}
			else{ $ok=0;}
			return $ok; 
		}
		public function notif_plan($idEnvoyeur){
			$sql="SELECT idTache from Plan where idEnvoyeur=$idEnvoyeur and date_planification= now()";
			$count= $this->dbconnect()->query($sql);
			$nb=$count->rowCount();
			if($nb!=0)
				{ $ok=1;}
			else{ $ok=0;}
			return $ok; 
		}
	}