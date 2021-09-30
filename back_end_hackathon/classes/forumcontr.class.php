<?php
    class ForumContr extends Forum {
        public function rep_forum($idforum,$idrepondeur,$texte,$idcateg) {
            $this->repondre($idforum,$idrepondeur,$texte,$idcateg);
        }
        public function sup_rep($idreponse) {
            $this->suppr_reponse($idreponse);
        }
        public function pub_forum($idlanceur,$texte,$idcateg) {
             $this->pub_forum($idlanceur,$texte,$idcateg);
        }
    }