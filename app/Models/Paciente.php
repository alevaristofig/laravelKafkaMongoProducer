<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Paciente extends Model
{
    protected $connection = "mongodb";
}
