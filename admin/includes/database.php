<?php

    require_once 'config.php';

    class Database {

        public $connection;

        function __construct() {

            $this->DBConnection();

        }

        public function DBConnection() {

            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->connection->connect_errno) {
                die("Greška prilikom povezivanja sa bazom: " . $this->connection->connect_error);
            }

        }

        public function query($sql) {

            $result = $this->connection->query($sql);
            $this->confirmQuery($result);

            return $result;
        }

        private function confirmQuery($result) {

            if (!$result) {
                die("Upit nije uspeo: " . $this->connection->error);
            }

        }

        public function escapeString($str) {

            $escapedString = $this->connection->real_escape_string($str);

            return $escapedString;
        }

        public function insertId() {

            $result = $this->connection->insert_id;
            return $result;
        }

    }

    $database = new Database();

?>
