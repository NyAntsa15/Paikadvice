<?php
    class User extends Dbh {
        public function verif_mail($Email) {
            $rep = preg_match('#^[\w.]+@[\w]+\.[\w]+$#',$Email);
            if(!$rep)
            {
                return 0;
            }
            else {
                return 1;
            }
        }

        public function verif_pwd($Pwd) {
            $majuscule = preg_match('#[A-Z]#',$Pwd);
            $minuscule = preg_match('#[a-z]#',$Pwd);
            $chiffre = preg_match('#[0-9]#',$Pwd);
            $spec = preg_match('#[@\#()!*:;]#',$Pwd);
            $longueur = (strlen($Pwd)>=8);
            
            if(!$spec || !$chiffre || !$majuscule || !$minuscule || !$longueur)
            {
                return 0;
            }
                else
            {
                return 1;
            }
        }

        protected function generate_private_key() {
            $private_key = hash('sha256',mt_rand());
            return $private_key;
        }
        protected function login($Email, $Pwd, $Loger_name) {
            $sql = "SELECT*FROM $Loger_name";
            $stmt = $this->dbconnect()->query($sql);
            while ($row = $stmt->fetch()) {
                if ($row['email'] == $Email && $row['mot_de_passe'] == sha1($Pwd)) {
                    return 1;
                } else { return 0; }
            }
        }

        protected function unset_all_current_session() {
            $_SESSION = array();
            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() -42000, '/');
            }
            session_destroy();
        }
    }