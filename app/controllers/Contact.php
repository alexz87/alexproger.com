<?php

    class Contact extends Controller {

        public function index() {
            if (isset($_POST['name'])) {
                $mail = $this->model('ContactModel');
                $mail->setData($_POST['name'], $_POST['email'], $_POST['message']);

                $isValid = $mail->validForm();
                if ($isValid == "ok") {
                    $data['message'] = $mail->mail(); 
                } else {
                    $data['message'] = $isValid;
                }
            }

            $user = $this->model('UserModel');
            $detect = $this->model('Mobile_Detect');

            $data = [
                'title' => 'Контакти', 
                'content' => "Зворотній зв'язок", 
                'message' => $isValid,
                'user' => $user->getUser(),
                'mobile' => $detect->isMobile()
            ];

            $this->view('contact/index', $data);
        }

        public function gallery() {
            $user = $this->model('UserModel');
            $detect = $this->model('Mobile_Detect');
    
            $data = [
                'title' => 'Галерея', 
                'content' => "Фото-демонстрація робіт", 
                'user' => $user->getUser(),
                'mobile' => $detect->isMobile()
            ];
    
            $this->view('contact/gallery', $data);
        }
    }