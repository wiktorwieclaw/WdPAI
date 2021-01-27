<?php

require_once __DIR__.'/../repository/UserRepository.php';

class ProfileController extends AppController {

    private UserRepository $userRepo;

    public function __construct()
    {
        parent::__construct();
        $this->userRepo = new UserRepository();
    }

    public function profile($id) {
        if(!$id) {
            $id = intval($_COOKIE['userId']);
        }
        $profile = $this->userRepo->getUserDetailsById($id);
        $this->render("profile", ["user"=>$profile]);
    }
}