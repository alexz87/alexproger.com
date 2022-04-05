<?php

    require 'DB.php';

    class UserModel {
        
        private $name;
        private $surname;
        private $login;
        private $email;
        private $pass;
        private $re_pass;
        private $new_pass;
        private $re_new_pass;

        private $_db = null;
        
        public function __construct() {
            $this->_db = DB::getInstence();
        }
        
        public function setData($email, $pass, $re_pass) {
            $this->email = $email;
            $this->pass = $pass;
            $this->re_pass = $re_pass;
        }

        public function set_edit_data($name, $surname, $login, $email) {
            $user = $this->get_data_user();

            if ($name == "") {
                $this->name = $user['name'];
            } else {
                $this->name = $name;
            }

            if ($surname == "") {
                $this->surname = $user['surname'];
            } else {
                $this->surname = $surname;
            }

            if ($login == "") {
                $this->login = $user['login'];
            } else {
                $this->login = $login;
            }

            if ($email == "") {
                $this->email = $user['email'];
            } else {
                $this->email = $email;
            }
        }

        public function set_edit_pass($pass, $new_pass, $re_new_pass) {
            $this->pass = $pass;
            $this->new_pass = $new_pass;
            $this->re_new_pass = $re_new_pass;
        }
        
        public function validForm() {
            $checkUser = $this->checkUser($this->email);

            if (strlen($this->email) < 3) {
                return "Email за короткий";
            } else if ($checkUser['email'] != '') {
                return "Такий email вже зареєстрований";
            } else if (strlen($this->pass) < 8) {
                return "Пароль не може бути меньше 8 символів";
            } else if ($this->pass != $this->re_pass) {
                return "Паролі не співпадають";
            } else {
                return "ok";
            }
        }

        public function validPass() {
            $user = $this->get_data_user();

            if (strlen($this->pass) < 8) {
                return "Пароль не може бути меньше 8 символів";
            } elseif (strlen($this->new_pass) < 8) {
                return "Новий пароль не може бути меньше 8 символів";
            } elseif ($this->new_pass != $this->re_new_pass) {
                return "Нові паролі не співпадають";
            } elseif (password_verify($this->pass, $user['pass'])) {
                return "ok";
            } else {
                return "Не вірний пароль";
            }
        }

        public function editData($id) {
            $sql = "UPDATE `users_portfolio` SET 
                `name` = :name, 
                `surname` = :surname, 
                `login` = :login, 
                `email` = :email 
            WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute([
                'name' => $this->name,
                'surname' => $this->surname,
                'login' => $this->login,
                'email' => $this->email
            ]);

            return 'ok';
        }

        public function editPass($id) {
            $sql = "UPDATE `users_portfolio` SET 
                `pass` = :pass
            WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $pass = password_hash($this->new_pass, PASSWORD_DEFAULT);
            $query->execute([
                'pass' => $pass
            ]);

            return 'ok';
        }

        public function addPhoto($id) {
            $photo = 'IMG_' . $id . '.jpg';
            $sql = "UPDATE `users_portfolio` SET 
                `photo` = :photo
            WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute([
                'photo' => $photo
            ]);
        }

        public function checkUser($email) {
            $result = $this->_db->query("SELECT * FROM `users_portfolio` WHERE `email` = '$email'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }
        
        public function addUser() {
            $name = 'none';
            $surname = 'none';
            $login = 'none';
            $photo = 'IMG_none.jpg';
            $sql = 'INSERT INTO users_portfolio(name, surname, login, email, pass, photo) 
                VALUES(:name, :surname, :login, :email, :pass, :photo)';
            $query = $this->_db->prepare($sql);
            $pass = password_hash($this->pass, PASSWORD_DEFAULT);
            $query->execute([
                'name' => $name, 
                'surname' => $surname, 
                'login' => $login, 
                'email' => $this->email, 
                'pass' => $pass, 
                'photo' => $photo
            ]);

            $this->setAuth($this->email);
        }
        
        public function getUser() {
            $email = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users_portfolio` WHERE `email` = '$email'");

            return $result->fetch(PDO::FETCH_OBJ);
        }

        public function get_data_user() {
            $email = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users_portfolio` WHERE `email` = '$email'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsers() {
            $result = $this->_db->query("SELECT * FROM `users_portfolio`");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function logOut() {
            setcookie('login', $this->email, time() - 3600, '/');
            unset($_COOKIE['login']);
            header('Location: /');
        }
        
        public function auth($email, $pass) {
            $result = $this->_db->query("SELECT * FROM `users_portfolio` WHERE `email` = '$email'");
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if ($user['email'] == '') {
                return 'Такий email не зареєстровано';
            } else if (password_verify($pass, $user['pass'])) {
                $this->setAuth($email);
            } else {
                return 'Не вірний пароль';
            }
        }
        
        public function setAuth($email) {
            setcookie('login', $email, time() + 3600, '/'); // + 3600(1 година) * 24(1 день) * 30(1 місяць)
            header('Location: /user/dashboard');
        }

        public function getSearch($post) {
            $search = explode(" ", $post);
            $count = count($search);
            $array = array();
            $i = 0;
            foreach($search as $value) {
                $i++;
                if ($i < $count) {
                    $array[] = "CONCAT(`email`, `login`, `name`, `surname`) LIKE '%" . $value . "%' OR ";
                } else {
                    $array[] = "CONCAT(`email`, `login`, `name`, `surname`) LIKE '%" . $value . "%'";
                };
            }
            
            $result = $this->_db->query("SELECT * FROM `users_portfolio` WHERE " . implode("", $array));

            return $result->fetchAll(PDO::FETCH_OBJ);
        }
    }
