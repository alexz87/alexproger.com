<?php

    class Home extends Controller {
        
        public function index() {
            $user = $this->model('UserModel');

            $detect = $this->model('Mobile_Detect');

            $ip = $this->model('IPModel');
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip->set_ip($_SERVER['HTTP_CLIENT_IP']);
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip->set_ip($_SERVER['HTTP_X_FORWARDED_FOR']);
            } else {
                $ip->set_ip($_SERVER['REMOTE_ADDR']);
            }

            $date = date('d.m.Y');
            $validDate = $ip->validDate($date);
            if (!$validDate) {
                $clear_ip = $ip->clear_ip();
                if ($clear_ip) {
                    $validIP = $ip->validIP();
                    if ($validIP) {
                        $click = $ip->getData();
                        $clicks = intval($click['click'] + 1);
                        $ip->editClick($clicks);
                    }
                }
            } else {
                $validIP = $ip->validIP();
                if ($validIP) {
                    $click = $ip->getData();
                    $clicks = intval($click['click'] + 1);
                    $ip->editClick($clicks);
                }
            }

            $data = [
                'title' => 'Портфоліо', 
                'content' => 'Головна сторінка портфоліо',
                'user' => $user->getUser(),
                'mobile' => $detect->isMobile(),
                'date' => $date
            ];
            
            $this->view('home/index', $data);
        }
    }
