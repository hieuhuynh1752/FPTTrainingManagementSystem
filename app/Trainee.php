<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $fillable = [
        'userid','traineename','traineedob','traineeemail','traineeeducation','traineephone'
    ];
}
