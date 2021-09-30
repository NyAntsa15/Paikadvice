<?php
    class Vulg extends User {
        protected function sign_up($Nom, $Prenom, $ADT, $Region, $DF, $LF, $Specialite, $Qualification, $NDT, $Email, $Pwd, $Exp, $Pdp, $Horaire) {
            $CP = $this->generate_private_key();
            $sql = "INSERT INTO Agri(Nom, Prenom, Adresse_de_travail, Region, Date_formation, Lieu_formation, Specialite, Qualification, Numero_de_telephone, email, mot_de_passe, Experience, nom_image, horaire, ClePrive) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, sha1(?), ?, ?, ?, '$CP')";
            $stmt = $this->dbconnect()->prepare($sql);
            $stmt->execute([$Nom, $Prenom, $ADT, $Region, $DF, $LF, $Specialite, $Qualification, $NDT, $Email, $Pwd, $Exp, $Pdp, $Horaire]);
        }

        protected function sign__in($Email, $Pwd, $Loger_name) {
            $this->login($Email, $Pwd, $Loger_name);
        }

        protected function update_vulg_info($ADT, $Region, $NDT, $Email, $Pwd, $Pdp, $Horaire, $id) {
            $sql = "UPDATE Vulg SET 'Adresse_de_travail' = ?, 'Region' = ?, 'Numero_de_telephone' = ?, 'email' = ?, 'mot_de_passe' = ?, 'nom_image' = ?, 'horaire' = ? WHERE 'idVulg' = ?";
            $stmt = $this->dbconnect()->prepare($sql);
            $stmt->execute([$ADT, $Region, $NDT, $Email, $Pwd, $Pdp, $Horaire, $id]);
        }
    }