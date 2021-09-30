<?php
    class Newsview extends News {
        public function showNews() {
            $results = $this->getNews();
            foreach($results as $result) {
                echo "<img src = " . $result['nom_image'] . "/>" . "<br>";  
                echo $result['texte'] . "<br>";
                echo $result['date_envoi'] . "<br>";
            }
        }
    }