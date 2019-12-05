<?php

namespace App\Http\Controllers;

use App\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraineeController extends Controller
{
    public function index(){
        //$courses = Course::with('coursecategories')->get();
        $trainees = DB::table('trainees')->orderBy('id')->get();
        $users = DB::table('users')->orderBy('id')->get();
        //$users = DB::table('users')->where('email','like','%@trainer%')->get();
        foreach ($trainees as $trainee){
            foreach ($users as $user){
                if($trainee->UserID==$user->id){
                    $trainee->SystemEmail=$user->email;

                }
            }
        }
        return view('trainingstaff.trainee.index')->with(['trainees'=>$trainees]);
    }

    public function create(){

        $users = DB::table('users')->where([['isused','=','0'],['email','like','%@trainee%']])->get();

        return view('trainingstaff.trainee.create')->with([
            'users'=>$users
        ]);
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $trainee = new Trainee();
        //input method is used to get the value of input with its
        //name specified
        $trainee->UserID =$request->input('user');
        $trainee->TraineeName = $request->input('name');
        $trainee->TraineeDoB = $request->input('dob');
        $trainee->TraineeEmail = $request->input('email');
        $trainee->TraineeEducation = $request->input('education');
        $trainee->TraineePhone = $request->input('phone');

        $trainee->save(); //persist the data

        //$user = DB::table('users')->where('id',$request->input('user'))->first();
        //$user->isused=1;
        //$user->save();//update account info
        DB::table('users')->where('id', $request->input('user'))->update(['isused' => 1]);

        return redirect()->route('trainee.index')->with('info', 'New Trainee Created Successfully');
    }

    public function edit($id)
    {
        $trainee = DB::table('trainees')->where('id',$id)->first();
        $baseemail = DB::table('users')->where('id',$trainee->UserID)->first();
        $trainee->systememail = $baseemail->email;
        $users = DB::table('users')->where([['isused','=','0'],['email','like','%@trainee%']])->get();
        return view('trainingstaff.trainee.edit',['trainee'=>$trainee,'users'=>$users]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $trainee = Trainee::findOrFail($request->input('id'));
        //$course = Course::where('CourseID', $request->input('id'))->first();
        $olduserid=$trainee->UserID;
        $trainee->UserID = $request->input('user');
        $trainee->TraineeName = $request->input('name');
        $trainee->TraineeDoB = $request->input('dob');
        $trainee->TraineeEmail = $request->input('email');
        $trainee->TraineeEducation = $request->input('education');
        $trainee->TraineePhone = $request->input('phone');

        $trainee->save(); //persist the data

        //$newuser = DB::table('users')->where('id',$request->input('user'))->first();
        //$newuser->isused=1;
        //$newuser->save();//update account info

        DB::table('users')->where('id', $request->input('user'))->update(['isused' => 1]);

        //$olduser = DB::table('users')->where('id',$olduserid)->first();
        //$olduser->isused=0;
        //$olduser->save();//update account info
        if($olduserid!=$request->input('user')){
            DB::table('users')->where('id', $olduserid)->update(['isused' => 0]);
        }


        return redirect()->route('trainee.index')->with('info','Trainee Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $trainees = DB::table('trainees')->where('TraineeName','like','%'.$search.'%')->get();
        $users = DB::table('users')->orderBy('id')->get();
        foreach ($trainees as $trainee){
            foreach ($users as $user){
                if($trainee->UserID==$user->id){
                    $trainee->SystemEmail=$user->email;
                }
            }
        }

        return view('trainingstaff.trainee.index',['trainees'=>$trainees]);
    }

    public function destroy($id)
    {
        $trainee = Trainee::findOrFail($id);
        $trainee->delete();
        return redirect()->route('trainee.index');
    }
}
