<?php

$routes = [
    '/' => ['controller' => 'AccountController', 'action' => 'loginGET'],

    '/about-us' => ['controller' => 'PageController','action' => 'aboutUsAction', 'guard' => "Authenticated"],

    '/login' => ['controller' => 'AccountController', 'action' => 'loginGET'],
    '/login/' => ['controller' => 'AccountController', 'action' => 'loginGET'],
    '/login/post' => ['controller' => 'AccountController', 'action' => 'loginPOST'],

    '/register' => ['controller' => 'AccountController','action' => 'registerGET'],
    '/register/' => ['controller' => 'AccountController','action' => 'registerGET'],
    '/register/post' => ['controller' => 'AccountController', 'action' => 'registerPOST'],

    '/logout' => ['controller' => 'AccountController', 'action' => 'logout'],
    '/logout/' => ['controller' => 'AccountController', 'action' => 'logout'],

    '/user' => ['controller' => 'UserController','action' => 'userGET', 'guard' => "Authenticated"],
    '/user/' => ['controller' => 'UserController','action' => 'userGET', 'guard' => "Authenticated"],
    '/post' => ['controller' => 'UserController','action' => 'userPOST', 'guard' => "Authenticated"],

    '/edit' => ['controller' => 'UserController','action' => 'editGET', 'guard' => "Authenticated"],
    '/edit/' => ['controller' => 'UserController','action' => 'editGET', 'guard' => "Authenticated"],
    '/edit/post' => ['controller' => 'UserController','action' => 'editPOST', 'guard' => "Authenticated"],

    '/show' => ['controller' => 'UserController','action' => 'showGET', 'guard' => "Authenticated"],
    '/show/' => ['controller' => 'UserController','action' => 'showGET', 'guard' => "Authenticated"],
    '/show/post' => ['controller' => 'UserController','action' => 'showPOST', 'guard' => "Authenticated"],

    '/user/{id}' => ['controller' => 'UserController','action' => 'showAction', 'guard' => "Authenticated"],

    '/home' => ['controller' => 'HomePageController', 'action' => 'homepageGET'],
    '/home/' => ['controller' => 'HomePageController', 'action' => 'homepageGET'],
    '/home/post' => ['controller' => 'HomePageController', 'action' => 'homepagePOST'],


    ];
