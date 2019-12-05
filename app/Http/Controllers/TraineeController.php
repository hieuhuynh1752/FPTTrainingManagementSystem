<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function index(){

        return view('trainee.index');
    }
}
