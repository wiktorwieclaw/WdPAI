<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    
    public function index() {
        $this->render('home');
    }

    public function feed() {
        $this->render('feed');
    }

    public function signup() {
        $this->render('signup');
    }

    public function clubs() {
        $this->render('clubs');
    }
}