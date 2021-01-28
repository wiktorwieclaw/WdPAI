<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    
    public function index() {
        return $this->isUserSession() ? $this->goToSubpage('clubs') : $this->render('home');
    }

    public function home() {
        $this->allowIfUserSession();
        return $this->goToSubpage('');
    }
}