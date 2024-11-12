<?php
    class Database {
        protected $pdo;
        protected static $instance;

        protected function __construct () {
            try {
                $DHN = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
                $this->pdo = new PDO($DHN, DB_USER, DB_PASS);
            }
            catch (PDOEXception $e) {
                error_log($e->getMessage());
            }
        }

        public static function instance () {
            if (self::$instance === null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        public function __call($method, $args){
            return call_user_func_array(array($this->pdo, $method), $args);
        }
    }
?>