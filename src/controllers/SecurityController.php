<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() { // TODO this func is too long
        if(isset($_COOKIE['userSession'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/feed");
        }

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User doesnt exist.']]);
        }

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist.']]);
        }

        if(!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password.']]);
        }

        setcookie('userSession', $user->getEmail(), time()+3600);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/feed");
    }

    public function signup() {
        if(isset($_COOKIE['userSession'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/feed");
        }

        if(!$this->isPost()) {
            return $this->render('signup');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm-password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if($this->userRepository->getUser($email) !== null) {
            return $this->render('signup', ['messages' => ["Account with this email already exists"]]);
        }

        if($password !== $confirmedPassword) {
            return $this->render('signup', ['messages' => ["Please provide proper password"]]);
        }

        // TODO use better hash function
        $user = new User($email, password_hash($password, PASSWORD_DEFAULT), $name, $surname);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registered!']]);
    }
}