<?php 
    class Agri extends User{
        protected function sign_up($Nom, $Prenom, $Region, $NDT, $Email, $Pwd, $Pdp) {
            $CP = $this->generate_private_key();
            $sql = "INSERT INTO Agri(Nom, Prenom, Region, Numero_de_telephone, email, mot_de_passe, nom_image, ClePrive) VALUES(?, ?, ?, ?, ?, sha1(?), ?, '$CP')";
            $stmt = $this->dbconnect()->prepare($sql);
            $stmt->execute([$Nom, $Prenom, $Region, $NDT, $Email, $Pwd, $Pdp]);
        }
        protected function sign__in($Email, $Pwd, $Loger_name) {
            $this->login($Email, $Pwd, $Loger_name);
        }
        protected function update_agri_info($Region, $NDT, $Email, $Pwd, $Pdp, $id) {
            $sql = "UPDATE Agri SET 'Region' = ?, 'Numero_de_telephone' = ?, 'email' = ?, 'mot_de_passe' = ?, 'nom_image' = ? WHERE 'idAgri' = ?";
            $stmt = $this->dbconnect()->prepare($sql);
            $stmt->execute([$Region, $NDT, $Email, $Pwd, $Pdp, $id]);
        }
    }