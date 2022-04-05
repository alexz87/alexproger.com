<?php

    class ContactModel {

        private $name;
        private $email;
        private $message;

        public function setData($name, $email, $message) {
            $this->name = $name;
            $this->email = $email;
            $this->message = $message;
        }

        public function validForm() {
            if (strlen($this->name) < 3) {
                return "Ім'я за коротке";
            } else if (strlen($this->email) < 3) {
                return "Email за короткий";
            } else if (strlen($this->message) < 10) {
                return "Повідомлення за коротке";
            } else {
                return "ok";
            }
        }

        public function mail() {
            $to = "admin@alexproger.com";
            $subject = "=?utf-8?B?" . base64_encode("Повідомлення з AlexProger.com!") . "?=";
            $message = "Ім'я: " . $this->name . "<br>Повідомлення: " . $this->message;
            $headers = "From: $this->email\r\nReply-to: $this->email\r\nContent-type: text/html; charset=utf-8\r\n";

            $success = mail($to, $subject, $message, $headers);

            if (!$success) {
                return "Повідомлення не надіслано";
            } else {
                return "Повідомлення надіслано";
            }
        }
    }