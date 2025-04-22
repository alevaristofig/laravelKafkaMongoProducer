<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Usuario extends Model
{
    protected $connection = "mongodb";
}
