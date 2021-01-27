<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Club.php';
require_once __DIR__.'/../repository/ClubRepository.php';

class ClubController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private array $messages = [];
    private ClubRepository $clubRepository;

    public function __construct()
    {
        parent::__construct();
        $this->clubRepository = new ClubRepository();
    }

    public function club(string $id) {
        if(empty($id)) {
            $this->goToSubpage("clubs");
        }

        $club = $this->clubRepository->getClub($id);

        if($club === null) {
            $this->goToSubpage("clubs");
        }

        $members = $this->clubRepository->getClubMembers($id);
        $this->render("club", ["club" => $club, "members" => $members]);
    }

    public function clubs() {
        $clubs = $this->clubRepository->getClubs();
        $this->render('clubs', ['clubs' => $clubs]);
    }

    public function addClub() {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $club = new Club($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->clubRepository->addClub($club);

            $this->clubs();
        }
        $this->render('add-club', ['messeges' => $this->messages]);
    }

    public function search() {
         $constentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

         if($constentType === "application/json") {
             $content = trim(file_get_contents("php://input"));
             $decoded = json_decode($content,true);

             header('Content-type: application/json');
             http_response_code(200);

             echo json_encode($this->clubRepository->getClubByTitle($decoded['search']));
         }
    }

    public function join() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content,true);

            header('Content-type: application/json');
            http_response_code(200);

            $result = $this->clubRepository->addMemberToClub($decoded['club'], $decoded['userId']);
            echo json_encode($result);
        }
    }

    private function validate(array $file) : bool {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large.';
            return false;
        }

        if(!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type not supported.';
            return false;
        }

        return true;
    }
}