<?php


class ProfileController extends AppController {
    public function profile($id) {
        if(!$id) {
            $id = intval($_COOKIE['userId']);
        }
        $profile = $this->getUserRepo()->getUserDetailsById($id);
        return $this->render("profile", ["user"=>$profile]);
    }
}