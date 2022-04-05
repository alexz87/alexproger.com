<?php

    class IPModel {
        private $ip;

        private $_db = null;
        
        public function __construct() {
            $this->_db = DB::getInstence();
        }

        public function set_ip($ip) {
            $this->ip = $ip;
        }

        public function validDate($date) {
            $getDate = $this->getData();

            if ($getDate['date'] != $date) {
                $this->editDate($date);
                return false;
            } else {
                return true;
            }
        }

        public function editDate($date) {
            $sql = "UPDATE `click_date` SET `date` = :date WHERE `id` = '1'";
            $query = $this->_db->prepare($sql);
            $query->execute(['date' => $date]);
        }

        public function clear_ip() {
            $sql = "DELETE FROM `ip_address`";
            $query = $this->_db->prepare($sql);
            $query->execute();

            return true;
        }

        public function validIP() {
            $get_ip = $this->get_ip();

            if ($get_ip['ip'] == "") {
                $this->add_ip();
                return true;
            }
        }

        public function add_ip() {
            $sql = "INSERT INTO ip_address(ip) VALUES (:ip)";
            $query = $this->_db->prepare($sql);
            $query->execute(['ip' => $this->ip]);
        }

        public function editClick($click) {
            $sql = "UPDATE `click_date` SET `click` = :click WHERE `id` = '1'";
            $query = $this->_db->prepare($sql);
            $query->execute(['click' => $click]);
        }

        public function getData() {
            $result = $this->_db->query("SELECT * FROM `click_date` WHERE `id` = '1'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function get_ip() {
            $result = $this->_db->query("SELECT * FROM `ip_address` WHERE `ip` = '$this->ip'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }