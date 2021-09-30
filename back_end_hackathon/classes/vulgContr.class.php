<?php
    class Vulgcontr extends Vulg {
        private static $L_Name = "Vulg";

        public function sign_up($Nom, $Prenom, $ADT, $Region, $DF, $LF, $Specialite, $Qualification, $NDT, $Email, $Pwd, $Exp, $Pdp, $Horaire) {
            $this->sign_up($Nom, $Prenom, $ADT, $Region, $DF, $LF, $Specialite, $Qualification, $NDT, $Email, $Pwd, $Exp, $Pdp, $Horaire);
        }
        
        public function sign_in($Email, $Pwd) {
            $this->sign__in($Email, $Pwd, self::$L_Name);
        }
    }