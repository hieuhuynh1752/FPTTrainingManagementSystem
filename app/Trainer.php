<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'userid','trainername','trainertype','traineremail','traineephone'
    ];
}
