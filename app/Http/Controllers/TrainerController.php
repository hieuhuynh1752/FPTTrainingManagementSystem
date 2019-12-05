<?php

namespace App\Http\Controllers;

use App\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    public function index(){
        //$courses = Course::with('coursecategories')->get();
        $trainers = DB::table('trainers')->orderBy('id')->get();
        $users = DB::table('users')->orderBy('id')->get();
        //$users = DB::table('users')->where('email','like','%@trainer%')->get();
        foreach ($trainers as $trainer){
            foreach ($users as $user){
                if($trainer->UserID==$user->id){
                    $trainer->SystemEmail=$user->email;

                }
            }
        }
        return view('trainingstaff.trainer.index')->with(['trainers'=>$trainers]);
    }

    public function create(){

        $users = DB::table('users')->where([['isused','=','0'],['email','like','%@trainer%']])->get();

        return view('trainingstaff.trainer.create')->with([
            'users'=>$users
        ]);
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $trainer = new Trainer();
        //input method is used to get the value of input with its
        //name specified
        $trainer->UserID =$request->input('user');
        $trainer->TrainerName = $request->input('name');
        $trainer->TrainerType = $request->input('type');
        $trainer->TrainerEmail = $request->input('email');
        $trainer->TrainerPhone = $request->input('phone');

        $trainer->save(); //persist the data

        DB::table('users')->where('id', $request->input('user'))->update(['isused' => 1]);

        return redirect()->route('trainer.index')->with('info', 'New Trainer Created Successfully');
    }

    public function edit($id)
    {
        $trainer = DB::table('trainers')->where('id',$id)->first();
        $baseemail = DB::table('users')->where('id',$trainer->UserID)->first();
        $trainer->systememail = $baseemail->email;
        $users = DB::table('users')->where([['isused','=','0'],['email','like','%@trainer%']])->get();
        return view('trainingstaff.trainer.edit',['trainer'=>$trainer,'users'=>$users]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $trainer = Trainer::findOrFail($request->input('id'));
        //$course = Course::where('CourseID', $request->input('id'))->first();
        $olduserid=$trainer->UserID;
        $trainer->UserID =$request->input('user');
        $trainer->TrainerName = $request->input('name');
        $trainer->TrainerType = $request->input('type');
        $trainer->TrainerEmail = $request->input('email');
        $trainer->TrainerPhone = $request->input('phone');

        $trainer->save(); //persist the data

        $newuser = DB::table('users')->where('id',$request->input('user'))->first();
        $newuser->isused=1;
        $newuser->save();//update account info

        $olduser = DB::table('users')->where('id',$olduserid)->first();
        $olduser->isused=0;
        $olduser->save();//update account info


        return redirect()->route('trainer.index')->with('info','Trainer Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $trainers = DB::table('trainers')->where('TrainerName','like','%'.$search.'%')->get();
        $users = DB::table('users')->orderBy('id')->get();
        foreach ($trainers as $trainer){
            foreach ($users as $user){
                if($trainer->UserID==$user->id){
                    $trainer->SystemEmail=$user->email;
                }
            }
        }

        return view('trainingstaff.trainer.index',['trainers'=>$trainers]);
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->delete();
        return redirect()->route('trainer.index');
    }
}
