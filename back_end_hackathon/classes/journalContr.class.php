<?php
    class JournalContr extends Journal {
        public function rm_Journal($idJournal) {
            $this->suppr_journal($idJournal);
        }
        public function up_Journal($texte,$image,$idjournal) {
            $this->modif_journal($texte,$image,$idjournal);
        }
        public function pub_Journal($idenvoyeur,$texte,$image) {
            $this->publier($idenvoyeur,$texte,$image);
        }
    }