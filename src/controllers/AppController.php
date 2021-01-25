<?php

require_once __DIR__.'/../repository/UserRepository.php';

class AppController {

    private $request;
    private $userRepo;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->userRepo = new UserRepository();
    }

    protected function getUserRepo() {
        return $this->userRepo;
    }

    protected function isGet() : bool {
        return $this->request === 'GET';
    }

    protected function isPost() : bool {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)) {
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}