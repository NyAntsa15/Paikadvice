<?php
    class News extends Journal {
        protected function getNews() {
            $sql = 'SELECT * FROM Journal';
            $stmt = $this->dbconnect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
    }