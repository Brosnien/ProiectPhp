<?php

namespace App\Controllers;
use App\Models\User;
use Framework\BaseController;

class UserController extends BaseController
{
    public function index(){

        $user = new User();
        $user = $user->getByEMail($_SESSION["email"]);

      //  bdump($user);
      if(!isset($_SESSION["email"]))
        {
            header("Location: /login");
            die();
        }

        return $this->view("user/user.html",["user" => $user]);
    }

    public function userGET()
    {
        $_SESSION["Errors"] = false;
        if(!$_SESSION["email"])
        {
            header("Location: /login");
            die();
        }
        $user = new User();
        $user = $user->getByEMail($_SESSION["email"]);
        return $this->view("user/user.html",["user" => $user]);
    }

    public function userPOST()
    {
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $score = $_POST["score"];
        if ($this->isNameValid($firstname) && $this->isNameValid($lastname)&& $this->isNameValid($username)) {
            $userModel = new User();
            $userModel->updateUser($username,$firstname, $lastname, $phone.$email,$score);
            $_SESSION["Errors"] = false;
            header("Location: /user");
        }
        else
        {
            header("Location: /user/edit");
        }
    }

    public function editGET()
    {
        $_SESSION["Errors"] = false;
        if(!$_SESSION["email"])
        {
            header("Location: /login");
            die();
        }
        $user = new User();
        $user = $user->getByEMail($_SESSION["email"]);
        return $this->view("user/edit.html",["user" => $user]);
    }

    public function editPOST()
    {
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $phone = $_POST["phone"];
        $email =    $_SESSION["email"];
        if ($this->isNameValid($firstname) && $this->isNameValid($lastname)&& $this->isNameValid($username)) {
            $userModel = new User();
            $userModel->updateUser($username,$firstname, $lastname, $phone,$email);
            $_SESSION["Errors"] = false;
            header("Location: /show");
        }
        else
        {
            header("Location: /user/edit");
        }
    }

    public function showGET()
    {
        $_SESSION["Errors"] = false;
        if(!$_SESSION["email"])
        {
            header("Location: /login");
            die();
        }
        $user = new User();
        $user = $user->getByEMail($_SESSION["email"]);
        return $this->view("user/show.html",["user" => $user]);
    }

    public function showPOST()
    {
        header("Location: /user/show");
    }

    public function isNameValid($username): bool
    {
        if (!isset($username) || strlen($username) < 2) {
            $_SESSION["Errors"] .= "Names cant have less than 2 characters";
            return false;
        }
        return true;
    }


}