<?php
    class Vulg extends User {
        private static $Loger_name="Vulg";
        public function sign_up($Nom, $Prenom,$date_de_naissance, $ADT, $Region, $DF, $LF, $Specialite, $Qualification, $NDT, $Email, $Pwd, $Exp, $Pdp, $Horaire) {
            $CP = $this->generate_private_key();
            $sql = "INSERT INTO Vulg(Nom, Prenom,date_de_naissance,Adresse_de_travail, Region, Date_formation, Lieu_formation, Specialite, Qualification, Numero_de_telephone, email, mot_de_passe, Experience, nom_image, horaire, ClePrive) VALUES('$Nom', '$Prenom','$date_de_naissance','$ADT', '$Region', '$DF', '$LF', '$Specialite', '$Qualification', '$NDT', '$Email', sha1('$Pwd'), '$Exp', '$Pdp', '$Horaire', '$CP')";
            $stmt = $this->dbconnect()->exec($sql);
        }

        public function sign__in($Email, $Pwd) {
            $ok=$this->login($Email, $Pwd, self::$Loger_name);
            return $ok;
        }

        public function update_vulg_info($ADT, $Region, $NDT, $Email, $Pwd, $Pdp, $Horaire, $id) {
            $sql = "UPDATE Vulg SET Adresse_de_travail = '$ADT', Region = '$Region', Numero_de_telephone = '$NDT', email = '$Email', mot_de_passe = sha1('$Pwd'), nom_image = '$Pdp', horaire = '$Horaire' WHERE idVulg = '$id'";
            $stmt = $this->dbconnect()->exec($sql);
        }

        public function getVulg() {
            $sql = 'SELECT * FROM Vulg';
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
    }