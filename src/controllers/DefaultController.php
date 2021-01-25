<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    
    public function index() {
        if(isset($_COOKIE['userSession'])) {
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