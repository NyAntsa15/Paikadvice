<?php
    class Upload extends Dbh {
        private function mise($v) {
        $sql="UPDATE memoire set i='$v' ";
        $stmt=$this->dbconnect()->exec($sql);
        }
        private function check(){
        $SS='SELECT i FROM Memoire';
        $Q=$this->dbconnect()->query($SS);
        $F=$Q->fetchAll();  

        return $F;
        }

    public function upload_photo($_FILES){
        /*if(isset($_FILES['image']['name'])) {*/
            $dossier = 'assets/images/';
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 5000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.');
            if(!in_array($extension, $extensions)) {
                echo 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg';
                $erreur=1;
            }
            if($taille>$taille_maxi) {
                echo 'Le fichier est trop lourd';
                $erreur=1;
            }
            if(!isset($erreur)) {
                $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                
                $check = $this->check();
                foreach($check as $val){
                    $v = $val['i']+1;
                }

                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-',$v.$fichier);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichier)) {
                    $this->mise($v);
                    return $fichier;
                }
                else {
                    header('Location: index.php?erreurUpload=1');
                }
            }
       /* }*/
    }    
}