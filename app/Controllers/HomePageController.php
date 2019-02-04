<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Quiz;
use Framework\BaseController;


class HomePageController extends BaseController
{
    public function homepageGet()
    {
        if(!isset($_SESSION["email"]))
        {
            header("Location: /login");
            die();
        }

        return $this->view("homepage.html");
        
    }

    public function homepagePOST()
    {
       
        //$_SESSION["Errors"] = false;
        if(!isset($_SESSION["email"]))
        {
            header("Location: /home");
            die();
        }

        $user = new User();
        $user = $user->getByEmail($_SESSION["email"]);

        if(isset($_SESSION["quiz_id"]))
        {
            unset($_SESSION["quiz_id"]);
        }
        
        $userModel = new User();
        
        
        $quiz_type = new Quiz();
        $result = $quiz_type->getAll();
        $count = 0;
        $values = [];

        return $this->view("homepage.html",["user" => $user,"count"=>$count,"values"=>$values ]);
    }
}