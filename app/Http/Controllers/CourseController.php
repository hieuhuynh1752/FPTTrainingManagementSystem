<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(){
        //$courses = Course::with('coursecategories')->get();
        $courses = DB::table('courses')->orderBy('courseid')->get();
        $categories = DB::table('course_categories')->orderBy('coursecategoryid')->get();
        foreach ($courses as $course){
            foreach ($categories as $category){
                if($course->CourseCategoryID==$category->CourseCategoryID){
                    $course->CourseCategoryName=$category->CourseCategoryName;
                }
            }
        }
        return view('trainingstaff.course.index')->with(['courses'=>$courses]);
    }

    public function create(){

        $categories = DB::table('course_categories')->orderBy('coursecategoryid')->get();

        return view('trainingstaff.course.create')->with([
            'categories'=>$categories
        ]);
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $course = new Course();
        //input method is used to get the value of input with its
        //name specified
        $course->CourseCategoryID =$request->input('category');
        $course->CourseName = $request->input('name');
        $course->CourseDescription = $request->input('description');


        $course->save(); //persist the data
        return redirect()->route('trainingstaff.course.index')->with('info', 'Course Added Successfully');
    }

    public function edit($id)
    {
        $course = DB::table('course')->where('CourseID',$id);
        return view('trainingstaff.course.edit',['course'=>$course]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $user = User::findOrFail($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $temppassword = $request->input('password');
        $user->password = Hash::make($temppassword);
        $user->role = $request->input('role');
        $user->save(); //persist the data
        return redirect()->route('admin.index')->with('info','User Updated Successfully');
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
}
