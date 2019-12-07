<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingStaffController extends Controller
{
    public function index(){
        $id=Auth::id();
        return view('trainingstaff.index',['id'=>$id]);
    }
}
