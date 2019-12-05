<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = [
        'coursecategoryname','coursecategorydescription'
    ];
    public function courses(){
        return $this->belongsTo('App\Course','coursecategoryid');
    }
}
