<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Club.php';
require_once __DIR__.'/../repository/ClubRepository.php';

class ClubController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $clubRepository;

    public function __construct()
    {
        parent::__construct();
        $this->clubRepository = new ClubRepository();
    }

    public function addClub() {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $club = new Club($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->clubRepository->addClub($club);

            // TODO render all clubs that are in the database
            return $this->render("clubs", ['messeges' => $this->messages, 'club' => $club]);
        }
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