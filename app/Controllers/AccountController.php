<?php
namespace App\Controllers;
use App\Models\User;
use Framework\BaseController;
class AccountController extends BaseController
{
    public function loginGET()
    {
        
        return $this->view("account/login.html");
    }
    public function loginPOST()
    {
        $email = $_POST["email"];
        $pass = $_POST["password"];
        $userModel = new User();
        $result = $userModel->checkUser($email, $pass);
        if ($result) {
            $_SESSION["Errors"] = false;
            $_SESSION["email"] = $result->email;
            header("Location: /show");
        } else {
            $_SESSION["Errors"] = "Date introduse gresit / Lipsa Cont";
            header("Location: /login");
        }
    }
    public function registerGET()
    {
        return $this->view("account/register.html");
    }
    public function registerPOST()
    {
        $username =  $_POST["username"];
        $password = $_POST["password"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $_SESSION["Errors"] = "";
        if ($this->isValidFormData($firstname, $lastname, $email, $password) && !$this->isEmailTaken($email)) {
            $userModel = new User();
            $userModel->register($username, $password, $firstname, $lastname, $phone, $email);
            $_SESSION["email"] = $email;
            $_SESSION["Errors"] = false;
            header("Location: /login");
        } else {
            header("Location: /register");
        }
    }
    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }
    //logica
    private function isEmailTaken(string $email): bool
    {
        $user = new User();
        if ($user->emailExists($email) == false) {
            return false;
        }
        $_SESSION["Errors"] .= "Emailul exista";
        return true;
    }
    public function isNameValid($username): bool
    {
        if (!isset($username) || strlen($username) < 2) {
            $_SESSION["Errors"] .= "Numele nu pot avea mai putin de 2 caractere";
            return false;
        }
        return true;
    }
    private function isEmailValid($email): bool
    {
        if (!isset($email) || strlen($email) < 255 || strpos('@', $email)) {
            $_SESSION["Errors"] .= "Email Invalid";
            return false;
        }
        return true;
    }
    //aici trebuie si repeat password
    public function isPasswordValid($password): bool
    {
        if (!isset($password) || strlen($password) < 6) {
            $_SESSION["Errors"] = "Parola Invalida";
            return false;
        }
        return true;
    }
    private function isValidFormData(string $firstname, $lastname, $email, $password): bool
    {
        if ($this->isNameValid($firstname) && $this->isNameValid($lastname)) {
            //  if ($this->isEmailValid($email)) {
            if ($this->isPasswordValid($password)) {
                return true;
            }
            //   }
        }
        return false;
    }
}