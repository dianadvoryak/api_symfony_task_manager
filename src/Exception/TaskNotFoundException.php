<?php

namespace App\Exception;

class TaskNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('book not found');
    }
}
