<?php
    class Decouverte extends Dbh {
        public function getDecouverte() {
            $sql = "SELECT * FROM Decouvertes";
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
    } 