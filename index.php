<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('clubs', 'ClubController');
Routing::get('profile', 'ProfileController');
Routing::get('club', 'ClubController');
Routing::post('login', 'SecurityController');
Routing::post('addClub', 'ClubController');
Routing::post('signup', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('search', 'ClubController');
Routing::post('join', 'ClubController');
Routing::post('deleteClub', 'ClubController');

Routing::run($path);