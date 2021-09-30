<?php
    class Agricontr extends Agri {
        private static $L_Name = "Agri";

        public function sign_up($Nom, $Prenom, $Region, $NDT, $Email, $Pwd, $Pdp) {
            $this->sign_up($Nom, $Prenom, $Region, $NDT, $Email, $Pwd, $Pdp);
        }
        public function sign_in($Email, $Pwd) {
            $this->sign__in($Email, $Pwd, self::$L_Name);
        }
    }