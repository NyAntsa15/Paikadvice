<?php
    class Recherche extends Dbh{
        private function forum_search($recherche) {
            $sql = "SELECT Texte FROM Forum WHERE Texte LIKE '%$recherche%'";
            $stmt = $this->dbconnect()->query($sql);
            $names = $stmt->fetchAll();
    
            return $names;
        }
    
        private function news_search($recherche) {
            $sql = "SELECT texte FROM Journal WHERE texte LIKE '%$recherche%'";
            $stmt = $this->dbconnect()->query($sql);
            $names = $stmt->fetchAll();
    
            return $names;
        }
    
        private function vulgarisateurs_search($recherche) {
            $sql = "SELECT Nom, Prenom FROM Vulg WHERE Nom OR Prenom LIKE '%$recherche%'";
            $stmt = $this->dbconnect()->query($sql);
            $names = $stmt->fetchAll();
    
            return $names;
        }
    
        private function agriculteurs_search($recherche) {
            $sql = "SELECT Nom, Prenom FROM Agri WHERE Nom OR Prenom LIKE '%$recherche%'";
            $stmt = $this->dbconnect()->query($sql);
            $names = $stmt->fetchAll();
    
            return $names;
        }
        
        public function search_results($recherche) {
            echo 'les résultats de la recherche depuis le forum :';
            echo '<br/>';
            $recherche1 = $this->forum_search($recherche);
            foreach($recherche1 as $search1) 
            {
                echo $search1['Texte'];
            }
            echo '<br/>';
    
            echo 'les résultats de la recherche depuis les news :';
            echo '<br/>';
            $recherche2 = $this->news_search($recherche);
            foreach($recherche2 as $search2) 
            {
                echo $search2['texte'];
            }
            echo '<br/>';
    
            echo 'les résultats de la recherche depuis les vulgarisateurs :';
            echo '<br/>';
            $recherche3 = $this->vulgarisateurs_search($recherche);
            foreach($recherche3 as $search3) 
            {
                echo $search3['Nom'].' '.$search3['Prenom'];
            }
            echo '<br/>';
    
            echo 'les résultats de la recherche depuis les agriculteurs :';
            echo '<br/>';
            $recherche4 = $this->agriculteurs_search($recherche);
            foreach($recherche4 as $search4) 
            {
                echo $search4['Nom'].' '.$search4['Prenom'];
            }
            echo '<br/>';
        }
    }