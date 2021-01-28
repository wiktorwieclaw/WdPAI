<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{

    // TODO make registering more secure
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function isAdmin(int $id): bool
    {
        // TODO
    }

    public function login()
    { // TODO this func is too long
        $this->userSessionVerification();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User doesnt exist.']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist.']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password.']]);
        }

        setcookie('userSession', $user->getEmail(), time() + 3600);
        setcookie('userId', $user->getId(), time() + 3600);

        $this->goToSubpage("clubs");
    }

    public function signup()
    {
        $this->userSessionVerification();

        if (!$this->isPost()) {
            return $this->render('signup');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm-password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        $messages = $this->validateInput($email, $name, $surname, $password, $confirmedPassword);
        if (!empty($messages)) {
            return $this->render('signup', ['messages' => $messages]);
        }

        if ($this->userRepository->getUserByEmail($email) !== null) {
            return $this->render('signup', ['messages' => ["Account with this email already exists"]]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('signup', ['messages' => ["Please provide proper password"]]);
        }

        $user = new User($email, password_hash($password, PASSWORD_DEFAULT), $name, $surname);
        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registered!']]);
    }

    public function logout()
    {
        if ($this->isUserSession()) {
            setcookie('userSession', null, time() - 1000);
        }
        $this->goToSubpage('');
    }

    private function validateInput($email, $name, $surname, $password, $confirmedPassword): ?array
    {
        $messages = $this->validateName($name);

        $messages = array_merge($messages, $this->validateSurname($surname));

        if (strlen($email) > 254) {
            $messages[] = "Email is too long";
        }

        if (!preg_match('/\S+@\S+\.\S+$/', $email)) {
            $messages[] = "This is not an email";
        }

        if (!preg_match('/^(?=.*\d)(?=.*[A-Z]).{6,100}$/', $password)) {
            $messages[]
                = "Password has to be 6 characters long and it needs to contain one uppercase letter and one number";
        }

        if ($password !== $confirmedPassword) {
            $messages[] = "Given passwords are not the same";
        }

        return $messages;
    }


    private function validateName($name): array {
        $messages = [];

        if (strlen($name) > 35) {
            $messages[] = "Name is too long";
        }

        if (empty($name)) {
            $messages[] = "Name cannot be empty";
        }

        return $messages;
    }


    private function validateSurname($surname): array {
        $messages = [];

        if (strlen($surname) > 35) {
            $messages[] = "Surname is too long";
        }

        if (empty($surname)) {
            $messages[] = "Surname cannot be empty";
        }

        return $messages;
    }
}