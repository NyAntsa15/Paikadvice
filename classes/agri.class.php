<?php 
    class Agri extends User{
        private static $Loger_name="Agri";
        public function sign_up($Nom, $Prenom,$date_de_naissance, $Region, $NDT, $Email, $Pwd, $Pdp) {
            $CP = $this->generate_private_key();
            $sql = "INSERT INTO Agri(Nom, Prenom, date_de_naissance, Region, Numero_de_telephone, email, mot_de_passe, nom_image, ClePrive) VALUES('$Nom', '$Prenom','$date_de_naissance', '$Region', '$NDT', '$Email', sha1('$Pwd'), '$Pdp','$CP')";
            $stmt = $this->dbconnect()->exec($sql);
        }
        public function sign__in($Email, $Pwd) {
            $ok=$this->login($Email, $Pwd, self::$Loger_name);
            return $ok;
        }
        public function update_agri_info($Region, $NDT, $Email, $Pwd, $Pdp, $id) {
            $sql = "UPDATE Agri SET Region = '$Region', Numero_de_telephone = '$NDT', email = '$Email', mot_de_passe = sha1('$Pwd'), nom_image = '$Pdp' WHERE idAgri = '$id'";
            $stmt = $this->dbconnect()->exec($sql);
        }
    }