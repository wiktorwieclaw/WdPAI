<?php

require_once __DIR__.'/../repository/UserRepository.php';

class AppController {

    private $request;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet() : bool {
        return $this->request === 'GET';
    }

    protected function isPost() : bool {
        return $this->request === 'POST';
    }

    protected function goToSubpage(string $subpage) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/".$subpage);
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

    protected function isUserSession(): bool {
        return isset($_COOKIE['userSession']);
    }

    protected function allowIfUserSession() {
        if(!$this->isUserSession()) {
            $this->goToSubpage("");
        }
    }

    protected function prohibitIfUserSession() {
        if($this->isUserSession()) {
            $this->goToSubpage("");
        }
    }
}