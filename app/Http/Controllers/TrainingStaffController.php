<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingStaffController extends Controller
{
    public function index(){

        return view('trainingstaff.index');
    }
}
