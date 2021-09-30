<?php

    class Message extends Encryption {
        private function getPrivateKey($idCategorieE, $idEnvoyeur) {
            if ($idCategorieE == 1) {
                $sql = "SELECT ClePrive FROM Agri WHERE 'idAgri'=$idEnvoyeur";
            } elseif($idCategorieE == 2) {
                $sql = "SELECT ClePrive FROM Vulg WHERE 'idVulg'=$idEnvoyeur";
            }
            $stmt = $this->dbconnect()->query($sql);
            $encryption_key = $stmt->fetchAll();

            return $encryption_key;
        }
        public function envoyer($texte, $idCategorieE, $idCategorieR, $idEnvoyeur, $idRecepteur) {
            $encryption_key = $this->getPrivateKey($idCategorieE, $idEnvoyeur);
            $texte_crypte = $this->encrypt($texte, $encryption_key[0]);
            $sql = "INSERT INTO Message(Texte, idCategorieE, idCategorieR, idEnvoyeur, idRecepteur, heure_envoi) 
            VALUES($texte_crypte, $idCategorieE, $idCategorieR, $idEnvoyeur, $idRecepteur, NOW())";
            $this->dbconnect()->exec($sql);
        }

        public function lire ($idCategorieE, $idCategorieR, $idEnvoyeur, $idRecepteur) {
            $sql = "SELECT*FROM Messages WHERE idCategorieE='$idCategorieE' AND idCategorieR='$idCategorieR' AND idEnvoyeur='$idEnvoyeur' AND idRecepteur='$idRecepteur'";
            $stmt = $this->dbconnect()->query($sql);
            $crypted_messages = $stmt->fetchAll();
            foreach($crypted_messages as $crypted_message) {
                $decrypted_messages = $this->decrypt($this->encrypt($crypted_message[0], $this->getPrivateKey($idCategorieE, $idEnvoyeur)),$this->getPrivateKey($idCategorieE, $idEnvoyeur));
            }
            return $decrypted_messages;
        }
}