<?php 

    class User extends Controller {
        
        public function reg() {
            if (isset($_POST['name'])) {
                $user = $this->model('UserModel');
                $user->setData(
                    $_POST['name'], 
                    $_POST['email'], 
                    $_POST['pass'], 
                    $_POST['re_pass']
                );

                $isValid = $user->validForm();
                if ($isValid == "ok") {
                    $user->addUser(); 
                } else {
                    $data['message'] = $isValid;
                }
            }

            $detect = $this->model('Mobile_Detect');

            $data = [
                'title' => 'Реєстрація', 
                'content' => 'Реєстрація користувача', 
                'message' => $isValid,
                'mobile' => $detect->isMobile()
            ];
          
            $this->view('user/reg', $data);
        }
        
        public function dashboard() {
            $user = $this->model('UserModel');
            $users = $this->model('UserModel');
            $ip = $this->model('IPModel');
            $click = $ip->getData();

            if (isset($_POST['submit'])) {
                $search = $this->model('UserModel');
                if ($_POST['search'] != "") {
                    $search_data = $search->getSearch($_POST['search']);
                }
            }
            

            if (isset($_POST['exit_btn'])) {
                $user->logOut();
                exit();
            }

            $detect = $this->model('Mobile_Detect');

            $data = [
                'title' => 'Кабінет', 
                'content' => 'Кабінет користувача',
                'user' => $user->getUser(),
                'users' => $users->getUsers(),
                'mobile' => $detect->isMobile(),
                'search' => $search_data,
                'click' => $click['click']
            ];

            $this->view('user/dashboard', $data);
        }

        public function edit() {
            $message_data = '';
            $message_pass = '';
            $user = $this->model('UserModel');

            if (isset($_POST['name']) || isset($_POST['surname']) || isset($_POST['login']) || isset($_POST['email'])) {
                $user->set_edit_data(
                    $_POST['name'],
                    $_POST['surname'],
                    $_POST['login'],
                    $_POST['email']
                );

                $editData = $user->editData($user->getUser()->id);
                if ($editData == 'ok') {
                    $message_data = 'Данні змінено';
                }
            }

            if (isset($_POST['new_pass'])) {
                $user->set_edit_pass(
                    $_POST['pass'],
                    $_POST['new_pass'],
                    $_POST['re_new_pass']
                );

                $validPass = $user->validPass();
                if ($validPass == 'ok') {
                    $editPass = $user->editPass($user->getUser()->id);
                    if ($editPass == 'ok') {
                        $message_pass = 'Пароль змінено';
                    }
                } else {
                    $message_pass = $validPass;
                }
            }

            if (isset($_POST['submit'])) {
                $user->addPhoto($user->getUser()->id);
            }

            $detect = $this->model('Mobile_Detect');

            $data = [
                'title' => 'Редагування', 
                'content' => 'Редагування інформації користувача',
                'user' => $user->getUser(),
                'mobile' => $detect->isMobile(),
                'message_data' => $message_data,
                'message_pass' => $message_pass
            ];

            $this->view('user/edit', $data);
        }
        
        public function auth() {
            if (isset($_POST['email'])) {
                $user = $this->model('UserModel');
                $result = $user->auth(
                    $_POST['email'], 
                    $_POST['pass']
                );
            }

            $detect = $this->model('Mobile_Detect');

            $data = [
                'title' => 'Авторизація', 
                'content' => 'Авторизація користувача', 
                'message' => $result,
                'mobile' => $detect->isMobile()
            ];
          
            $this->view('user/auth', $data);
        }
    }
