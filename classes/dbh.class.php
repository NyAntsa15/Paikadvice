<?php
    class Dbh {
        private $host = "localhost";
        private $user = "root";
        private $pwd = "root";
        private $dbname = "hackaton";

        public function dbconnect() {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }        
    }