<?php
    class Database {
        // DB Paramters
        private $host = 'localhost';
        private $db_name = 'resttest';
        private $username = 'resttest';
        private $password = 'resttest';
        private $conn;

        // DB Connect
        public function connect() {
            // Set conn null first
            $this->conn = null;

            // Create new PDO object

            try {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password);
                // Set error reporting attributes
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'Connection Error: '.$e->getMessage();
            }

            // Return connection
            return $this->conn;
        }
    }