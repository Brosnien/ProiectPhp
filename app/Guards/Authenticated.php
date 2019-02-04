<?php
namespace App\Guards;

use Framework\Guard;

class Authenticated implements Guard
{
    public function handle(array $params = null)
    {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['email']))
            $this->reject();
    }

    public function reject()
    {
        header("Location:/login");
        die();
    }
}
