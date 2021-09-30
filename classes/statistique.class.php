<?php
    class Statistique extends Dbh {
        public function age_per_person()
        {
            $sql="SELECT COUNT((YEAR(now())-YEAR(date_de_naissance))) as nb, (YEAR(now())-YEAR(date_de_naissance)) as age FROM Agri GROUP BY YEAR(date_de_naissance)";  
            $res = $this->dbconnect()->query($sql);
            $f_res = $res->fetchAll();
            
            return $f_res;
        }
    
        public function nb_per_region()
        {
            $sql="SELECT COUNT(Region) as nb, Region FROM Agri GROUP BY Region";  
            
            $res = $this->dbconnect()->query($sql);
            $f_res = $res->fetchAll();
              
            return $f_res;
        }

        public function ecart_type_age()
        {
            $sql="SELECT STDDEV((YEAR(now())-YEAR(date_de_naissance))) as ageEcartType FROM Agri";  
            $res = $this->dbconnect()->query($sql);
            $f_res = $res->fetchAll();
            
            return $f_res;
        }
    
    }