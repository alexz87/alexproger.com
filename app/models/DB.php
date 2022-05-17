<?php

    class DB {
        
        private static $_db = null;

        public static function getInstence() {
            if (self::$_db == null) {
                self::$_db = new PDO('mysql:host=re448556.mysql.tools;dbname=re448556_nasty', 're448556_nasty', '7sRv)_5M5y');
            }

            return self::$_db;
        }

        private function __construct() {}
        private function __clone() {}
        private function __wakeup() {} 
    }
