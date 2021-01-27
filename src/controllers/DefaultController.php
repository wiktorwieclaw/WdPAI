<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    
    public function index() {
        if($this->isUserSession()) {
            $this->goToSubpage('clubs');
        }
        else {
            $this->render('home');
        }
    }

    public function feed() {
        $this->render('feed');
    }
}