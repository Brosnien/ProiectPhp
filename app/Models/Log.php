<?php

namespace App\Models;

use Framework\Model;

class Log extends Model
{
    protected $table = "log";

    public function addLog(string $text)
    {
        $data = ['text' => $text];
        $this->new($data);
    }
}