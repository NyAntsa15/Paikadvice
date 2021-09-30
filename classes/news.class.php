<?php
    class News extends Journal {
        public function getNews() {
            $sql = "SELECT Vulg.Nom, Vulg.Prenom, Journal.texte, Journal.date_envoi, Journal.nom_image FROM Journal JOIN Vulg on Journal.idEnvoyeur = Vulg.idVulg";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
    }