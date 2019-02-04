<?php

namespace App\Models;

use Framework\Model;

class Quiz extends Model
{
    protected $table = "quiz";

    public function getByName(string $name)
    {
        $result = $this->getByParams(["name" => $name]);

        return $result;
    }

    public function nameExists(string $name)
    {
        $result = $this->getByParams(["name" => $name]);
        if ($result) {
            return true;
        }
        return false;
    }

    public function getAllQuiz()
    {
        $result=$this->getAll();
        return result;
    }
}