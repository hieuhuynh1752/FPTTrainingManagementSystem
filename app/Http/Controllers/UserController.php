<?php

namespace App\Http\Controllers;

use App\User;
use App\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $id=Auth::id();
        $type = DB::table('users')->where('id',$id)->first();
        if($type->role==3){
            $user = DB::table('trainers')->where('UserID',$id)->first();
            $topics=DB::table('topics')->where('TrainerID',$user->id)->get();
            return view('trainer.index',['topics'=>$topics,'name'=>$user->TrainerName]);
        }
        $user = DB::table('trainees')->where('UserID',$id)->first();
        $courses=DB::table('enrollments')->where('TraineeID',$user->id)->get();
        $courselist=DB::table('courses')->get();
        foreach($courses as $course){
            foreach ($courselist as $courselis){
                if($course->CourseID==$courselis->id){
                    $course->CourseName=$courselis->CourseName;
                    $course->CourseDescription=$courselis->CourseDescription;
                }
            }
        }
        return view('trainee.index',['courses'=>$courses,'name'=>$user->TraineeName]);


    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $user = new User();
        //input method is used to get the value of input with its
        //name specified
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $temppassword = $request->input('password');
        $user->password = Hash::make($temppassword);
        $user->role = $request->input('role');
        $user->save(); //persist the data
        return redirect()->route('admin.index')->with('info', 'User Added Successfully');
    }

    public function edit()
    {
        $id=Auth::id();
        $user = DB::table('trainers')->where('UserID',$id)->first();
        $trainer = DB::table('trainers')->where('id',$user->id)->first();
        $baseemail = DB::table('users')->where('id',$trainer->UserID)->first();
        $trainer->systememail = $baseemail->email;
        //$users = DB::table('users')->where([['isused','=','0'],['email','like','%@trainer%']])->get();
        return view('trainer.edit',['trainer'=>$trainer]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $trainer = Trainer::findOrFail($request->input('id'));
        //$course = Course::where('CourseID', $request->input('id'))->first();
        $trainer->UserID =$request->input('user');
        $trainer->TrainerName = $request->input('name');
        $trainer->TrainerType = $request->input('type');
        $trainer->TrainerEmail = $request->input('email');
        $trainer->TrainerPhone = $request->input('phone');
        $trainer->save(); //persist the data
        return redirect()->route('trainer.index')->with('info','Trainer Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $users = DB::table('users')->where('name','like','%'.$search.'%')->get();


        return view('admin.index',['users'=>$users]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index');
    }

    public function detail($id){
        $auth=Auth::id();
        $type = DB::table('users')->where('id',$auth)->first();
        if($type->role==3){
            $topic = DB::table('topics')->where('id',$id)->first();
            $courses = DB::table('course_details')->where('TopicID',$id)->get();
            foreach($courses as $course){
                $info = DB::table('courses')->where('id',$course->CourseID)->first();
                $course->CourseName=$info->CourseName;
                $course->CourseCategoryID=$info->CourseCategoryID;
                $course->CourseDescription=$info->CourseDescription;

                $category = DB::table('course_categories')->where('id',$course->CourseCategoryID)->first();
                $course->CourseCategoryName=$category->CourseCategoryName;
            }
            return view('trainer.detail',['courses' =>$courses,'topic'=>$topic]);
        }

        $course = DB::table('courses')->where('id',$id)->first();

        $categories = DB::table('course_categories')->orderBy('id')->get();
        //foreach ($courses as $course){
            foreach ($categories as $category){
                if($course->CourseCategoryID==$category->id){
                    $course->CourseCategoryName=$category->CourseCategoryName;
                }
            }


        $topics = DB::table('course_details')->where('courseid',$id)->get();
        $temptopics = DB::table('topics')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($temptopics as $temptopic){
                if($topic->TopicID==$temptopic->id){
                    $topic->TrainerID=$temptopic->TrainerID;
                    $topic->TopicName=$temptopic->TopicName;
                    $topic->TopicDescription=$temptopic->TopicDescription;
                }
            }
        }

        $trainers = DB::table('trainers')->orderBy('id')->get();
        foreach ($topics as $topic){
            foreach ($trainers as $trainer){
                if($topic->TrainerID==$trainer->id){
                    $topic->TrainerName=$trainer->TrainerName;
                }
            }
        }

        return view('trainee.detail',['course' =>$course,'topics'=>$topics]);
    }
}
