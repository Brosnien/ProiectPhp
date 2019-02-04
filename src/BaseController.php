<?php

namespace Framework;


class BaseController
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../App/Views');
        $twigEnvParams = $this->prepareTwigEnvironmentParams();
        $this->twig = new \Twig_Environment($loader, $twigEnvParams);

        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['Errors']))
        {
            $_SESSION['Errors'] = false;
        }

        $this->twig->addGlobal('session_errors', $_SESSION["Errors"]);
    }

    public function view(string $viewFile, array $params = [])
    {
        echo $this->twig->render($viewFile, $params);
    }

    private function prepareTwigEnvironmentParams()
    {
        $envParams['cache'] =  __DIR__ . '/../Storage/Cache/Views';

        if(\App\Config::ENV === 'dev') {
            $envParams['cache'] = false;
            $envParams['debug'] = true;
        }

        return $envParams;
    }
}