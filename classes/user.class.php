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
            $longueur = (strlen($Pwd)>=8);
            
            if(!$chiffre || !$majuscule || !$minuscule || !$longueur)
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
            $sql = "SELECT*FROM $Loger_name WHERE email ='$Email' AND mot_de_passe =  sha1('$Pwd')";
            $stmt = $this->dbconnect()->query($sql);
            $nb=$stmt->rowCount();
			if($nb!=0)
				{ $ok=1;}
			else{ $ok=0;}
			return $ok;
        }

        public function unset_all_current_session() {
            session_start();
            $_SESSION = array();
            session_destroy();
            header('Location: index.php');
            exit;
        }
    }