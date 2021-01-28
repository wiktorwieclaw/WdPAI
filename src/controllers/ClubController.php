<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Club.php';
require_once __DIR__.'/../repository/ClubRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

class ClubController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private array $messages = [];
    private ClubRepository $clubRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->clubRepository = new ClubRepository();
        $this->userRepository = new UserRepository();
    }

    public function club(string $id) {
        if($this->isUserSession()) {
            // TODO
        }

        if(empty($id)) {
            $this->goToSubpage("clubs");
        }

        $club = $this->clubRepository->getClub($id);

        $isAdmin = $this->isAdmin();

        if($club === null) {
            $this->goToSubpage("clubs");
        }

        $members = $this->clubRepository->getClubMembers($id);
        $this->render("club", ["club" => $club, "members" => $members, "isAdmin" => $isAdmin]);
    }

    public function clubs() {
        if(!$this->isUserSession()) {
            $this->goToSubpage("");
        }

        $clubs = $this->clubRepository->getClubs();
        $this->render('clubs', ['clubs' => $clubs]);
    }

    public function addClub() {
        $this->allowIfUserSession();

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $club = new Club($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->clubRepository->addClub($club);

            $this->clubs();
        }
        $this->render('add-club', ['messages' => $this->messages]);
    }

    public function deleteClub(string $id) {
        if($this->isPost() && $this->isAdmin()) {
            $this->clubRepository->deleteClub(intval($id));
        }
        $this->goToSubpage('clubs');
    }

    public function search() {
        $this->allowIfUserSession();

        $constantType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($constantType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content,true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->clubRepository->getClubByTitle($decoded['search']));
        }
    }

    public function join() {
        $this->allowIfUserSession();

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

    private function validate(array $file): bool {
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

    private function isAdmin(): bool {
        $email = $_COOKIE['userSession'];
        $user = $this->userRepository->getUserByEmail($email);
        return $user->getRole() === "admin";
    }
}