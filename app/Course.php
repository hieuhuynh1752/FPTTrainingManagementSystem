<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'coursename','coursedescription','coursecategoryid'
    ];

    public function coursecategories(){
        return $this->hasOne('App\CourseCategory');
    }
}
