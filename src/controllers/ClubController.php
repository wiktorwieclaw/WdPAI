<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/CLub.php';

class ClubController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    public function addClub() {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $club = new Club($_POST['title'], $_POST['description'], $_POST['file']['name']);
            return $this->render("feed", ['messeges' => $this->messages]);
        }
        // TODO wyswietlic club
        $this->render('add-club', ['messeges' => $this->messages]);
    }

    private function validate(array $file) : bool {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages = 'File is too large.';
            return false;
        }

        if(!isset($file['type']) && !is_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type not supported.';
            return false;
        }

        return true;
    }
}